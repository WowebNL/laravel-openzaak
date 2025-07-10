<?php

namespace Woweb\Openzaak\Api\Endpoints\Documenten;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;

class Gebruiksrechten extends AbstractEndpoint
{
    use GetAll, GetSingle, Store;

    protected $apiName = 'documenten';

    protected $endpoint = 'gebruiksrechten';
}