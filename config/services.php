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
        'client_id' => '340370763039912',         // Your GitHub Client ID
        'client_secret' => '0ae22babb52b30dc130bab554d244f61', // Your GitHub Client Secret
        'redirect' => 'https://www.libyacv.com/login/facebook/callback/',
    ],
    'google' => [
        'client_id' => '996842140943-4916fs6afh7jtqc419645rtgse6sgi70.apps.googleusercontent.com',         // Your GitHub Client ID
        'client_secret' => '351gEOUenhovb5-T3JEAx353', // Your GitHub Client Secret
        'redirect' => 'https://www.libyacv.com/login/google/callback/',
    ],


];
