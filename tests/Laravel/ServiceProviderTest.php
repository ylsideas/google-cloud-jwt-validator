<?php

namespace TradeCoverExchange\GoogleJwtVerifier\Tests\Laravel;

use Orchestra\Testbench\TestCase;
use TradeCoverExchange\GoogleJwtVerifier\JwkFetcher;
use TradeCoverExchange\GoogleJwtVerifier\Laravel\GoogleJwtValidatorServiceProvider;
use TradeCoverExchange\GoogleJwtVerifier\Laravel\HttpClientJwkFetcher;

class ServiceProviderTest extends TestCase
{
    public function testProvidesImplementationForJwtFetcher()
    {
        $instance = $this->app->make(JwkFetcher::class);

        $this->assertInstanceOf(HttpClientJwkFetcher::class, $instance);
    }

    protected function getPackageProviders($app)
    {
        return [
            GoogleJwtValidatorServiceProvider::class,
        ];
    }
}
