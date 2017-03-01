<?php
declare(strict_types = 1);

namespace App\Repository;

use App\Model\FavouriteModel;

/**
 * Class FavouriteRepository
 *
 * @package App\Repository
 */
class FavouriteRepository
{
    /**
     * @param string $token
     * @param int $channel
     *
     * @return FavouriteModel
     */
    public function saveHistory(string $token, int $channel)
    {
        $model = FavouriteModel::init($token, $channel);

        $model->save();

        return $model;
    }
}