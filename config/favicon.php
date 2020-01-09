<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Favicon Text
    |--------------------------------------------------------------------------
    |
    | This is the text that is going to be displayed in the favicon
    */

    'text' => env('FAVICON_TEXT', substr(config('app.name', 'L'), 0, 1)),

    /*
    |--------------------------------------------------------------------------
    | Favicon Graphic Settings
    |--------------------------------------------------------------------------
    |
    | Some graphical settings to determine the appearance of the favicon
    |
    | The margin and border radius settings are in percent of the smallest
    | dimension of the icon (either width or height).
    */

    'font' => env('FAVICON_FONT',
        base_path('vendor/aerdes/laravel-favicon/resources/fonts/Roboto-Regular.ttf')),
    'color' => env('FAVICON_COLOR', '#ffffff'),
    'bg-color' => env('FAVION_BG_COLOR', '#007bff'),
    'margin' => env('FAVICON_MARGIN', 5),
    'border-radius' => env('FAVICON_BORDER_RADIUS', 5),


    /*
    |--------------------------------------------------------------------------
    | Favicon Technical Settings
    |--------------------------------------------------------------------------
    |
    | Some technical options that influence how the favicon is generated
    */

    'image_driver' => 'gd',
    'generator' => \Aerdes\LaravelFavicon\Generators\DefaultGenerator::class,

];