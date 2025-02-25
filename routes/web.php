<?php

use Illuminate\Support\Facades\Route;
use LukasMu\Favicon\Http\Controllers\FaviconController;

Route::controller(FaviconController::class)->name('favicon.')->group(function () {
    Route::get('favicon.ico', 'ico')->name('ico');

    Route::get('icons/favicon-{width}x{height}.png', 'png')->where('width', '^[0-9]{1,3}$')->where('height', '^[0-9]{1,3}$')->name('png');
    Route::get('icons/favicon-{width}x{height}-maskable.png', 'maskable')->where('width', '^[0-9]{1,3}$')->where('height', '^[0-9]{1,3}$')->name('maskable');

    Route::get('manifest.json', 'manifest')->name('manifest');
});
