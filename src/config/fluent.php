<?php

return [

     /*
    |--------------------------------------------------------------------------
    | Facebook app credentials
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for facebook app that will use
    | fluentfb package api to read and write to facebook social graph.
    |
    */

   'facebook' => [
        'client_id' => env('FB_APP_ID'),
        'client_secret' => env('FB_APP_SECRET'),
        'redirect_uri' => env('FB_REDIRECT_URI'),
    ],
];