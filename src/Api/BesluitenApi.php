<?php

namespace Woweb\Openzaak\Api;

use Woweb\Openzaak\Api\Endpoints\Besluiten\Besluiten;
use Woweb\Openzaak\Api\Endpoints\Besluiten\Besluitinformatieobjecten;
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

    public function besluitinformatieobjecten() : Besluitinformatieobjecten
    {
        return new Besluitinformatieobjecten($this->connection);
    }
}
