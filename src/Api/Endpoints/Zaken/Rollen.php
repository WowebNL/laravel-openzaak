<?php

namespace Woweb\Openzaak\Api\Endpoints\Zaken;

use Woweb\Openzaak\Api\Actions\Delete;
use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;
use Woweb\Openzaak\Api\Actions\Put;

class Rollen extends AbstractEndpoint
{
    use GetAll, GetSingle, Store, Delete, Put;

    protected $apiName = 'zaken';

    protected $endpoint = 'rollen';
}
