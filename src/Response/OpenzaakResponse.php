<?php

namespace Woweb\Openzaak\Response;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Validator;
use Log;

class OpenzaakResponse
{
    public static function validate(Response $response, array $validationRules = [])
    {
        self::checkResponseCode($response);

        if (!empty($validationRules)) {
            self::validateResponse($response->json(), $validationRules);
        }

        return $response->json();
    }

    public static function validateDelete(Response $response) : bool
    {
        if($response->status() == 204 && empty($response->body())) {
            return true;
        } else if($response->failed()) {
            FacadesLog::error('OpenZaak delete response error body: ' . $response->body());
            $response->throw();
        }

        return false;
    }
    private static function validateResponse(Response $response, array $validationRules)
    {
        Validator::make($response, $validationRules)->validate();
    }

    private static function checkResponseCode(Response $response)
    {
        if ($response->failed()) {
            if ($response->status() == 400) {
                FacadesLog::error('OpenZaak response error body: ' . $response->body());
            }
            $response->throw();
        }
    }
}
