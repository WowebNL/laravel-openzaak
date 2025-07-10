<?php

namespace Woweb\Openzaak;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Woweb\Openzaak\Connection\ObjectsApiConnection;

class ObjectsApi 
{
    /**
     * ObjectsApi connection object
     *
     * @var \Woweb\Openzaak\Connection\ObjectsApiConnection
     */
    private $connection;

    public function __construct(?ObjectsApiConnection $connection = null)
    {
        if (!empty($connection)) {
            $this->connection = $connection;
        } else {
            $this->connection = new ObjectsApiConnection();
        }
    }
    
    public function get(string $uuid)
    {
        $url = $this->connection->getBaseUrl() . 'objects/' . $uuid; 
        $response = Http::withHeaders($this->connection->getHeaders())
        ->get($url);

        return collect($response->json());
    }

    public function getAll(array $query = []) : Collection
    {
        $url = $this->connection->getBaseUrl() . 'objects'; 
        $response = Http::withHeaders($this->connection->getHeaders())
        ->get($url, $query);

         return collect(json_decode($response->body())->results);
    }

    public function create(array $data) : Collection
    {
        $url = $this->connection->getBaseUrl() . 'objects';  
        $data = $this->validateCreateData($data);

        $response = Http::withHeaders($this->connection->getHeaders())
        ->post($url, $data);

        return collect($response->json());
    }

    public function update(string $uuid, array $data) : Collection 
    {
        $url = $this->connection->getBaseUrl() . 'objects/' . $uuid; 

        $response = Http::withHeaders($this->connection->getHeaders())
        ->patch($url, $data);

        return collect($response->json());
    }

    /**
     * TODO refactor validator to separate class and do actual validation, quick option for now
     *
     * @param array $data
     * @return array
     */
    private function validateCreateData(array $data) : array
    {
        return $data;
    }
}
