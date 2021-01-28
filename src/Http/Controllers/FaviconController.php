<?php

namespace LukasMu\Favicon\Http\Controllers;

class FaviconController
{
    /**
     * Return the actual favicon.
     *
     * @param int $width
     * @param int $height
     * @return \Illuminate\Http\Response
     */
    public function png(int $width = 32, int $height = 32)
    {
        $class = config('favicon.generator');
        $generator = new $class($width, $height);

        return $generator->generate();
    }

    /**
     * Returns the manifest for Chrome, Firefox, ...
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function manifest()
    {
        $sizes = collect([48, 96, 192, 512]);
        $array = [
            'icons' => $sizes->map(function ($size) {
                return [
                    'src' => route('favicons.png_custom', ['width' => $size, 'height' => $size]),
                    'sizes' => $size.'x'.$size,
                    'type' => 'image/png',
                ];
            }),
        ];

        return response()->json($array);
    }

    /**
     * Returns the browserconfig for IE.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function browserconfig()
    {
        $content = view('favicon::browserconfig')->render();

        return response($content)->header('Content-Type', 'application/xml');
    }
}
