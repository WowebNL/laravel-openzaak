<?php

namespace Woweb\Openzaak\Connection;

class ObjectsApiConnection 
{
    private $baseUrl;

    private $apiVersion = 2;

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
        $this->baseUrl = config('openzaak.objectsapi.url') . 'api/v' . $this->apiVersion .'/';
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders(array $headers = [])
    {
        $this->headers = array_merge($headers, [
            'Authorization' => 'Token ' . config('openzaak.objectsapi.api_token'),
            'Accept-Crs'    => config('openzaak.accept_crs'),
            'Content-Crs'   => config('openzaak.content_crs'),
            'Content-Type'  => 'application/json'
        ]);
    }
}