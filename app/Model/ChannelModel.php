<?php
declare(strict_types = 1);

namespace App\Model;

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
        'provider',
    ];

    /**
     * @param string $name
     * @param int    $number
     * @param string $provider
     *
     * @return ChannelModel
     */
    public static function init(string $name, int $number, string $provider)
    {
        $model = new static();
        $model->setName($name);
        $model->setNumber($number);
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
