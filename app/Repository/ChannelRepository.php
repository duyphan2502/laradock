<?php
declare(strict_types = 1);

namespace App\Repository;

use App\Model\ChannelModel;
use App\Services\ChannelInterface;

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
}