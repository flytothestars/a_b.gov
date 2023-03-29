<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetCreateByNullableInAppealHistoryTable extends Migration
{

    public function up()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->change();
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }


    public function down()
    {

    }
}
