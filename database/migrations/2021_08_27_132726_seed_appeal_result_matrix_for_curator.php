<?php

use Database\Seeders\AppealResultMatrixSeeder;
use Database\Seeders\AppealResultTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class SeedAppealResultMatrixForCurator extends Migration
{

    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AppealResultTypeSeeder::class
        ]);

        Artisan::call('db:seed', [
            '--class' => AppealResultMatrixSeeder::class
        ]);
    }


    public function down()
    {
        //
    }
}
