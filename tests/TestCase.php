<?php

namespace LukasMu\Favicon\Tests;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageServiceProvider;
use LukasMu\Favicon\FaviconServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            FaviconServiceProvider::class,
            ImageServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('image.driver', 'gd');
        $app['config']->set('favicon.font', __DIR__.'/../resources/fonts/Roboto-Regular.ttf');
    }

    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            File::deleteDirectory(public_path('icons'));
            File::delete(public_path('favicon.ico'));
        });

        parent::setUp();
    }
}
