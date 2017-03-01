<?php
declare(strict_types = 1);

namespace App\Astro;

use App\DTO\AstroChannel;
use App\Services\ContentProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

class Client implements ContentProvider
{
    const ASTRO_SERVICE = 'ASTRO';
    /**
     * @var string
     */
    private $endpoint;

    const GET_CHANNELS = '/ams/v3/getChannelList';

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

        $channelObjects = [];
        foreach ($channels['channels'] as $channel) {
            $channel          = new AstroChannel($channel);
            $channelObjects[] = $channel;
        }

        return $channelObjects;
    }

    /**
     * @return AtroChannel[]
     */
    public function getChannels(): array
    {
        $request = new Request('get', sprintf('%s%s', $this->endpoint, static::GET_CHANNELS));

        return $this->send($request);
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return static::ASTRO_SERVICE;
    }
}