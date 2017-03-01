<?php
declare(strict_types = 1);

namespace App\Model;

use Morilog\InfinityCache\Model as InfinityCacheModel;

/**
 * Abstract model with cache
 */
abstract class AbstractCacheableModel extends InfinityCacheModel
{
    /**
     * {@inheritdoc}
     */
    public $incrementing = false;
}
