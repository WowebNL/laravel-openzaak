<?php

namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Response\OpenzaakResponse;

trait Put
{
    public function put(string $uuid, array $params) : Collection
    {
        $url = $this->apiUrl . $this->endpoint . '/' . $uuid;

        $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->put($url, $params));

        $responseCollection = $this->createCollection($response, 'single');

        if ($this->cache) {
            Cache::put($responseCollection->get('url'), $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
    }
}
