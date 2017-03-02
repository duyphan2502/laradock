<?php
declare(strict_types = 1);

namespace App\Services;

use App\DTO\ChannelEvent;
use App\Model\ChannelEventModel;
use App\Repository\ChannelRepository;
use App\Transformer\AstroModelTransformer;
use Illuminate\Support\Collection;

/**
 * Class BroadcastingProvider
 *
 * @package App\Services
 */
class BroadcastingProvider
{
    /**
     * @var ContentProvider[]
     */
    protected $providers;

    /**
     * @var ChannelRepository
     */
    public $resources;

    /**
     * @var AstroModelTransformer
     */
    private $channelTransformer;

    /**
     * BroadcastingProvider constructor.
     *
     * @param ChannelRepository     $repository
     * @param AstroModelTransformer $transformer
     */
    public function __construct(ChannelRepository $repository, AstroModelTransformer $transformer)
    {
        $this->providers          = [];
        $this->resources          = $repository;
        $this->channelTransformer = $transformer;
    }

    /**
     * @param ContentProvider $provider
     *
     * @return BroadcastingProvider
     */
    public function registerProvider(ContentProvider $provider): BroadcastingProvider
    {
        $this->providers[$provider->getServiceName()] = $provider;

        return $this;
    }

    /**
     * @param string $provider
     *
     * @return Collection
     */
    public function getChannelsFrom(string $provider): Collection
    {
        $providerChannels = [];
        $channels         = $this->resources->getChannels($provider);
        if ($channels->count()) {
            foreach ($channels->getIterator() as $channel) {
                $providerChannels[] = $this->channelTransformer->transform($channel);
            }

            return new Collection($providerChannels);
        }
        /**
         * @var $channels ChannelInterface[]
         */
        $channels = $this->providers[$provider]->getChannels();

        foreach ($channels as $channel) {
            $this->resources->saveChannel($channel, $provider);
        }

        return new Collection($channels);
    }

    /**
     * @param int $channelId
     * @param     $provider
     *
     * @return array|Collection
     */
    public function getChannelEvents(int $channelId, $provider)
    {
        $events = $this->resources->getEvents($channelId, $provider);

        if ($events->count()) {
            $eventObjects = [];
            /**
             * @var $event ChannelEventModel
             */
            foreach ($events->getIterator() as $event) {
                $eventObjects[] = new ChannelEvent($event->getAttributes());
            }

            return new Collection($eventObjects);
        }

        $provider = $this->providers[$provider];
        $events   = [];
        if ($provider instanceof ContentEventProvider) {
            /**
             * @var $events ChannelEvent[]
             */
            $events = $provider->getChannelEvents($channelId);
            foreach ($events as $event) {
                $this->resources->saveEvent($event->getData());
            }
        }

        return new Collection($events);
    }
}