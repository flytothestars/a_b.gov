<?php

use Database\Seeders\SerTradeRatiosUrlSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedSerTradeReportRatiosUrls extends Migration
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
                '--class' => SerTradeRatiosUrlSeeder::class,
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
