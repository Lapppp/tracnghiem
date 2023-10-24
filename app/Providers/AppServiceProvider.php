<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Dotenv\Dotenv;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $env = '.env.'.$this->app->environment();
        if (App::environment(['local', 'staging'])) {
            $env = '.env';
        }

        Dotenv::createMutable(base_path(), $env)->load();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       // $this->app['request']->server->set('HTTPS','on'); // this line
        //URL::forceScheme('https');

//        if (env('APP_ENV') === 'production') {
//            $this->app['request']->server->set('HTTPS','on'); // this line
//            URL::forceSchema('https');
//        }
    }
}
