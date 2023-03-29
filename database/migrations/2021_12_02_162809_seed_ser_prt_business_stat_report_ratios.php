<?php

use Database\Seeders\PrtSerBusinessStatReportSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedSerPrtBusinessStatReportRatios extends Migration
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
                '--class' => PrtSerBusinessStatReportSeeder::class,
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
