<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('appeal_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('appeal_id');
            $table->uuid('appeal_status_id');
            $table->uuid('client_appeal_status_id');
            $table->foreignId('created_by')->constrained('users','id');
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->foreign('appeal_id')->references('id')->on('appeals');
            $table->index(['appeal_id']);
            $table->foreign('appeal_status_id')->references('id')->on('appeal_statuses');
            $table->foreign('client_appeal_status_id')->references('id')->on('client_appeal_statuses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appeal_histories');
    }
}
