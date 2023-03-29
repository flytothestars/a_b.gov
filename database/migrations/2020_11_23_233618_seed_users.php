<?php

use Database\Seeders\UsersSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedUsers extends Migration
{

    public function up() : void
    {
        Artisan::call('db:seed', [
            '--class' => UsersSeeder::class
        ]);
    }

    public function down() : void
    {
        //
    }
}
