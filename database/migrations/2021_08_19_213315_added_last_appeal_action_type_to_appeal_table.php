<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedLastAppealActionTypeToAppealTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('last_action_type_id')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('last_action_type_id')->references('id')->on('appeal_action_types');
            $table->index(['last_action_type_id']);
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['last_action_type_id']);
            $table->dropIndex(['last_action_type_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('last_action_type_id');
        });
    }
}
