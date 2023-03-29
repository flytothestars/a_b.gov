<?php

use Database\Seeders\CategoryAppealSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedCategoryAppeal extends Migration
{

    public function up() : void
    {
//        Artisan::call('db:seed', [
//            '--class' => CategoryAppealSeeder::class
//        ]);
    }


    public function down() : void
    {
        //
    }
}
