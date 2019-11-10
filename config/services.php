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
        'client_id' => '545900236196554',
        'client_secret' => 'abf8ed43375f6a57ebd353a21a414fa5',
        'redirect' => 'http://localhost/login/facebook/callback',
    ],

    'yahoo' => [ //can change to any provider
        'client_id' => 'dj0yJmk9cGxCTTBHclhsVDI4JmQ9WVdrOU1UWXlSMU5xTXpBbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTgy',
        'client_secret' => '79266f95d15d6f9a416c4be9e2ebe8dcb4f5a7ac',
        'redirect' => 'http://politi.dev/login/yahoo/callback',
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

    'amazon' => [ //can change to any provider
        'client_id' => 'amzn1.application-oa2-client.2fdc93ddd04e458eaa2a6f21111e4f75',
        'client_secret' => '2140fc8c555380251a8583da128db5b7fefc922bc7f25188bbb684f4c7bb17e4',
        'redirect' => 'http://politi.dev/login/amazon/callback',
    ],

];
