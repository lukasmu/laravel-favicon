<?php

namespace LukasMu\Favicon\Generators;

use Illuminate\Support\Facades\App;
use Intervention\Image\Gd\Font as GdFont;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Imagick\Font as ImagickFont;

class DefaultFaviconGenerator extends FaviconGenerator
{
    protected function background(): Image
    {
        $width = $this->getWidth();
        $height = $this->getHeight();

        $callback = fn ($draw) => $draw->background($this->getBackgroundColor());

        $canvas = App::make(ImageManager::class)->canvas($width, $height);

        if ($this->isMaskable()) {
            $canvas->rectangle(0, 0, $width, $height, $callback);

            return $canvas;
        }

        $margin = $this->getMargin();
        $radius = $this->getBorderRadius();

        $x1 = $margin;
        $x2 = $width - $margin;
        $y1 = $margin;
        $y2 = $height - $margin;

        $canvas->rectangle($x1 + $radius, $y1, $x2 - $radius, $y2, $callback);
        $canvas->rectangle($x1, $y1 + $radius, $x2, $y2 - $radius, $callback);

        $corners = [
            [$x1 + $radius, $y1 + $radius],
            [$x2 - $radius, $y1 + $radius],
            [$x1 + $radius, $y2 - $radius],
            [$x2 - $radius, $y2 - $radius],
        ];
        foreach ($corners as [$cx, $cy]) {
            $canvas->ellipse($radius * 2, $radius * 2, $cx, $cy, $callback);
        }

        return $canvas;
    }

    protected function foreground(): Image
    {
        $spacing = 2 * ($this->getMargin() + $this->getPadding());

        $maxWidth = $this->getWidth() - $spacing;
        $maxHeight = $this->getHeight() - $spacing;

        if ($this->isMaskable()) {
            $maxWidth = $maxHeight = min($this->getHeight(), $this->getWidth()) / 2 * sqrt(2);
        }

        $driver = config('image.driver');
        $text = match ($driver) {
            'imagick' => new ImagickFont($this->getText()),
            'gd' => new GdFont($this->getText()),
            default => abort(500, 'Unsupported image driver')
        };

        $text->file($this->getFont());
        $text->valign('top');
        $text->color($this->getColor());
        $text->size(max($this->getHeight(), $this->getWidth()));

        // Reduce font size until it fits
        do {
            $size = $text->getBoxSize();
            if ($size['height'] <= $maxHeight && $size['width'] <= $maxWidth) {
                break;
            }
            $text->size($text->getSize() - 1);
        } while ($text->getSize() > 0);

        $canvas = App::make(ImageManager::class)->canvas($size['width'], $size['height']);
        $text->applyToImage($canvas);

        return $canvas;
    }

    public function image(): Image
    {
        return $this->background()->insert($this->foreground(), 'center');
    }
}
