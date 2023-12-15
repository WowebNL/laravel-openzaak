<?php

namespace Woweb\Openzaak\Api;

use Woweb\Openzaak\Api\Endpoints\Zaken\Resultaten;
use Woweb\Openzaak\Api\Endpoints\Zaken\Rollen;
use Woweb\Openzaak\Api\Endpoints\Zaken\Statussen;
use Woweb\Openzaak\Api\Endpoints\Zaken\Zaakinformatieobjecten;
use Woweb\Openzaak\Api\Endpoints\Zaken\Zaakobjecten;
use Woweb\Openzaak\Api\Endpoints\Zaken\Zaken;
use Woweb\Openzaak\Connection\OpenzaakConnection;

class ZakenApi
{
    protected $connection;

    public function __construct(OpenzaakConnection $connection)
    {
        $this->connection = $connection;
    }

    public function zaken(): Zaken
    {
        return new Zaken($this->connection);
    }

    public function resultaten(): Resultaten
    {
        return new Resultaten($this->connection);
    }

    public function rollen(): Rollen
    {
        return new Rollen($this->connection);
    }

    public function zaakinformatieobjecten(): Zaakinformatieobjecten
    {
        return new Zaakinformatieobjecten($this->connection);
    }

    /**
     * @return Zaakobjecten
     */
    public function zaakobjecten(): Zaakobjecten
    {
        return new Zaakobjecten($this->connection);
    }

    /**
     * @return Statussen
     */
    public function statussen(): Statussen
    {
        return new Statussen($this->connection);
    }
}
