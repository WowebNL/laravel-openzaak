<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Connection settings
    |--------------------------------------------------------------------------
    |
    | Point the url to the OpenZaak environment which you want to use. In the
    | OpenZaak environment you need to create an client id and a client secret.
    | This package uses these information to create an auth token.
    |
    */
   'url'              => env('OPENZAAK_URL', 'https://openzaak.woweb.app/'),
   'client_id'        => env('OPENZAAK_CLIENT_ID', null),
   'client_secret'    => env('OPENZAAK_CLIENT_SECRET', null),
   'catalogi_url'         => env('OPENZAAK_CATALOGI_URL', null),

   'openklant'      => [
        'url'       => env('OPENKLANT_URL', 'https://openklant.woweb.app/')
   ],
   
   // date format which the oz api accepts on the input
   'date_format'     => env('OPENZAAK_DATE_FORMAT', 'Y-m-d'),

   'accept_crs'         => env('OPENZAAK_ACCEPT_CRS', 'EPSG:4326'),
   'content_crs'        => env('OPENZAAK_CONTENT_CRS', 'EPSG:4326'),

   'cache'              => [
       'default'        => false,
       'time'   => [
           'direct'         => env('OPENZAAK_CACHE_TIME_ZAKEN', 1209600),
           'zaken'          => env('OPENZAAK_CACHE_TIME_ZAKEN', 1209600),
           'catalogi'       => env('OPENZAAK_CACHE_TIME_CATALOGI', 31556926),
           'documenten'     => env('OPENZAAK_CACHE_TIME_ZAKEN', 1209600),
       ]
    ],
    'zaakeigenschappen' => [
        'formio_reference'  => env('OPENZAAK_FORMIO_REFERENCE','formulier_referentie')
    ],
    'objectsapi'        => [
        'url'       => env('OBJECTSAPI_URL', 'https://objects-api.woweb.app/'),
        'api_token' => env('OBJECTSAPI_TOKEN', null),
        'objectstype_taak_url'  => env('OBJECTSAPI_OBJECTSTYPE_TAAK_URL', 'https://objecttypes-api.woweb.app/api/v2/objecttypes/d5c77844-7e00-4908-9839-f18a8ac6a045'),
        'upload_form_url'       => env('OBJECTSAPI_UPLOAD_FORM_URL', 'https://app6-accp.nijmegen.nl/#/form/ontwikkel/uploadBijlage')
    ]
];