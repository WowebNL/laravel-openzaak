<?php

namespace Woweb\Openzaak\Response;

use Illuminate\Http\Client\Response;
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

    private static function validateResponse(Response $response, array $validationRules)
    {
        Validator::make($response, $validationRules)->validate();
    }

    private static function checkResponseCode(Response $response)
    {
        if ($response->failed()) {
            if ($response->status() == 400) {
                // TODO custom exception
                Log::error('OpenZaak response error body: ' . $response->body());
            }
            $response->throw();
        }
    }
}
