<?php

namespace Moell\LaravelRss;

use Illuminate\Support\ServiceProvider;
use Moell\Rss;


class RssServiceProvider extends ServiceProvider
{
    /**
     * 延迟加载
     *
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('Moell\Rss\Rss', function($app) {
            return new Rss();
        });
    }
}