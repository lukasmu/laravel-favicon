<?php

namespace Aerdes\LaravelFavicon\Generators;

use Illuminate\Http\Response;
use Intervention\Image\ImageManager;

abstract class FaviconGenerator
{

    protected $manager;
    protected $width;
    protected $height;

    public function __construct(int $width, int $height)
    {
        $this->manager = new ImageManager([
            'driver' => config('favicon.image_driver'),
        ]);
        $this->width = $width;
        $this->height = $height;
    }

    abstract public function generate(): Response;

    protected function getWidth(): int
    {
        return $this->width;
    }

    protected function getHeight(): int
    {
        return $this->height;
    }

    protected function getText(): string
    {
        return config('favicon.text');
    }

    protected function getFont(): string
    {
        return config('favicon.font');
    }

    protected function getColor(): string
    {
        return config('favicon.color');
    }

    protected function getBackgroundColor(): string
    {
        return config('favicon.background-color');
    }

    protected function getPadding(): int
    {
        return round(config('favicon.padding')*min($this->height, $this->width)/100);
    }

    protected function getMargin(): int
    {
        return round(config('favicon.margin')*min($this->height, $this->width)/100);
    }

    protected function getBorderRadius(): int
    {
        return round(config('favicon.border-radius')*min($this->height, $this->width)/100);
    }

}
