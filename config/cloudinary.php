<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tu Cloudinary Cloud Name
    |--------------------------------------------------------------------------
    */
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Tu Cloudinary API Key
    |--------------------------------------------------------------------------
    */
    'api_key'    => env('CLOUDINARY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Tu Cloudinary API Secret
    |--------------------------------------------------------------------------
    */
    'api_secret' => env('CLOUDINARY_API_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | URL construida a partir de las 3 variables si no existe CLOUDINARY_URL
    |--------------------------------------------------------------------------
    */
    'url' => env(
        'CLOUDINARY_URL',
        'cloudinary://'
          . env('CLOUDINARY_API_KEY')
          . ':'
          . env('CLOUDINARY_API_SECRET')
          . '@'
          . env('CLOUDINARY_CLOUD_NAME')
    ),

    // ...otras opciones si tuvieras...
];

