<?php

namespace Modules\GoogleAnalytics\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/analytics.php',
            'analytics'
        );
    }
}
