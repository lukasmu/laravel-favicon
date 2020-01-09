<?php

namespace Aerdes\LaravelFavicon\Http\Controllers;

class FaviconController
{

    public function png(int $width=32, int $height=32) {
        $class = config('favicon.generator');
        $generator = new $class($width, $height);
        return $generator->generate();
    }

    public function manifest() {
        $sizes = collect([48, 96, 192, 512]);
        $array = [
            'icons' => $sizes->map(function($size) {
                return [
                    'src' => route('favicons.png_custom', ['width' => $size, 'height' => $size]),
                    'sizes' => $size.'x'.$size,
                    'type' => 'image/png'
                ];
            })
        ];
        return response()->json($array);
    }

    public function browserconfg() {
        $content = view('favicon::browserconfg')->render();
        return response($content)->header('Content-Type', 'application/xml');
    }

}