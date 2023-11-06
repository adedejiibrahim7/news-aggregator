<?php

return [
    'news_api'  => [
        'base_url'  => env('NEWSAPI_BASE_URL', 'https://newsapi.org/v2'),
        'api_key'   => env('NEWSAPI_API_KEY')
    ],
    'news_cred' => [
        'base_url'  => env('NEWSCRED_BASE_URL', 'https://api.newscred.com'),
        'access_key' => env('NEWSCRED_ACCESS_KEY')
    ],
    'ny_times'  => [
        'base_url'  => env('NYTIMES_BASE_URL', 'https://api.nytimes.com/svc'),
        'api_key'   => env('NYTIMES_API_KEY'),
        'api_secret'   => env('NYTIMES_API_SECRET')
    ],
    'guardian'  => [
        'base_url'  => env('GUARDIAN_BASE_URL', ' https://content.guardianapis.com/search'),
        'api_key'   => env('GUARDIAN_API_KEY'),
    ]
];
