<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedActivityTypeIntooAppealsTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('activity_type_id')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
            $table->index(['activity_type_id']);
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['activity_type_id']);
            $table->dropIndex(['activity_type_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('activity_type_id');
        });
    }
}
