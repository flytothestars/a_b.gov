<?php

use Database\Seeders\ClientAppealStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateClientAppealStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('client_appeal_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
        });

        Artisan::call('db:seed', [
            '--class' => ClientAppealStatusSeeder::class
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('client_appeal_statuses');
    }
}
