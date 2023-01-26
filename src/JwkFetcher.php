<?php

namespace YlsIdeas\GoogleJwtVerifier;

interface JwkFetcher
{
    public function fetch(string $uri): array;
}
