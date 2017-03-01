<?php
declare(strict_types = 1);

namespace App\Services;

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
    private $transformer;

    /**
     * BroadcastingProvider constructor.
     *
     * @param ChannelRepository     $repository
     * @param AstroModelTransformer $transformer
     */
    public function __construct(ChannelRepository $repository, AstroModelTransformer $transformer)
    {
        $this->providers   = [];
        $this->resources   = $repository;
        $this->transformer = $transformer;
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
                $providerChannels[] = $this->transformer->transform($channel);
            }

            return new Collection($providerChannels);
        }
        /**
         * @var $channels ChannelInterface[]
         */
        $channels = $this->providers[$provider]->getChannels();

        foreach ($channels as $channel) {
            $this->resources->saveChannel($channel->getName(), $channel->getNumber(), $provider);
        }

        return new Collection($channels);
    }
}