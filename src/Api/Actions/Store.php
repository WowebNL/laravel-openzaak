<?php

namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Response\OpenzaakResponse;

trait Store
{
    public function store(array $params) : Collection
    {
        $url = $this->apiUrl . $this->endpoint;

        $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->post($url, $params));
        
        $responseCollection = $this->createCollection($response, 'single');

        if($this->cache) {
            Cache::put($responseCollection->get('url'), $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
    }
}