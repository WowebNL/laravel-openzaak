<?php

namespace Woweb\Openzaak\Api\Endpoints\Zaken\Nested;

use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Patch;
use Woweb\Openzaak\Api\Actions\Store;
use Woweb\Openzaak\Connection\OpenzaakConnection;

class Zaakeigenschappen extends AbstractEndpoint
{
    use GetAll, GetSingle, Store, Patch;

    protected $apiName = 'zaken';

    protected $endpoint = 'zaken/{uuid}/zaakeigenschappen';

    public function __construct(OpenzaakConnection $connection, string $zaakUuid)
    {
        $this->endpoint = str_replace('{uuid}', $zaakUuid, $this->endpoint);
        parent::__construct($connection);
    }
}
