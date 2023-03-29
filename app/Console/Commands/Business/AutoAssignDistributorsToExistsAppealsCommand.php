<?php

namespace App\Console\Commands\Business;

use App\Models\Appeal;
use App\Models\Business;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IBusinessRepository;
use Illuminate\Console\Command;

class AutoAssignDistributorsToExistsAppealsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appeal:auto-assign-distributors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto assign distributors to exists appeal';

    private IAppealForDistributorRepository $appealForDistributorRepository;

    /**
     * AttachDistributorsToExistsBusinessCommand constructor.
     *
     * @param IAppealForDistributorRepository $appealForDistributorRepository
     */
    public function __construct(IAppealForDistributorRepository $appealForDistributorRepository)
    {
        $this->appealForDistributorRepository = $appealForDistributorRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $appealCount = Appeal::whereNull('distributor_id')->count();

        $this->info('Start attach distributors to appeal found: ' . $appealCount);

        $chunkCount = 50;
        $processed = 0;
        $offset = 0;

        $progress = $this->output->createProgressBar($appealCount);

        while ($processed < $appealCount)
        {
            $appeals = Appeal::whereNull('distributor_id')->skip($offset)->take($chunkCount)->get();
            foreach ($appeals as $appeal)
            {
                $this->appealForDistributorRepository->autoAssignDistributor($appeal->id);
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
