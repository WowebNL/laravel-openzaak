<?php

namespace Woweb\Openzaak\Api\Endpoints\Besluiten;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Patch;
use Woweb\Openzaak\Api\Actions\Store;

class Besluiten extends AbstractEndpoint
{
    use GetAll, GetSingle, Store, Patch;

    protected $apiName = 'besluiten';

    protected $endpoint = 'besluiten';
}
