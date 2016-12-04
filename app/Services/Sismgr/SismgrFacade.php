<?php
namespace App\Services\Sismgr;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Contracts\Console\Kernel
 */
class SismgrFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Sismgr';
    }
}
