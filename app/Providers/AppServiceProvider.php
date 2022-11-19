<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        LogViewer::auth(function ($request) {
            return Auth::user()->permissions()['log_viewer'];
        });

        if (env('APP_ENV') !== 'local') {
                $this->app['request']->server->set('HTTPS', true);
        }
    }
}
