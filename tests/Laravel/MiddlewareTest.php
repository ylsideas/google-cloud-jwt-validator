<?php

namespace TradeCoverExchange\GoogleJwtVerifier\Tests\Laravel;

use Illuminate\Support\Facades\Route;
use Mockery\MockInterface;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use TradeCoverExchange\GoogleJwtVerifier\JwtVerifier;
use TradeCoverExchange\GoogleJwtVerifier\Laravel\GoogleJwtVerifier;

class MiddlewareTest extends TestCase
{
    public function testValidatesVerifiableTokens()
    {
        $this->withoutExceptionHandling();

        $this->mock(JwtVerifier::class, function (MockInterface $mock) {
            $mock->shouldReceive('verify')
                ->with(
                    'VALID',
                    GoogleJwtVerifier::CERT_URL,
                    'test@example.com',
                    'http://localhost/test',
                    GoogleJwtVerifier::VALUE_ISSUER
                )
                ->once()
                ->andReturn(true);
        });

        $this
            ->withHeader('Authorization', 'Bearer VALID')
            ->get('/test')
            ->assertSuccessful();
    }

    public function testMiddlewareBlocksUnauthorisedRequests()
    {
        $this->mock(JwtVerifier::class, function (MockInterface $mock) {
            $mock->shouldReceive('verify')
                ->never();
        });

        $this->withoutExceptionHandling([
            HttpException::class,
        ])
            ->get('/test')
            ->assertUnauthorized();
    }

    public function testMiddlewareBlocksRequests()
    {
        $this->mock(JwtVerifier::class, function (MockInterface $mock) {
            $mock->shouldReceive('verify')
                ->with(
                    'INVALID',
                    GoogleJwtVerifier::CERT_URL,
                    'test@example.com',
                    'http://localhost/test',
                    GoogleJwtVerifier::VALUE_ISSUER
                )
                ->once()
                ->andReturn(false);
        });

        $this->withoutExceptionHandling([
            HttpException::class,
        ])
            ->withHeader('Authorization', 'Bearer INVALID')
            ->get('/test')
            ->assertUnauthorized();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        Route::middleware(GoogleJwtVerifier::middleware('test@example.com'))
            ->get('/test', function () {
                return response('');
            });
    }
}
