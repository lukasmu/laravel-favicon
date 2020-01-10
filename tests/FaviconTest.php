<?php

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\BrowserKit\TestCase;

class FaviconTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        putenv('FAVICON_FONT='.base_path('../../../../resources/fonts/Roboto-Regular.ttf'));

        return [
            'Aerdes\LaravelFavicon\FaviconServiceProvider',
        ];
    }

    public function testPNG()
    {
        $this->visitRoute('favicons.png')->assertResponseOk();
    }

    public function testPNGwithDimensions()
    {
        $this->visitRoute('favicons.png', ['width' => 100, 'height' => 100])->assertResponseOk();
    }

    public function testPNGwithImagick()
    {
        Config::set('favicon.image_driver', 'imagick');
        $this->visitRoute('favicons.png', ['width' => 100, 'height' => 100])->assertResponseOk();
    }

    public function testManifest()
    {
        $this->visitRoute('favicons.manifest')
            ->seeJsonStructure([
                'icons' => [
                    '*' => [
                        'src',
                        'sizes',
                        'type',
                    ],
                ],
            ]);
    }

    public function testBrowserconfig()
    {
        $this->visitRoute('favicons.browserconfig')->assertResponseOk();
    }
}
