<?php

namespace YlsIdeas\GoogleJwtVerifier\Laravel;

use Illuminate\Support\ServiceProvider;
use YlsIdeas\GoogleJwtVerifier\JwkFetcher;

class GoogleJwtValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (method_exists($this->app, 'scoped')) {
            $this->app->scoped(JwkFetcher::class, HttpClientJwkFetcher::class);
        } else {
            $this->app->singleton(JwkFetcher::class, HttpClientJwkFetcher::class);
        }
    }
}
