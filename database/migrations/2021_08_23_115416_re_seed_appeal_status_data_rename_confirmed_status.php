<?php

use Database\Seeders\AppealStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class ReSeedAppealStatusDataRenameConfirmedStatus extends Migration
{

    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AppealStatusSeeder::class
        ]);
    }


    public function down()
    {
        //
    }
}
