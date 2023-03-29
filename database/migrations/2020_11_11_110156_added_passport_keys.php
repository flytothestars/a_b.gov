<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class AddedPassportKeys extends Migration
{

    public function up() : void
    {
        Artisan::call('passport:install');
    }


    public function down() : void
    {
        //
    }
}
