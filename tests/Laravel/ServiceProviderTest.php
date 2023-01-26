<?php

namespace YlsIdeas\GoogleJwtVerifier\Tests\Laravel;

use Orchestra\Testbench\TestCase;
use YlsIdeas\GoogleJwtVerifier\JwkFetcher;
use YlsIdeas\GoogleJwtVerifier\Laravel\GoogleJwtValidatorServiceProvider;
use YlsIdeas\GoogleJwtVerifier\Laravel\HttpClientJwkFetcher;

class ServiceProviderTest extends TestCase
{
    public function test_provides_implementation_for_jwt_fetcher()
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
