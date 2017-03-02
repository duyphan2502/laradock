<?php
declare(strict_types = 1);

namespace App\DTO;

use Swagger\Annotations as SWG;
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
     * @var integer
     *
     * @SWG\Property(description="Channel ID", type="integer")
     * @var integer
     */
    protected $channelId;

    /**
     * @var string
     *
     * @SWG\Property(description="Channel Name", type="string")
     * @var string
     */
    protected $channelTitle;

    /**
     * @var int
     * @SWG\Property(description="Channel Nerumb", type="int")
     * @var int
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
        $this->channelId        = array_get($data, 'channelId');
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

    /**
     * @return integer
     */
    public function getChannelId(): int
    {
        return $this->channelId;
    }
}
