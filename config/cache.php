<?php

return [

    'default' => 'file', // UBAH INI DARI env('CACHE_DRIVER', 'file') MENJADI 'file'

    'stores' => [
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
            'lock_connection' => null,
        ],

        'file' => [ // INI ADALAH DRIVER YANG AKAN KITA GUNAKAN
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        // ... konfigurasi lainnya tetap
    ],

    'prefix' => 'laravel_cache',
];
