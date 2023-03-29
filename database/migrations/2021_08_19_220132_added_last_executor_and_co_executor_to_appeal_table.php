<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedLastExecutorAndCoExecutorToAppealTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->unsignedBigInteger('last_executor_id')->nullable();
            $table->unsignedBigInteger('last_coexecutor_id')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('last_executor_id')->references('id')->on('users');
            $table->foreign('last_coexecutor_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('last_executor_id');
            $table->dropColumn('last_coexecutor_id');
        });
    }
}
