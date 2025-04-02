<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],



    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'khachhang' => [
            'driver'    => 'session',
            'provider'  => 'khachhangprovider',
        ],
        'taixe' => [
            'driver'    => 'session',
            'provider'  => 'taixeprovider',
        ],
    ],



    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'khachhangprovider' => [
            'driver'    => 'eloquent',
            'model'     => \App\Models\KhachHang::class,
        ],
        'taixeprovider' => [
            'driver'    => 'eloquent',
            'model'     => \App\Models\TaiXe::class,
        ],
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],



    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
