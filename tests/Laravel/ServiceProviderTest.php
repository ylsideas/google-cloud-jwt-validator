<?php

namespace YlsIdeas\GoogleJwtVerifier\Tests\Laravel;

use Orchestra\Testbench\TestCase;
use YlsIdeas\GoogleJwtVerifier\JwkFetcher;
use YlsIdeas\GoogleJwtVerifier\Laravel\GoogleJwtValidatorServiceProvider;
use YlsIdeas\GoogleJwtVerifier\Laravel\HttpClientJwkFetcher;

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
