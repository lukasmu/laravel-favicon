<?php

namespace LukasMu\Favicon\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use LukasMu\Favicon\Facades\Favicon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FaviconController
{
    /**
     * Return the default favicon in the ICO format.
     */
    public function ico(int $width = 48, int $height = 48): BinaryFileResponse
    {
        $file = tempnam(sys_get_temp_dir(), 'favicon_').'.ico';

        $ico = Favicon::ico($width, $height);
        $ico->save_ico($file);

        return Response::file($file, [
            'Content-Type' => 'image/x-icon',
            'Content-Disposition' => 'inline; filename="favicon.ico"',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Return the default favicon in the PNG format.
     */
    public function png(int $width = 48, int $height = 48, bool $maskable = false): HttpResponse
    {
        return Favicon::image($width, $height, $maskable)->response('png');
    }

    /**
     * Return the maskable favicon in the PNG format.
     */
    public function maskable(int $width = 48, int $height = 48): HttpResponse
    {
        return $this->png($width, $height, true);
    }

    /**
     * Return the web app manifest.
     */
    public function manifest(): JsonResponse
    {
        return Response::json([
            'name' => config('app.name'),
            'icons' => collect([192, 512])->map(function ($size) {
                return [
                    'src' => route('favicon.maskable', ['width' => $size, 'height' => $size]),
                    'sizes' => "{$size}x{$size}",
                    'type' => 'image/png',
                    'purpose' => 'maskable',
                ];
            }),
            'theme_color' => config('favicon.colors.theme'),
            'background_color' => config('favicon.colors.background'),
            'display' => 'standalone',
        ]);
    }
}
