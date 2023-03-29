<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMioIntegrationLogsTable extends Migration
{
    public function up()
    {
        Schema::create('mio_integration_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime("started_at");
            $table->dateTime("completed_at")->nullable();
            $table->integer("rows_processed")->nullable();
            $table->boolean("is_success")->nullable();
            $table->boolean("error_description")->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mio_integration_logs');
    }
}
