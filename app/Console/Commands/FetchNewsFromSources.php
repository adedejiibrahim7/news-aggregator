<?php

namespace App\Console\Commands;

use App\Services\GuardianService;
use Illuminate\Console\Command;

class FetchNewsFromSources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news-from-sources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news articles from sources and save to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        GuardianService::fetch();
    }
}
