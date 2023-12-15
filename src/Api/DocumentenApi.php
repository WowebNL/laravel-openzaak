<?php

namespace Woweb\Openzaak\Api;

use Woweb\Openzaak\Api\Endpoints\Documenten\Enkelvoudiginformatieobjecten;
use Woweb\Openzaak\Connection\OpenzaakConnection;

class DocumentenApi
{
    protected $connection;

    public function __construct(OpenzaakConnection $connection)
    {
        $this->connection = $connection;
    }

    public function enkelvoudiginformatieobjecten() : Enkelvoudiginformatieobjecten
    {
        return new Enkelvoudiginformatieobjecten($this->connection);
    }

}