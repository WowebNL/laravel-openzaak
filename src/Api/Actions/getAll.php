<?php
namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait GetAll
{
    public function getAll(array $params = []) : Collection
    {
        $params = $this->applyFilterToParams($params);
        
        $cacheName = $this->getAllUrl($params);
        $responseCollection = $this->getMany($this->endpoint, $params, $cacheName);

        if($this->cache) {
            Cache::put($cacheName, $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
    }

    public function getAllRaw() : collection 
    {
        return $this->getManyRaw($this->endpoint, []);
    }

    public function getAllUrl(array $params = []) : string 
    {
        $url = $this->getUrl();

        if(!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }

    private function applyFilterToParams(array $params  = [])
    {
        if(isset($this->filterCatalogi) && $this->filterCatalogi && config('openzaak.catalogi_url')) {
            $params['catalogus'] = config('openzaak.catalogi_url');
        }

        return $params;
    }
}