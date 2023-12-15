<?php 

namespace Woweb\Openzaak\Transformers;

use Illuminate\Support\Collection;

Trait ResponseTransformer
{
    /**
     * Creates a collection from the response and ads the uuid
     *
     * @param array $results
     * @param string $type
     * @return Collection
     */
    protected function createCollection(array $results, string $type = '') : Collection
    {
        $collection = collect($results);

        if($type === 'single') {
            if(!$collection->get('uuid')) {
                $collection->put('uuid', substr($collection->get('url'), strrpos($collection->get('url'), '/') + 1));
            }
        } else {
            $collection->transform(function($item) {
                if(!isset($item['uuid'])) {
                    $item['uuid'] = substr($item['url'], strrpos($item['url'], '/') + 1);
                }                
                return $item;
            });
        }   
        
        return $collection;
    }
}