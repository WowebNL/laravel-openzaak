<?php

namespace Woweb\Openzaak\Api\Endpoints\Catalogi;

use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;
use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;

class Eigenschappen extends AbstractEndpoint
{
    use GetAll, GetSingle, Store;

    protected $apiName = 'catalogi';

    protected $endpoint = 'eigenschappen';
}
