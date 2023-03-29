<?php

use Database\Seeders\PrtSerBusinessStatRatiosApiSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedSerPrtBusinessStatApiRatios extends Migration
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
                '--class' => PrtSerBusinessStatRatiosApiSeeder::class,
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
