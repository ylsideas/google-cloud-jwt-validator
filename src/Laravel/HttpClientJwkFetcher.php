<?php

namespace TradeCoverExchange\GoogleJwtVerifier\Laravel;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Client\Factory as Http;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use TradeCoverExchange\GoogleJwtVerifier\JwkFetcher;

class HttpClientJwkFetcher implements JwkFetcher
{
    /**
     * @var Http
     */
    private $http;
    /**
     * @var Cache
     */
    private $cache;

    public function __construct(Http $http, Cache $cache)
    {
        $this->http = $http;
        $this->cache = $cache;
    }

    public function fetch(string $uri): array
    {
        return $this->http
            ->withMiddleware(
                new CacheMiddleware(
                    new PrivateCacheStrategy(
                        new LaravelCacheStorage(
                            $this->cache
                        )
                    )
                ),
                'cache'
            )
            ->get($uri)
            ->json();
    }
}
