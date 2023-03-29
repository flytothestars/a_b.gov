<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedStatusFieldsToAppealsTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('appeal_status_id');
            $table->uuid('client_appeal_status_id');
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('appeal_status_id')->references('id')->on('appeal_statuses');
            $table->foreign('client_appeal_status_id')->references('id')->on('client_appeal_statuses');
            $table->index(['appeal_status_id']);
            $table->index(['client_appeal_status_id']);
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['appeal_status_id']);
            $table->dropIndex(['appeal_status_id']);
            $table->dropForeign(['client_appeal_status_id']);
            $table->dropIndex(['client_appeal_status_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('appeal_status_id');
            $table->dropColumn('client_appeal_status_id');
        });
    }
}
