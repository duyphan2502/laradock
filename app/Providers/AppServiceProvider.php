<?php

namespace App\Providers;

use App\Repository\ChannelRepository;
use App\Services\BroadcastingProvider;
use App\Transformer\AstroModelTransformer;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        $this->app->singleton(
            \App\Astro\Client::class,
            function () {

                $stack = $this->getClientHandler();

                $httpClient = new Client(
                    [
                        'handler'                       => $stack,
                        RequestOptions::TIMEOUT         => env('HTTP_CLIENT_TIMEOUT', 30),
                        RequestOptions::CONNECT_TIMEOUT => env('HTTP_CLIENT_CONNECT_TIMEOUT', 5),
                    ]
                );

                return new \App\Astro\Client($httpClient, env('ASTRO_ENDPOINT', 'http://ams-api.astro.com.my'));
            }
        );

        $this->app->singleton(
            BroadcastingProvider::class,
            function () {
                $provider = new BroadcastingProvider(app(ChannelRepository::class), app(AstroModelTransformer::class));

                return $provider->registerProvider(app(\App\Astro\Client::class));
            }
        );
    }

    /**
     * @return HandlerStack
     */
    protected function getClientHandler(): HandlerStack
    {
        $stack = new HandlerStack(\GuzzleHttp\choose_handler());
        $stack->push(Middleware::httpErrors(), 'http_errors');
        $stack->push(Middleware::cookies(), 'cookies');
        $stack->push(Middleware::prepareBody(), 'prepare_body');

        return $stack;
    }
}
