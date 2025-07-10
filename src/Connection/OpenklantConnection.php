<?php

namespace Woweb\Openzaak\Connection;

use Exception;
use Illuminate\Support\Facades\Http;
use Woweb\Openzaak\Auth\Authorization;

class OpenklantConnection 
{
    private $baseUrl;

    private $apiVersion = 1;

    private $headers = [];

    public function __construct()
    {
        $this->setBaseUrl();
        $this->setHeaders();
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    private function setBaseUrl()
    {
        $this->baseUrl = config('openzaak.openklant.url') . '{type}/api/v' . $this->apiVersion .'/';
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders(array $headers = [])
    {
        $this->headers = array_merge($headers, [
            'Authorization' => Authorization::getToken(),
            'Accept-Crs'    => config('openzaak.accept_crs'),
            'Content-Crs'   => config('openzaak.content_crs'),
            'Content-Type'  => 'application/json'
        ]);
    }
}