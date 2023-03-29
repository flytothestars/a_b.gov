<?php

namespace App\Jobs;

use App\Exports\Admin\AdminLoansExport;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ExportLoans implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $timeout = 1800;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $allExportsLoans = Storage::disk('local')->files('export');
        $deleteExports = array_slice($allExportsLoans, 0,-10);
        Storage::delete($deleteExports);
        $fileName = 'export/admin-loans_'.date('Y-m-d_H-i').'.xlsx';
        \Excel::store(new AdminLoansExport('active', '', '', ''), $fileName);
    }
}
