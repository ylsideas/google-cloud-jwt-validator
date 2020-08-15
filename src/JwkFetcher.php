<?php

namespace TradeCoverExchange\GoogleJwtVerifier;

interface JwkFetcher
{
    public function fetch(string $uri) : array;
}
