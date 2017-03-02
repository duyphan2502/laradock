<?php
declare(strict_types = 1);

namespace App\Services;

/**
 * Interface ChannelInterface
 *
 * @package App\Model
 */
interface ChannelInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getNumber(): int;

    /**
     * @return int
     */
    public function getChannelId(): int;
}