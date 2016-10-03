<?php

namespace Moell\LaravelRss;

use Illuminate\Support\Facades\Facade;

class RssFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'rss';
    }
}