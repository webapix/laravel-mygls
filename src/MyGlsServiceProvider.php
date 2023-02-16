<?php

namespace Webapix\GLS\Laravel;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;
use Webapix\GLS\Client as GlsClient;

class MyGlsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/my-gls.php', 'my-gls');

        $this->publishes([
            __DIR__.'/../config/my-gls.php' => config_path('my-gls.php'),
        ], 'config');

        $this->app->bind(Client::class, function () {
            $client = new Client(new GlsClient(new HttpClient()));

            if (! config('my-gls.accounts.default')) {
                return $client;
            }

            return $client->on('default');
        });
    }
}
