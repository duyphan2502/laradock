<?php
declare(strict_types = 1);

namespace App\Transformer;

use App\Services\ChannelInterface;
use League\Fractal\TransformerAbstract;

class ChannelArrayTransformer extends TransformerAbstract
{
    /**
     * @param ChannelInterface $channel
     *
     * @return array
     */
    public function transform(ChannelInterface $channel)
    {
        return [
            'channelTitle'     => $channel->getName(),
            'channelStbNumber' => $channel->getNumber(),
            'channelId'        => $channel->getChannelId(),
        ];
    }
}