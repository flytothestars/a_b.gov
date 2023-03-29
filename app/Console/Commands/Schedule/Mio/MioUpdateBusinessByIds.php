<?php

namespace App\Console\Commands\Schedule\Mio;

use App\Integration\IMioIntegrationService;
use Illuminate\Console\Command;

class MioUpdateBusinessByIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mio:update-business-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private IMioIntegrationService $mioIntegrationService;

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
        $this->mioIntegrationService->updateBusinessByIds();
    }
}
