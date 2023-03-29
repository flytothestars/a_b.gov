<?php

use Database\Seeders\FixInvestmentReportSeederSecond;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class FixInvestmentsReportRatiosSecond extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up():void
    {
        Artisan::call(
            'db:seed',
            [
                '--class' => FixInvestmentReportSeederSecond::class,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    final public function down(): void
    {
        //
    }
}
