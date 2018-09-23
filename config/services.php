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
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '591018051106688',
        'client_secret' => 'c47fa615aa4a3fdfeac5df569d9dd9c0',
       'redirect' => url('facebook/callback'),
    ],

    'google' => [
        'client_id' => '822097681255-gsbfdpfm06ivvu7qig6ratq69gha9i68.apps.googleusercontent.com',
        'client_secret' => 'PklO3SZWaq2ELXyC-Por8n7Z',
        'redirect' => url('google/callback'),
    ],

];
