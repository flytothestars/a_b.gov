<?php

use Database\Seeders\SerBusinessStatReportDistrictsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedDistrictRatiosToBusinessStatReport extends Migration
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
                '--class' => SerBusinessStatReportDistrictsSeeder::class,
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
    }
}
