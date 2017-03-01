<?php
declare(strict_types = 1);

namespace App\Model;

class FavouriteModel extends AbstractCacheableModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'favourite_history';

    public static $validation = [
        'token'   => 'bail|required|string',
        'channel' => 'bail|required|exists:channels,channel_number',
    ];
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'token',
        'channel',
    ];

    public $timestamps = false;

    /**
     * @param string $token
     * @param int $channel
     *
     * @return static
     */
    public static function init(string $token, int $channel)
    {
        $model = new static();
        $model->setToken($token);
        $model->setChannel($channel);
        $model->setAttribute('created_at', date('Y-m-d H:i:s'));

        return $model;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->getAttribute('token');
    }

    /**
     * @param string $token
     *
     * @return FavouriteModel
     */
    public function setToken(string $token): FavouriteModel
    {
        $this->setAttribute('token', $token);

        return $this;
    }

    /**
     * @param int $channel
     *
     * @return FavouriteModel
     */
    public function setChannel(int $channel): FavouriteModel
    {
        $this->setAttribute('channel', $channel);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAtColumn()
    {
        return null;
    }

}
