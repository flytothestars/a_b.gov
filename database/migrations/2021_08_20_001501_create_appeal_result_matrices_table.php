<?php

use Database\Seeders\AppealResultMatrixSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateAppealResultMatricesTable extends Migration
{
    public function up()
    {
        Schema::create('appeal_result_matrices', function (Blueprint $table) {
            $table->id();
            $table->uuid('appeal_result_type_id')->nullable();
            $table->uuid('from_appeal_status_id')->nullable();
            $table->uuid('to_appeal_status_id')->nullable();
        });

        Schema::table('appeal_result_matrices', function (Blueprint $table) {
            $table->foreign('appeal_result_type_id')->references('id')->on('appeal_result_types');
            $table->index(['appeal_result_type_id']);
            $table->foreign('from_appeal_status_id')->references('id')->on('appeal_statuses');
            $table->index(['from_appeal_status_id']);
            $table->foreign('to_appeal_status_id')->references('id')->on('appeal_statuses');
            $table->index(['to_appeal_status_id']);
        });

        Artisan::call('db:seed', [
            '--class' => AppealResultMatrixSeeder::class
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('appeal_result_matrices');
    }
}
