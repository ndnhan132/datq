<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [

        '*',

        'http://localhost', 
        'http://localhost:3000', 
        'http://127.0.0.1', 
        'http://127.0.0.1:3000', 

        '.tanhongfood.com' ,
        'http://tanhongfood.com', 
        'https://tanhongfood.com',
        '.tanhongfood.com:3000' ,
        'http://tanhongfood.com:3000', 
        'https://tanhongfood.com:3000', 


        '.tanhongfood.test' ,
        'http://tanhongfood.test', 
        'https://tanhongfood.test',
        '.tanhongfood.test:3000' ,
        'http://tanhongfood.test:3000', 
        'https://tanhongfood.test:3000', 

    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
