<?php

namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait GetSingle
{
    public function get(string $uuid, array $expand = []) : Collection
    {
        $responseCollection = $this->getSingle($this->endpoint, $uuid, $expand);

        if($this->cache) {
            Cache::put($responseCollection->get('url'), $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
    }
}