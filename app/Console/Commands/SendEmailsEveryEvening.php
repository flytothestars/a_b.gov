<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Integration\ISendEmailService;

class SendEmailsEveryEvening extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:sendEvening';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification about appeals every evening';
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
        $this->sendEmailService->sendEmailEveryEvening();
        $this->info('Successfully sent email !');
    }
}
