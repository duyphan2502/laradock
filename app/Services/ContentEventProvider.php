<?php
declare(strict_types = 1);

namespace App\Services;

interface ContentEventProvider
{
    /**
     * @param int $channelId
     *
     * @return array
     */
    public function getChannelEvents(int $channelId): array;
}