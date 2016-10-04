<?php

namespace Moell\LaravelRss;

use Illuminate\Support\ServiceProvider;
use Moell\Rss\Rss;


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
        $this->app->singleton('rss', function($app) {
            return new Rss();
        });
    }
}