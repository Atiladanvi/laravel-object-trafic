<?php

namespace Atiladanvi\LaravelObjectTrafic;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Atiladanvi\LaravelObjectTrafic\Skeleton\SkeletonClass
 */
class LaravelObjectTraficFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-object-trafic';
    }
}
