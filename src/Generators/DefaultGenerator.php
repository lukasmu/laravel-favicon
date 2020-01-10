<?php

namespace Aerdes\LaravelFavicon\Generators;

use Illuminate\Http\Response;
use Intervention\Image\Gd\Font as GdFont;
use Intervention\Image\Imagick\Font as ImagickFont;

class DefaultGenerator extends FaviconGenerator
{

    public function generate(): Response
    {
        // First generate the background
        $x1 = $this->getMargin();
        $x2 = $this->getWidth()-$this->getMargin();
        $y1 = $x1;
        $y2 = $this->getHeight()-$this->getMargin();
        $radius = $this->getBorderRadius();
        $background_call = function ($draw) {
            $draw->background($this->getBackgroundColor());
        };
        $background = $this->manager->canvas($this->getWidth(), $this->getHeight());
        $background->rectangle($x1+$radius, $y1, $x2-$radius, $y2, $background_call);
        $background->rectangle($x1, $y1+$radius, $x2, $y2-$radius, $background_call);
        $background->ellipse($radius*2, $radius*2, $x1+$radius, $y1+$radius, $background_call);
        $background->ellipse($radius*2, $radius*2, $x2-$radius, $y1+$radius, $background_call);
        $background->ellipse($radius*2, $radius*2, $x1+$radius, $y2-$radius, $background_call);
        $background->ellipse($radius*2, $radius*2, $x2-$radius, $y2-$radius, $background_call);

        // Then generate the text
        $spacing = 2*($this->getMargin()+$this->getPadding());
        $max = max($this->getHeight(), $this->getWidth())-$spacing;
        if (config('favicon.image_driver') === 'imagick') {
            $text = new ImagickFont($this->getText());
        } else {
            $text = new GdFont($this->getText());
        }
        $text->file($this->getFont());
        $text->valign('top');
        $text->color($this->getColor());
        $text->size($max);
        $size = $text->getBoxSize();
        while (($size['height'] + $spacing > $this->height or $size['width'] + $spacing > $this->width)
            && $text->getSize() > 0) {
            $text->size($text->getSize() - 1);
            $size = $text->getBoxSize();
        }
        $size = $text->getBoxSize();
        $foreground = $this->manager->canvas($size['width'], $size['height']);
        $text->applyToImage($foreground);

        // Finally merge background and text
        $output = $this->manager->canvas($this->getWidth(), $this->getHeight());
        $output->insert($background);
        $output->insert($foreground, 'center-center', $spacing/2);

        return $output->response('png');
    }

}
