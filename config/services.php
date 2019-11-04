<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [ //can change to any provider
        'client_id' => '456475671908657',
        'client_secret' => 'f2113b8dc7c6f81aa40909d4f884d2fa',
        'redirect' => 'http://politi.dev/login/facebook/callback',
    ],

    'twitter' => [ //can change to any provider
        'client_id' => 'eg38PEmOHoFtk9IfFbiuRJ8Kg',
        'client_secret' => 'gKZGoKOCecD16cKiWFxUzuW3yDIpjReha2dRBHrwIZwjtU2KBv',
        'redirect' => 'http://politi.dev/login/twitter/callback',
    ],

    'google' => [ //can change to any provider
        'client_id' => '384403100470-icskatg1mdd8okfd25tcgqhqohehsn6k.apps.googleusercontent.com',
        'client_secret' => 'Ry1xqa6VUuGf3bJ6h8vcslab',
        'redirect' => 'http://politi.dev/login/google/callback',
    ],

    'linkedin' => [ //can change to any provider
        'client_id' => '86j8svhehg1chk',
        'client_secret' => 'vHlwIu5bh4X6htBQ',
        'redirect' => 'http://politi.dev/login/linkedin/callback',
    ],

];
