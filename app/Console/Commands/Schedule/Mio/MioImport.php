<?php

namespace App\Console\Commands\Schedule\Mio;

use App\Repositories\IIntegrationJournalRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MioImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mio:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import to MIO';
    private IIntegrationJournalRepository $integrationJournalRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IIntegrationJournalRepository $integrationJournalRepository)
    {
        parent::__construct();
        $this->integrationJournalRepository = $integrationJournalRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->integrationJournalRepository->import();
    }
}
