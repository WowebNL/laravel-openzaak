<?php

namespace Woweb\Openzaak\Api;

use Woweb\Openzaak\Api\Endpoints\Catalogi\Catalogussen;
use Woweb\Openzaak\Api\Endpoints\Catalogi\Eigenschappen;
use Woweb\Openzaak\Api\Endpoints\Catalogi\Informatieobjecttypen;
use Woweb\Openzaak\Api\Endpoints\Catalogi\Roltypen;
use Woweb\Openzaak\Api\Endpoints\Catalogi\StatusTypen;
use Woweb\Openzaak\Api\Endpoints\Catalogi\Zaaktypen;
use Woweb\Openzaak\Connection\OpenzaakConnection;

class CatalogiApi
{
    protected $connection;

    public function __construct(OpenzaakConnection $connection)
    {
        $this->connection = $connection;
    }

    public function catalogussen() : Catalogussen
    {
        return new Catalogussen($this->connection);
    }

    public function zaaktypen() : Zaaktypen
    {
        return new Zaaktypen($this->connection);
    }

    public function informatieobjecttypen() : Informatieobjecttypen
    {
        return new Informatieobjecttypen($this->connection);
    }

    public function roltypen() : Roltypen
    {
        return new Roltypen($this->connection);
    }

    public function eigenschappen() : Eigenschappen
    {
        return new Eigenschappen($this->connection);
    }

    public function statustypen() : StatusTypen
    {
        return new StatusTypen($this->connection);
    }
}