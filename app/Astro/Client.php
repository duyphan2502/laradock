<?php
declare(strict_types = 1);

namespace App\Astro;

use App\DTO\AstroChannel;
use App\DTO\ChannelEvent;
use App\Services\ContentEventProvider;
use App\Services\ContentProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

class Client implements ContentProvider, ContentEventProvider
{
    const ASTRO_SERVICE = 'ASTRO';
    /**
     * @var string
     */
    private $endpoint;

    const GET_CHANNELS = '/ams/v3/getChannelList';

    const GET_CHANNEL = '/ams/v3/getEvents';

    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    /**
     * @var ResponseHandler
     */
    protected $handler;

    /**
     * Client constructor.
     *
     * @param GuzzleClient $client
     * @param string       $endpoint
     */
    public function __construct(GuzzleClient $client, string $endpoint)
    {
        $this->client   = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function send(Request $request): array
    {
        $response = $this->client->send($request);
        $channels = \GuzzleHttp\json_decode($response->getBody(), true);

        return $channels;
    }

    /**
     * @return AtroChannel[]
     */
    public function getChannels(): array
    {
        $request = new Request('get', sprintf('%s%s', $this->endpoint, static::GET_CHANNELS));

        $channels = $this->send($request);

        $channelObjects = [];
        foreach ($channels['channels'] as $channel) {
            $channel          = new AstroChannel($channel);
            $channelObjects[] = $channel;
        }

        return $channelObjects;
    }

    /**
     * @param int $channelId
     *
     * @return array
     */
    public function getChannelEvents(int $channelId): array
    {
        $start = new \DateTime();

        $end     = new \DateTime('+1day');
        $request = new Request(
            'get',
            sprintf('%s%s', $this->endpoint, static::GET_CHANNEL).'?'.
            http_build_query(
                [
                    'channelId'   => $channelId,
                    'periodStart' => $start->format('Y-m-d 00:00'),
                    'periodEnd'   => $end->format('Y-m-d 23:59'),
                ]
            ),
            []
        );

        $result = $this->send($request);

        $events = [];
        foreach ($result['getevent'] as $event) {
            $events[] = new ChannelEvent($event);
        }

        return $events;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return static::ASTRO_SERVICE;
    }
}