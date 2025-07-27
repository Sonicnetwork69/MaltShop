<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Schema;
use App\Models\Permission;
use Illuminate\Contracts\Auth\Guard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Check boot method is loaded or not.
     *
     * @var boolean
     */
    public $isBooted;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        Schema::defaultStringLength(191);
        error_reporting(E_ALL);

        // Check if the app is installed or not & if the request is not from console
        if (!$this->app->runningInConsole() && env('APP_INSTALL') == true) {
            View::composer('*', function ($view) use ($auth) {

                // Pass the view name to the view
                $data['view_name'] = $view->getName();

                // Check if the boot method is loaded or not
                if (!$this->isBooted) {
                    $data['prms'] = Permission::getAuthUserPermission(optional($auth->user())->id);
                    $view->with($data);
                    $this->isBooted = true;
                }
            });
        }
    }
}
