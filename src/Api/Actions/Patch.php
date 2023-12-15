<?php

namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Response\OpenzaakResponse;

trait Patch
{
    public function patch(string $uuid, array $params) : Collection
    {
        $url = $this->apiUrl . $this->endpoint . '/' . $uuid;

        $response = OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->patch($url, $params));

        $responseCollection = $this->createCollection($response, 'single');

        if ($this->cache) {
            Cache::put($responseCollection->get('url'), $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
    }
}
