<?php

namespace LukasMu\Favicon;

use Illuminate\Support\Facades\App;
use Intervention\Image\Image;
use PHP_ICO;

class FaviconService
{
    public function image(int $width, int $height, bool $maskable): Image
    {
        return App::makeWith(config('favicon.generator'), ['width' => $width, 'height' => $height, 'maskable' => $maskable])->image();
    }

    public function ico(int $width, int $height): PHP_ICO
    {
        $tmp = tempnam(sys_get_temp_dir(), 'favicon_').'.png';
        $this->image($width, $height, false)->save($tmp);

        return new PHP_ICO($tmp, [$width, $height]);
    }
}
