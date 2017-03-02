<?php
namespace App\Transformer;

use App\DTO\ChannelEvent;
use League\Fractal\TransformerAbstract;

class ChannelEventTransformer extends TransformerAbstract
{
    /**
     * @param ChannelEvent $event
     *
     * @return array
     */
    public function transform(ChannelEvent $event)
    {
        return $event->getData();
    }
}