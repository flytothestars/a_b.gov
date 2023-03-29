<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedWorkersAndActionTyoeToAppealHistoryTable extends Migration
{
    public function up()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('executor_id')->nullable();
            $table->unsignedBigInteger('coexecutor_id')->nullable();
            $table->unsignedBigInteger('distributor_id')->nullable();
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->foreign('executor_id')->references('id')->on('users');
            $table->foreign('coexecutor_id')->references('id')->on('users');
            $table->foreign('distributor_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropColumn('executor_id');
            $table->dropColumn('coexecutor_id');
            $table->dropColumn('distributor_id');
        });
    }
}
