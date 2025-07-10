<?php

namespace Woweb\Openzaak\Api\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Response\OpenzaakResponse;

trait Delete
{
    public function delete(String $uuid) : bool
    {
        $url = $this->apiUrl . $this->endpoint . '/' . $uuid;

        return OpenzaakResponse::validateDelete(Http::withHeaders($this->connection->getHeaders())->delete($url));
    }
}