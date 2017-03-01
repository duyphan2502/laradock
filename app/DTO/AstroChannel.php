<?php
declare(strict_types = 1);

namespace App\DTO;

use App\Services\ChannelInterface;

/**
 * Class AstroChannel
 *
 * @package App\DTO
 * @SWG\Definition(definition="Channel", description="Channel Information")
 */
class AstroChannel implements ChannelInterface
{
    /**
     * @var string
     *
     * @SWG\Property(description="Channel Name", type="string")
     * @var string|null
     */
    protected $channelTitle;

    /**
     * @var int
     * @SWG\Property(description="Channel Nerumb", type="int")
     * @var int|null
     */
    protected $channelStbNumber;

    /**
     * AstroChannel constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->channelTitle     = array_get($data, 'channelTitle');
        $this->channelStbNumber = array_get($data, 'channelStbNumber');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->channelTitle;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->channelStbNumber;
    }
}