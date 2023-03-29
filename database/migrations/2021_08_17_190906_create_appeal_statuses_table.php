<?php

use Database\Seeders\AppealStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateAppealStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('appeal_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
        });

        Artisan::call('db:seed', [
            '--class' => AppealStatusSeeder::class
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('appeal_statuses');
    }
}
