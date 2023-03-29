<?php

use Database\Seeders\AppealStatusExtraSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class SeedAppealExtraStatusesTable extends Migration
{
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AppealStatusExtraSeeder::class
        ]);
    }

    public function down()
    {
        //
    }
}
