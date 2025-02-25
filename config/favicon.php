<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Favicon Text
    |--------------------------------------------------------------------------
    |
    | This option defines the text that will be displayed within the favicon.
    | By default, it uses the first letter of the application name.
    |
    */

    'text' => env('FAVICON_TEXT', substr(config('app.name', 'L'), 0, 1)),

    /*
    |--------------------------------------------------------------------------
    | Favicon Graphic Settings
    |--------------------------------------------------------------------------
    |
    | These settings control the appearance of the favicon, including font,
    | colors, and spacing.
    |
    | The margin and border radius settings are in percent of the smallest
    | dimension of the icon (either width or height).
    |
    */

    'font' => env('FAVICON_FONT', base_path('vendor/lukasmu/laravel-favicon/resources/fonts/Roboto-Regular.ttf')),
    'colors' => [
        'text' => env('FAVICON_COLOR', '#ffffff'),
        'background' => env('FAVICON_BACKGROUND_COLOR', '#007bff'),
        'theme' => env('FAVICON_THEME_COLOR', '#007bff'),
    ],
    'margin' => env('FAVICON_MARGIN', 5),
    'padding' => env('FAVICON_PADDING', 5),
    'border_radius' => env('FAVICON_BORDER_RADIUS', 20),

    /*
    |--------------------------------------------------------------------------
    | Favicon Technical Settings
    |--------------------------------------------------------------------------
    |
    | These options define core technical configurations for generating
    | the favicon.
    |
    | The 'generator' option specifies the class responsible for creating
    | the favicon. By default, it uses the built-in 'DefaultFaviconGenerator'.
    | You can replace this with a custom implementation by extending the
    | base generator class.
    |
    | If you create a custom generator, consider contributing it to the
    | package repository via a pull request.
    |
    */

    'generator' => \LukasMu\Favicon\Generators\DefaultFaviconGenerator::class,

];
