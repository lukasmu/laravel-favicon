<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

// TODO: Add tests to ensure that the right files are cached (i.e. all referrenced in the link component and the web application manifest)

it('works as expected', function () {
    $this->assertFalse(File::exists(public_path('favicon.ico')));
    $this->assertFalse(File::exists(public_path('icons/favicon-96x96.png')));
    $this->assertFalse(File::exists(public_path('icons/favicon-180x180-maskable.png')));
    $this->assertFalse(File::exists(public_path('icons/favicon-192x192-maskable.png')));
    $this->assertFalse(File::exists(public_path('icons/favicon-512x512-maskable.png')));

    Artisan::call('favicon:cache');

    $this->assertTrue(File::exists(public_path('favicon.ico')));
    $this->assertTrue(File::exists(public_path('icons/favicon-96x96.png')));
    $this->assertTrue(File::exists(public_path('icons/favicon-180x180-maskable.png')));
    $this->assertTrue(File::exists(public_path('icons/favicon-192x192-maskable.png')));
    $this->assertTrue(File::exists(public_path('icons/favicon-512x512-maskable.png')));

    Artisan::call('favicon:clear');

    $this->assertFalse(File::exists(public_path('favicon.ico')));
    $this->assertFalse(File::exists(public_path('icons/favicon-96x96.png')));
    $this->assertFalse(File::exists(public_path('icons/favicon-180x180-maskable.png')));
    $this->assertFalse(File::exists(public_path('icons/favicon-192x192-maskable.png')));
    $this->assertFalse(File::exists(public_path('icons/favicon-512x512-maskable.png')));
});
