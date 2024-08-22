<?php

namespace Dgo\Cornerstone\Console\Commands;

use Illuminate\Console\Command;
use ImageHelp;

class GenerateFaviconSizesCommand extends Command
{
    protected $signature = 'favicon:generate {url?}';

    protected $description = 'Generate favicon sizes from a given URL or default URL';

    public function handle()
    {
        $url = $this->argument('url');

        // Call the generateFaviconSizes method
        ImageHelp::generateFaviconSizes($url);

        if (! $url) {
            $url = 'default';
        }
        $this->info("Favicon sizes generated for URL: {$url}");

        return 0;
    }
}
