<?php

namespace Woweb\Openzaak\Api\Endpoints\Zaken;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Patch;
use Woweb\Openzaak\Api\Actions\Store;
use Woweb\Openzaak\Api\Endpoints\Zaken\Nested\Zaakeigenschappen;

class Zaken extends AbstractEndpoint
{
    use GetAll, GetSingle, Store, Patch;

    protected $apiName = 'zaken';

    protected $endpoint = 'zaken';

    public function zaakeigenschappen(string $zaakUuid)
    {
        return new Zaakeigenschappen($this->connection, $zaakUuid);
    }
}