<?php

namespace Aerdes\LaravelFavicon\Generators;

use Illuminate\Http\Response;

class DefaultGenerator extends FaviconGenerator
{

    public function generate(): Response
    {

        $background_img = $this->manager->canvas($this->width, $this->height, config('favicon.bg-color'));

        $text = $this->getText();
        $text_formatted = $this->getFormattedText($text);
        $text_img = $this->createImageText($text_formatted);

        $output = $this->manager->canvas($this->width, $this->height);
        $output->insert($background_img);
        $output->insert($text_img, 'center-center', round(config('favicon.margin')*min($this->height, $this->width)/100), round(config('favicon.margin')*min($this->height, $this->width)/100));

        return $output->response('png');

    }

}
