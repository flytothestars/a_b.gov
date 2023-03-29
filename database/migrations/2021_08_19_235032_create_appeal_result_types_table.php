<?php

use Database\Seeders\AppealResultTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateAppealResultTypesTable extends Migration
{
    public function up()
    {
        Schema::create('appeal_result_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
        });

        Artisan::call('db:seed', [
            '--class' => AppealResultTypeSeeder::class
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('appeal_result_types');
    }
}
