<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedAppealResultTypeIdFieldToAppealHistoryTable extends Migration
{
    public function up()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->uuid('appeal_result_type_id')->nullable();
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->foreign('appeal_result_type_id')->references('id')->on('appeal_result_types');
            $table->index(['appeal_result_type_id']);
        });
    }

    public function down()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropForeign(['appeal_result_type_id']);
            $table->dropIndex(['appeal_result_type_id']);
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropColumn('appeal_result_type_id');
        });
    }
}
