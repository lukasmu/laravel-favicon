<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Favicon Text
    |--------------------------------------------------------------------------
    |
    | This is the text that is going to be displayed in the favicon.
    */

    'text' => env('FAVICON_TEXT', substr(config('app.name', 'L'), 0, 1)),

    /*
    |--------------------------------------------------------------------------
    | Favicon Graphic Settings
    |--------------------------------------------------------------------------
    |
    | Some graphical settings to determine the appearance of the favicon.
    |
    | The margin and border radius settings are in percent of the smallest
    | dimension of the icon (either width or height).
    */

    'font' => env('FAVICON_FONT',
        base_path('vendor/aerdes/laravel-favicon/resources/fonts/Roboto-Regular.ttf')),
    'color' => env('FAVICON_COLOR', '#ffffff'),
    'background-color' => env('FAVICON_BACKGROUND_COLOR', '#007bff'),
    'margin' => env('FAVICON_MARGIN', 5),
    'padding' =>  env('FAVICON_PADDING', 15),
    'border-radius' => env('FAVICON_BORDER_RADIUS', 20),

    /*
    |--------------------------------------------------------------------------
    | Favicon Technical Settings
    |--------------------------------------------------------------------------
    |
    | Some technical options that influence how the favicon is generated.
    |
    | Supported image drivers are gd and imagick.
    | You can also add a custom generator. If you create one we would appreciate
    | if you also add it to the package repository via a pull request.
    */

    'image_driver' => 'gd',
    'generator' => \Aerdes\LaravelFavicon\Generators\DefaultGenerator::class,

];
