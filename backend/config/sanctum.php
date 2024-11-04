<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from these domains/hosts will receive stateful API
    | authentication cookies. Typically, include your local and production
    | domains that access your API via a frontend SPA.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | This array lists the authentication guards that Sanctum will use to
    | authenticate a request. If none of these guards are able to authenticate
    | the request, Sanctum will fallback to the bearer token.
    |
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Token Expiration Time
    |--------------------------------------------------------------------------
    |
    | Define the number of minutes a token is valid before it expires. This will
    | override any "expires_at" attribute set on the token, but it does not
    | affect first-party sessions.
    |
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Specify a prefix for new tokens to leverage various security scanning
    | initiatives that alert developers if tokens are committed into
    | repositories.
    |
    | Documentation: https://docs.github.com/en/code-security/secret-scanning/about-secret-scanning
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | Customize Sanctum's middleware as needed for processing requests when
    | authenticating your first-party SPA.
    |
    */

    'middleware' => [
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
        'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    ],

];
