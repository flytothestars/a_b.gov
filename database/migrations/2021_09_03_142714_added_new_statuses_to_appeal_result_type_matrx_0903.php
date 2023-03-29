<?php

use Database\Seeders\AppealResultMatrixSeeder;
use Database\Seeders\AppealResultTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AddedNewStatusesToAppealResultTypeMatrx0903 extends Migration
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
        Schema::table('appeal_result_type_matrx_0903', function (Blueprint $table) {
            //
        });
    }
}
