<?php

namespace LukasMu\Favicon\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FaviconClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'favicon:clear';

    /**
     * The console command description.
     */
    protected $description = 'Remove cached favicons';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        File::delete(public_path('favicon.ico'));
        File::delete(public_path('icons/favicon-96x96.png'));
        File::delete(public_path('icons/favicon-180x180-maskable.png'));
        File::delete(public_path('icons/favicon-192x192-maskable.png'));
        File::delete(public_path('icons/favicon-512x512-maskable.png'));

        return static::SUCCESS;
    }
}
