<?php

namespace TradeCoverExchange\GoogleJwtVerifier\Laravel;

use Closure;
use Illuminate\Http\Response;
use TradeCoverExchange\GoogleJwtVerifier\OidcVerifier;

class AuthenticateByOidc
{
    public const CERT_URL = 'https://www.googleapis.com/oauth2/v3/certs';
    public const VALUE_ISSUER = 'https://accounts.google.com';

    /**
     * @var OidcVerifier
     */
    private $verifier;

    public static function middleware(string $email): string
    {
        return self::class . ':' . $email;
    }

    public function __construct(OidcVerifier $verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $email
     * @return mixed
     */
    public function handle($request, Closure $next, $email)
    {
        abort_if(! $request->bearerToken(), Response::HTTP_UNAUTHORIZED);
        abort_if(
            ! $this->verifier->verify(
                (string) $request->bearerToken(),
                self::CERT_URL,
                $email,
                $request->fullUrl(),
                self::VALUE_ISSUER
            ),
            Response::HTTP_UNAUTHORIZED
        );

        return $next($request);
    }
}
