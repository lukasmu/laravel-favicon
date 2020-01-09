<?php

/*
|--------------------------------------------------------------------------
| Favicon Routes
|--------------------------------------------------------------------------
|
| Here are all the routes defined that are needed for the favicon package.
|
*/

Route::namespace('\Aerdes\LaravelFavicon\Http\Controllers')->name('favicons.')->prefix('icons')->group(function () {

    Route::get('favicon.png', 'FaviconController@png')->name('png');
    Route::get('favicon-{width}x{height}.png', 'FaviconController@png')->where('width', '[0-9]+')->where('height', '[0-9]+')->name('png_custom');

    Route::get('manifest.json', 'FaviconController@manifest')->name('manifest');

    Route::get('browserconfg.xml', 'FaviconController@browserconfg')->name('browserconfg');

});

