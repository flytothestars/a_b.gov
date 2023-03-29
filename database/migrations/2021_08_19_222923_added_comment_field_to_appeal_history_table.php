<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedCommentFieldToAppealHistoryTable extends Migration
{
    public function up()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->uuid('appeal_action_type_id')->nullable();
            $table->string('comment','1024')->nullable();
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->foreign('appeal_action_type_id')->references('id')->on('appeal_action_types');
            $table->index(['appeal_action_type_id']);
        });
    }

    public function down()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropForeign(['appeal_action_type_id']);
            $table->dropIndex(['appeal_action_type_id']);
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropColumn('appeal_action_type_id');
        });
    }
}
