<?php

namespace Woweb\Openzaak\Api\Endpoints;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Connection\OpenzaakConnection;
use Woweb\Openzaak\Response\OpenzaakResponse;
use Woweb\Openzaak\Transformers\ResponseTransformer;

abstract class AbstractEndpoint
{
    use ResponseTransformer;
    /**
     * @var string
     */
    protected $apiName = 'zaken';

    /**
     * @var Woweb\Openzaak\Connection\OpenzaakConnection
     */
    protected $connection;

    /**
     * @var string
     */
    protected $apiUrl;

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

        if (empty($this->apiName)) {
            throw new Exception('Api name missing for ' . get_class());
        }

        $this->apiUrl = str_replace('{type}', $this->apiName, $this->connection->getBaseUrl());

        $this->cache     = config('openzaak.cache.default', false);
        $this->cacheTime = config('openzaak.cache.time.' . $this->apiName, 0);
    }

    /**
     * Call an GET endpoint which returns multiple results
     *
     * @param string $endpoint
     * @param array $params
     * @return Illuminate\Support\Collection
     */
    protected function getMany(string $endpoint, array $params = [], ?string $cacheName = null) : Collection
    {
        if($cacheName && Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        
        $url = $this->apiUrl . $endpoint;

        $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->get($url, $params));

        $results = Arr::has($response, 'results') ? $this->getResults($response, []) : $response;
        return $this->createCollection($results);
    }

    protected function getManyRaw(string $endpoint, array $params = []) : Collection 
    {
        $url = $this->apiUrl . $endpoint;

        return collect(json_decode(Http::withHeaders($this->connection->getHeaders())->get($url, $params)->body())); 
    }

    /**
     * Call an GET endpoint which returns multiple results
     *
     * @param string $endpoint
     * @param array $params
     * @return Illuminate\Support\Collection
     */
    protected function getSingle(string $endpoint, string $uuid, array $expand = []) : Collection
    {
        $url = $this->apiUrl . $endpoint . '/' . $uuid;

        $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->get($url, [
            'expand' => implode(',', $expand)
        ]));
        
        return $this->createCollection($response, 'single');
    }

    /**
     * Handles a multiple results response and checks for the next indicator, if the next indicator is not empty call it and map
     * the response result to the results array
     *
     * @param array $response
     * @param array $results
     * @return array
     */
    private function getResults(array $response, array $results)
    {
        $items = $response['results'] ?? $response;
        $results = array_merge($results, $items);
        if (!empty($response['next'])) {
            $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->get($response['next']));
            $this->getResults($response, $results);
        }
        return $results;
    }

    public function getUrl()
    {
        return $this->apiUrl . $this->endpoint;
    }

    public function cache()
    {
        $this->cache = true;
        return $this;
    }
}
