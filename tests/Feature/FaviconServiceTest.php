<?php

use Illuminate\Support\Facades\Config;
use LukasMu\Favicon\Facades\Favicon;

it('can create images using the gd driver', function () {
    Config::set('image.driver', 'gd');
    $image = Favicon::image(48, 48, false);
    $image->encode();
    expect($image->getDriver())->toBeInstanceOf(Intervention\Image\Gd\Driver::class);
});

it('can create images using the imagick driver', function () {
    Config::set('image.driver', 'imagick');
    $image = Favicon::image(48, 48, false);
    $image->encode();
    expect($image->getDriver())->toBeInstanceOf(Intervention\Image\Imagick\Driver::class);
});

it('can create icon objects', function () {
    $ico = Favicon::ico(48, 48);
    expect($ico)->toBeInstanceOf(PHP_ICO::class);
});
