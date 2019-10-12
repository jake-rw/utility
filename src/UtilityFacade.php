<?php

namespace Jakerw\Utility;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jakerw\Utility\Skeleton\SkeletonClass
 */
class UtilityFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'utility';
    }
}
