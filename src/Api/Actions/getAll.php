<?php
namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait GetAll
{
    public function getAll(array $params = []) : Collection
    {
        $params = $this->applyFilterToParams($params);
        
        $responseCollection = $this->getMany($this->endpoint, $params);

        if($this->cache) {
            $url = $this->getAllUrl($params);

            Cache::put($url, $responseCollection, $this->cacheTime);
        }

        return $responseCollection;
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