<?php
declare(strict_types = 1);

namespace App\Repository;

use App\DTO\ChannelEvent;
use App\Model\ChannelEventModel;
use App\Model\ChannelModel;
use App\Services\ChannelInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ChannelRepository
 *
 * @package App\Repository
 */
class ChannelRepository
{
    /**
     * @param ChannelInterface $channel
     * @param string           $provider
     *
     * @return ChannelModel
     * @internal param int $number
     *
     */
    public function saveChannel(ChannelInterface $channel, string $provider)
    {
        $model = ChannelModel::init($channel, $provider);

        $model->save();

        return $model;
    }

    /**
     * @param $provider
     *
     * @return mixed
     */
    public function getChannels($provider)
    {
        $builder = ChannelModel::where('provider', $provider);

        return $builder->get();
    }

    /**
     * @param $channelId
     * @param $provider
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getEvents($channelId, $provider)
    {
        /**
         * @var $builder Builder
         */
        $builder = ChannelEventModel::where('channelId', $channelId);
        $builder->where('provider', $provider);

        return $builder->get();
    }

    /**
     * @param $data
     *
     * @return ChannelEventModel
     */
    public function saveEvent($data)
    {
        $event = new ChannelEventModel();
        $event->init($data);
        $event->save();

        return $event;
    }
}