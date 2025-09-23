<?php

namespace Woweb\Openzaak\Api\Endpoints\Documenten;

use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Api\Endpoints\AbstractEndpoint;
use Woweb\Openzaak\Api\Actions\getAll;
use Woweb\Openzaak\Api\Actions\getSingle;
use Woweb\Openzaak\Api\Actions\Store;
use Woweb\Openzaak\Api\Actions\Patch;
use Woweb\Openzaak\Api\Actions\Put;
use Woweb\Openzaak\Response\OpenzaakResponse;

class Enkelvoudiginformatieobjecten extends AbstractEndpoint
{
    use GetAll, GetSingle, Store, Patch, Put;

    protected $apiName = 'documenten';

    protected $endpoint = 'enkelvoudiginformatieobjecten';

     public function lock(string $uuid) : string
    {
        $url = $this->apiUrl . $this->endpoint . '/' . $uuid . '/lock';

        $response = OpenzaakResponse::validate(Http::withHeaders(array_merge($this->connection->getHeaders(), ['Content-Type' => 'application/json']))->post($url, ['body'=> 'not empty']));
        return $response['lock'];
    }

    public function unlock(string $uuid, string $lockString) : ?array
    {
        $url = $this->apiUrl . $this->endpoint . '/' . $uuid . '/unlock';

        return OpenzaakResponse::validate(Http::withHeaders(array_merge($this->connection->getHeaders(), ['Content-Type' => 'application/json']))->post($url, ['lock'=> $lockString]));
    }

    public function audittrail(string $uuid) : array
    {
        $url = $this->apiUrl . $this->endpoint . '/' . $uuid . '/audittrail';

        return OpenzaakResponse::validate(Http::withHeaders($this->connection->getHeaders())->get($url));
    }
}
