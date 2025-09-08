<?php

namespace Woweb\Openzaak\Api\Endpoints;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Connection\OpenzaakConnection;
use Woweb\Openzaak\Response\OpenzaakResponse;
use Woweb\Openzaak\Transformers\ResponseTransformer;

class DirectEndpoint
{
    use ResponseTransformer;

    /**
     * @var Woweb\Openzaak\Connection\OpenzaakConnection
     */
    protected $connection;

    /**
     * enable / disable caching the response
     *
     * @var bool
     */
    protected $cache;

    /**
     * Time to cache the response
     *
     * @var int
     */
    protected $cacheTime;

    /**
     * Inject connection and set up default param values
     *
     * @param OpenzaakConnection $connection
     */
    public function __construct(OpenzaakConnection $connection)
    {
        $this->connection = $connection;
        
        $this->cache = config('openzaak.cache.default', false);
        $this->cacheTime = config('openzaak.cache.time.direct', 0);
    }

    /**
     * Get a single object by full api url
     *
     * @param string $url
     * @return Collection
     */
    public function getByUrl(string $url, $forceCache = false) : Collection
    {
        $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->get($url));
        
        $responseCollection = $this->createCollection($response, 'single');

        if($forceCache) {
            Cache::put($url, $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
    }

    /**
     * Get the body by full api url
     *
     * @param string $url
     * @return string
     */
    public function getRawByUrl(string $url) : string
    {
        return Http::withHeaders($this->connection->getHeaders())->get($url)->body();
    }
}
