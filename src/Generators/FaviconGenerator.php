<?php

namespace Aerdes\LaravelFavicon\Generators;

use Illuminate\Http\Response;
use Intervention\Image\Image;
use Intervention\Image\AbstractFont;
use Intervention\Image\ImageManager;
use Intervention\Image\Gd\Font as GdFont;
use Intervention\Image\Imagick\Font as ImagickFont;

abstract class FaviconGenerator
{

    /** @var ImageManager */
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

    protected function getText(): string
    {
        return config('favicon.text');
    }

    protected function getFormattedText(string $text): AbstractFont
    {
        // Firstly, determine with class to use
        if (config('favicon.image_driver') === 'imagick') {
            $text = new ImagickFont($text);
        } else {
            $text = new GdFont($text);
        }
        // Secondly, apply the font
        $text->file(config('favicon.font'));
        // Thirdly, apply some more styling
        $text->valign('top');
        $text->color(config('favicon.color'));
        // Fourthly, do some sizing
        $text->size(max($this->height, $this->width));
        $margin = round(config('favicon.margin')*min($this->height, $this->width)/100);
        $size = $text->getBoxSize();
        while (($size['height'] + 2 * $margin > $this->height or $size['width'] + 2 * $margin > $this->width)
            && $text->getSize() > 0) {
            $text_size = $text->getSize();
            $text->size($text_size - 1);
            $size = $text->getBoxSize();
        }
        return $text;
    }

    protected function createImageText(AbstractFont $font)
    {
        $size = $font->getBoxSize();
        $environmentText = $this->manager->canvas($size['width'], $size['height']);
        $font->applyToImage($environmentText);
        return $environmentText;
    }

}
