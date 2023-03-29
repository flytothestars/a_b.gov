<?php

use Database\Seeders\AppealResultMatrixSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class ReSeedAppealResultMatrixNewStatuses extends Migration
{
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AppealResultMatrixSeeder::class
        ]);
    }

    public function down()
    {
        //
    }
}
