<?php

namespace Woweb\Openzaak\Api;

use Woweb\Openzaak\Api\Endpoints\Besluiten\Besluiten;
use Woweb\Openzaak\Api\Endpoints\Zaken\Rollen;
use Woweb\Openzaak\Api\Endpoints\Zaken\Zaakinformatieobjecten;
use Woweb\Openzaak\Api\Endpoints\Zaken\Zaken;
use Woweb\Openzaak\Connection\OpenzaakConnection;

class BesluitenApi
{
    protected $connection;

    public function __construct(OpenzaakConnection $connection)
    {
        $this->connection = $connection;
    }

    public function besluiten() : Besluiten
    {
        return new Besluiten($this->connection);
    }
}