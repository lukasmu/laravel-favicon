<?php

namespace LukasMu\Favicon\Facades;

use Illuminate\Support\Facades\Facade;
use LukasMu\Favicon\FaviconService;

/**
 * @see \LukasMu\Favicon\FaviconService
 */
class Favicon extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FaviconService::class;
    }
}
