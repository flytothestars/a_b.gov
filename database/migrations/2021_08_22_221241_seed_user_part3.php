<?php

use Database\Seeders\UsersPart3Seeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedUserPart3 extends Migration
{

    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => UsersPart3Seeder::class
        ]);
    }

    public function down()
    {
        //
    }
}
