<?php

namespace App\Console\Commands\Schedule\Mio;

use App\Integration\IMioIntegrationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncIntegration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mio:sync-integration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync MIO integration';

    private $mioIntegrationService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IMioIntegrationService $mioIntegrationService)
    {
        $this->mioIntegrationService = $mioIntegrationService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        Log::info('start mio integration sync');
        $this->mioIntegrationService->upload();
//        Log::info('end mio integration sync');
    }
}
