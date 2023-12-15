<?php

namespace Woweb\Openzaak;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Woweb\Openzaak\Api\BesluitenApi;
use Woweb\Openzaak\Api\CatalogiApi;
use Woweb\Openzaak\Api\Endpoints\DirectEndpoint;
use Woweb\Openzaak\Api\DocumentenApi;
use Woweb\Openzaak\Api\ZakenApi;
use Woweb\Openzaak\Connection\OpenzaakConnection;

class Openzaak
{
    /**
     * Open Zaak connection object
     *
     * @var \Woweb\Openzaak\Connection\OpenzaakConnection
     */
    private $connection;

    public function __construct(?OpenzaakConnection $connection = null)
    {
        if (!empty($connection)) {
            $this->connection = $connection;
        } else {
            $this->connection = new OpenzaakConnection();
        }
    }

    /**
     * Catalogi api object
     *
     * @return Woweb\Openzaak\Api\CatalogiApi
     */
    public function catalogi() : CatalogiApi
    {
        return new CatalogiApi($this->connection);
    }

    /**
     * Zaken api object
     *
     * @return Woweb\Openzaak\Api\ZakenApi
     */
    public function zaken() : ZakenApi
    {
        return new ZakenApi($this->connection);
    }

    /**
     * Besluiten api object
     *
     * @return Woweb\Openzaak\Api\ZakenApi
     */
    public function besluiten() : BesluitenApi
    {
        return new BesluitenApi($this->connection);
    }

    /**
     * Documenten api object
     *
     * @return Woweb\Openzaak\Api\DocumentenApi
     */
    public function documenten() : DocumentenApi
    {
        return new DocumentenApi($this->connection);
    }

    /**
     * Shortcut to get the response by full provided api url
     *
     * @param string $url url to preform get request to
     * @param $forceCache forces the response to be stored in the cache driver
     *
     * @return Illuminate\Support\Collection
     */
    public function get(string $url, bool $forceCache = false) : Collection
    {
        return (new DirectEndpoint($this->connection))->getByUrl($url, $forceCache);
    }

    /**
     * Check if the data related to the url is in the current cache driver,
     * if so return the cached data, if not then call the url and store the
     * response in the cache driver before returning the collection
     *
     * @param string $url
     * @return  Illuminate\Support\Collection
     */
    public static function getCached(string $url) : Collection
    {
        return Cache::get($url, function () use ($url) {
            return (new self())->get($url, true);
        });
    }
}
