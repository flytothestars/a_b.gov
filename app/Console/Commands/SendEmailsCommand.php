<?php

namespace App\Console\Commands;

use App\Integration\ISendEmailService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;



class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'emails:send';

    private $sendEmailService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ISendEmailService $sendEmailService)
    {
        $this->sendEmailService = $sendEmailService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Start sent email !');
        $this->sendEmailService->sendEmail();
        Log::info('Successfully sent email !');
        $this->info('Successfully sent email !');
    }
}
