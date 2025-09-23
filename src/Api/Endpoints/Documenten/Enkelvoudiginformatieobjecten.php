<?php

namespace Woweb\Openzaak\Api\Endpoints\Documenten;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;
use Woweb\Openzaak\Api\Actions\Patch;
use Woweb\Openzaak\Api\Actions\Put;

class Enkelvoudiginformatieobjecten extends AbstractEndpoint
{
    use GetAll, GetSingle, Store, Patch, Put;

    protected $apiName = 'documenten';

    protected $endpoint = 'enkelvoudiginformatieobjecten';
}
