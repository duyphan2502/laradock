<?php
namespace App\Transformer;

use App\Model\ChannelEventModel;
use League\Fractal\TransformerAbstract;

class ChannelEventModelTransformer extends TransformerAbstract
{
    /**
     * @param ChannelEventModel $event
     *
     * @return array
     */
    public function transform(ChannelEventModel $event)
    {
        return $event->getAttributes();
    }
}