<?php

namespace DRG\Welcome;

use Illuminate\Support\ServiceProvider;

class WelcomeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->addConfig();
        $this->addView();
        $this->addRoutes();
    }

    private function addConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/welcome.sidebar.php', 'package.sidebar');
    }

    private function addView() {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'welcome');
    }

    private function addRoutes()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
    }
}
