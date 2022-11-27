<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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

        Storage::disk('local')->buildTemporaryUrlsUsing(function ($path, $expiration, $options) {
            return URL::temporarySignedRoute(
                'local.temp',
                $expiration,
                array_merge($options, ['path' => $path])
            );
        });

        if (env('APP_ENV') !== 'local') {
                $this->app['request']->server->set('HTTPS', true);
        }
    }
}
