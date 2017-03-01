<?php
declare(strict_types = 1);

namespace App\Services;

/**
 * Interface ContentProvider
 *
 * @package App\Services
 */
interface ContentProvider
{
    /**
     * @return array
     */
    public function getChannels(): array;

    /**
     * @return string
     */
    public function getServiceName(): string;
}