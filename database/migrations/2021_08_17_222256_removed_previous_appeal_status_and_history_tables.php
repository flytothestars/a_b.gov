<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovedPreviousAppealStatusAndHistoryTables extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['user_status_id']);
            $table->dropForeign(['status']);
            $table->dropColumn('user_status_id');
            $table->dropColumn('status');
        });

        Schema::dropIfExists('appeals_status_histories');
        Schema::dropIfExists('user_status');
        Schema::dropIfExists('status_appeals');
    }

    public function down()
    {
        //
    }
}
