<?php

namespace LukasMu\Favicon\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use LukasMu\Favicon\Facades\Favicon;

class FaviconCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'favicon:cache';

    /**
     * The console command description.
     */
    protected $description = 'Cache favicons';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Favicon::ico(48, 48)->save_ico(public_path('favicon.ico'));
        File::ensureDirectoryExists(public_path('icons'));
        Favicon::image(96, 96, false)->save(public_path('icons/favicon-96x96.png'));
        Favicon::image(180, 180, true)->save(public_path('icons/favicon-180x180-maskable.png'));
        Favicon::image(192, 192, true)->save(public_path('icons/favicon-192x192-maskable.png'));
        Favicon::image(512, 512, true)->save(public_path('icons/favicon-512x512-maskable.png'));

        return static::SUCCESS;
    }
}
