<?php

namespace Woweb\Openzaak;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Connection\OpenklantConnection;

class OpenKlant 
{

    /** @var OpenklantConnection */
    private $connection;

    public function __construct(?OpenklantConnection $connection = null)
    {
        if(!$connection) {
            $connection = new OpenklantConnection();
        }
    
        $this->connection = $connection;
    }

    public function storeKlant(array $data) : Collection
    {
        $url = str_replace('{type}', 'klanten', $this->connection->getBaseUrl()) . 'klanten';
     
        $response = Http::withHeaders($this->connection->getHeaders())
            ->post($url, $data);

        return collect($response->body());
    }

    public function getAll() : Collection 
    {
        $url = str_replace('{type}', 'klanten', $this->connection->getBaseUrl()) . 'klanten'; 
        $response = Http::withHeaders($this->connection->getHeaders())
        ->get($url);

         return collect(json_decode($response->body())->results);
    }

}