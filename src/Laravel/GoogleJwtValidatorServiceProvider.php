<?php

namespace TradeCoverExchange\GoogleJwtVerifier\Laravel;

use Illuminate\Support\ServiceProvider;
use TradeCoverExchange\GoogleJwtVerifier\JwkFetcher;

class GoogleJwtValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(JwkFetcher::class, HttpClientJwkFetcher::class);
    }
}
