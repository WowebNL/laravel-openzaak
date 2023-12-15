<?php

namespace Woweb\Openzaak\Api\Endpoints\Catalogi;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;

class Roltypen extends AbstractEndpoint
{
    use GetAll, GetSingle;

    protected $apiName = 'catalogi';

    protected $endpoint = 'roltypen';
}