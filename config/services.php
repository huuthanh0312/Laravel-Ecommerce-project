<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '266365325696-stkrl13942p27i9lpqvcbig6gslj53e4.apps.googleusercontent.com',
        'client_secret' => 'FS5l_wzdP8yT9EkeUTux6RDa',
        'redirect' => 'http://localhost/ecommerce/ecommerce/callback/google',
      ], 
      'facebook' => [
        'client_id' => '983236535798381',
        'client_secret' => '5cff1d5bd146b597179e99cc07dbf601',
        'redirect' => 'http://localhost/ecommerce/ecommerce/callback/facebook',
      ],

];
