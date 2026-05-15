<?php

namespace Laraartisan\SsoClient;

use Illuminate\Support\ServiceProvider;

class SsoClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sso-client.php', 'sso-client');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/sso-client.php' => config_path('sso-client.php'),
        ], 'sso-client-config');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
