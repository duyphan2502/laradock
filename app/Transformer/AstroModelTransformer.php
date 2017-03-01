<?php

namespace App\Transformer;

use App\DTO\AstroChannel;
use App\Model\ChannelModel;

/**
 * Class AstroModelTransformer
 *
 * @package App\Transformer
 */
class AstroModelTransformer
{
    /**
     * @param ChannelModel $model
     *
     * @return AstroChannel
     */
    public function transform(ChannelModel $model)
    {
        $data = ['channelTitle' => $model->getName(), 'channelStbNumber' => $model->getNumber()];

        $channel = new AstroChannel($data);

        return $channel;
    }
}