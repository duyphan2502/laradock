<?php
declare(strict_types = 1);

namespace App\Model;

use App\Services\ChannelInterface;

/**
 * Class ChannelModel
 *
 * @package App\Model
 */
class ChannelModel extends AbstractCacheableModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'channels';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'channel_number',
        'channel_id',
        'provider',
    ];

    /**
     * @param ChannelInterface $channel
     * @param string           $provider
     *
     * @return ChannelModel
     */
    public static function init(ChannelInterface $channel, string $provider)
    {
        $model = new static();
        $model->setName($channel->getName());
        $model->setNumber($channel->getNumber());
        $model->setChannelId($channel->getChannelId());
        $model->setProvider($provider);

        return $model;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    /**
     * @param string $name
     *
     * @return ChannelModel
     */
    public function setName(string $name): ChannelModel
    {
        $this->setAttribute('name', $name);

        return $this;
    }

    /**
     * @return int
     */
    public function getChannelId(): int
    {
        return $this->getAttribute('channel_id');
    }

    /**
     * @param int $id
     *
     * @return ChannelModel
     */
    public function setChannelId(int $id): ChannelModel
    {
        $this->setAttribute('channel_id', $id);

        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->getAttribute('channel_number');
    }

    /**
     * @param int $number
     *
     * @return ChannelModel
     */
    public function setNumber(int $number): ChannelModel
    {
        $this->setAttribute('channel_number', $number);

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->getAttribute('provider');
    }

    /**
     * @param string $provider
     *
     * @return ChannelModel
     */
    public function setProvider(string $provider): ChannelModel
    {
        $this->setAttribute('provider', $provider);

        return $this;
    }
}
