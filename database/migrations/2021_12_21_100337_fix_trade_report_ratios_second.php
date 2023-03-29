<?php

use Database\Seeders\FixTradeReportSeederSecond;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class FixTradeReportRatiosSecond extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up(): void
    {
        Artisan::call(
            'db:seed',
            [
                '--class' => FixTradeReportSeederSecond::class,
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
