<?php

return [

    /*
     * The Virtual AGM API URL that will be called.
     * Do not include `/api` as it is already included.
     * Default is the current app's URL.
     */
    'url' => rtrim(
        env('VAGM_URL', env('APP_URL')),
        '/'
    ),

    /*
     * Request headers that will go with all requests made to
     * the Virtual AGM API.
     * Feel free to add more headers here.
     */
    'headers' => [
        'Accept' => 'application/json', // required
        'Connection' => 'keep-alive', // optional
    ],

    /*
     * If requests and responses should be logged.
     */
    'debug' => (bool) env('VAGM_DEBUG', false),

];
