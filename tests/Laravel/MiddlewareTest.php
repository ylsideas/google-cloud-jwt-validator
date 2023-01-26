<?php

namespace YlsIdeas\GoogleJwtVerifier\Tests\Laravel;

use Illuminate\Support\Facades\Route;
use Mockery\MockInterface;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use YlsIdeas\GoogleJwtVerifier\Laravel\AuthenticateByOidc;
use YlsIdeas\GoogleJwtVerifier\OidcVerifier;

class MiddlewareTest extends TestCase
{
    public function test_validates_verifiable_tokens()
    {
        $this->withoutExceptionHandling();

        $this->mock(OidcVerifier::class, function (MockInterface $mock) {
            $mock->shouldReceive('verify')
                ->with(
                    'VALID',
                    AuthenticateByOidc::CERT_URL,
                    'test@example.com',
                    'http://localhost/test',
                    AuthenticateByOidc::VALUE_ISSUER
                )
                ->once()
                ->andReturn(true);
        });

        $this
            ->withoutExceptionHandling()
            ->withHeader('Authorization', 'Bearer VALID')
            ->get('/test')
            ->assertSuccessful();
    }

    public function test_middleware_blocks_unauthorised_requests()
    {
        $this->mock(OidcVerifier::class, function (MockInterface $mock) {
            $mock->shouldReceive('verify')
                ->never();
        });

        $this->withoutExceptionHandling([
            HttpException::class,
        ])
            ->get('/test')
            ->assertUnauthorized();
    }

    public function test_middleware_blocks_requests()
    {
        $this->mock(OidcVerifier::class, function (MockInterface $mock) {
            $mock->shouldReceive('verify')
                ->with(
                    'INVALID',
                    AuthenticateByOidc::CERT_URL,
                    'test@example.com',
                    'http://localhost/test',
                    AuthenticateByOidc::VALUE_ISSUER
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
        Route::middleware(AuthenticateByOidc::middleware('test@example.com'))
            ->get('/test', function () {
                return response('');
            });
    }
}
