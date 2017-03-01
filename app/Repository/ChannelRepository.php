<?php
declare(strict_types = 1);

namespace App\Repository;

use App\Model\ChannelModel;

/**
 * Class ChannelRepository
 *
 * @package App\Repository
 */
class ChannelRepository
{
    /**
     * @param string $name
     * @param int    $number
     *
     * @return ChannelModel
     */
    public function saveChannel(string $name, int $number, string $provider)
    {
        $model = ChannelModel::init($name, $number, $provider);

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