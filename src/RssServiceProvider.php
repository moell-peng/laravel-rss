<?php

namespace Moell\LaravelRss;

use Illuminate\Support\ServiceProvider;
use Moell\Rss\Rss;

class RssServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rss', function($app) {
            return new Rss();
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['rss'];
    }
}
