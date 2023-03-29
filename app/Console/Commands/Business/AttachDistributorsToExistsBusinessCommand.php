<?php

namespace App\Console\Commands\Business;

use App\Models\Business;
use App\Repositories\IBusinessRepository;
use Illuminate\Console\Command;

class AttachDistributorsToExistsBusinessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'business:attach-distributors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attach distributors to exists businesses';

    private IBusinessRepository $businessRepository;

    /**
     * AttachDistributorsToExistsBusinessCommand constructor.
     *
     * @param IBusinessRepository $businessRepository
     */
    public function __construct(IBusinessRepository $businessRepository)
    {
        $this->businessRepository = $businessRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $businessCount = Business::whereNull('distributor_id')->count();

        $this->info('Start attach distributors to business found: ' . $businessCount);

        $chunkCount = 50;
        $processed = 0;
        $offset = 0;

        $progress = $this->output->createProgressBar($businessCount);

        while ($processed < $businessCount)
        {
            $businesses = Business::whereNull('distributor_id')->skip($offset)->take($chunkCount)->get();
            foreach ($businesses as $business)
            {
                $this->businessRepository->autoAssignDistributor($business->id);
                $progress->advance(1);
                $processed ++;
            }
        }

        $progress->clear();;
        $progress->finish();


        $this->info('');
        $this->info('End attach');

    }
}
