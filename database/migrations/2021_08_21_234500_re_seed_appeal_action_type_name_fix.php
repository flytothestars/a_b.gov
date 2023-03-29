<?php

use Database\Seeders\AppealActionTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class ReSeedAppealActionTypeNameFix extends Migration
{
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AppealActionTypeSeeder::class
        ]);
    }

    public function down()
    {
        //
    }
}
