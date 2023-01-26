<?php

namespace YlsIdeas\GoogleJwtVerifier;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use YlsIdeas\GoogleJwtVerifier\Exceptions\FailedToDecodeException;
use YlsIdeas\GoogleJwtVerifier\Exceptions\InvalidAudienceException;
use YlsIdeas\GoogleJwtVerifier\Exceptions\InvalidEmailException;
use YlsIdeas\GoogleJwtVerifier\Exceptions\InvalidIssuerException;

class OidcVerifier
{
    /**
     * @var JwkFetcher
     */
    private $fetcher;

    public function __construct(JwkFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function verify(
        string $jsonWebToken,
        string $jwkUri,
        string $email,
        string $audience = null,
        string $issuer = null,
        bool $throwExceptions = false
    ): bool {
        $key = JWK::parseKeySet($this->fetcher->fetch($jwkUri));

        try {
            $token = JWT::decode($jsonWebToken, $key);
        } catch (\UnexpectedValueException $exception) {
            if ($throwExceptions) {
                throw new FailedToDecodeException();
            }

            return false;
        }

        if ($token->email !== $email) {
            if ($throwExceptions) {
                throw new InvalidEmailException();
            }

            return false;
        } elseif ($audience && $token->aud !== $audience) {
            if ($throwExceptions) {
                throw new InvalidAudienceException();
            }

            return false;
        } elseif ($issuer && $token->iss !== $issuer) {
            if ($throwExceptions) {
                throw new InvalidIssuerException();
            }

            return false;
        }

        return true;
    }
}
