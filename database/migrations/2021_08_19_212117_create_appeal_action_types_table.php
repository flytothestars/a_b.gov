<?php

use Database\Seeders\AppealActionTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateAppealActionTypesTable extends Migration
{
    public function up()
    {
        Schema::create('appeal_action_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
        });

        Artisan::call('db:seed', [
            '--class' => AppealActionTypeSeeder::class
        ]);
    }


    public function down()
    {
        Schema::dropIfExists('appeal_action_types');
    }
}
