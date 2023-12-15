<?php

namespace Woweb\Openzaak\Api\Endpoints\Zaken;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;

class Zaakobjecten extends AbstractEndpoint
{
    use GetAll, GetSingle, Store;

    protected $apiName = 'zaken';

    protected $endpoint = 'zaakobjecten';
}
