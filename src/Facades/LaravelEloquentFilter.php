<?php

namespace Walshdev\LaravelEloquentFilter\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEloquentFilter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-eloquent-filter';
    }
}
