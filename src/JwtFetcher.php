<?php

namespace TradeCoverExchange\GoogleJwtVerifier;

interface JwtFetcher
{
    public function fetch(string $uri) : array;
}
