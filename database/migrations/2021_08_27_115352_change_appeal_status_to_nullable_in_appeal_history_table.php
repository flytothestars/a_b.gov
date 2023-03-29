<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAppealStatusToNullableInAppealHistoryTable extends Migration
{

    public function up()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->uuid('appeal_status_id')->nullable()->change();
        });
    }


    public function down()
    {
    }
}
