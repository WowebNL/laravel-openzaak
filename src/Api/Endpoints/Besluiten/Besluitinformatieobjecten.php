<?php

namespace Woweb\Openzaak\Api\Endpoints\Besluiten;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;

class Besluitinformatieobjecten extends AbstractEndpoint
{
    use GetAll, GetSingle, Store;

    protected $apiName = 'besluiten';

    protected $endpoint = 'besluitinformatieobjecten';
}
