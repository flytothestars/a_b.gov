<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovedActivityTypeUix extends Migration
{
    public function up()
    {
        Schema::table('activity_types', function (Blueprint $table) {
            $table->dropUnique(['parent_id']);
            $table->dropUnique(['activity_node_type_id']);
        });

        Schema::table('activity_type_tags', function (Blueprint $table) {
            $table->dropUnique(['activity_type_id']);
        });

        Schema::table('business_activity_types', function (Blueprint $table) {
            $table->dropUnique(['activity_type_id']);
        });
    }

    public function down()
    {
        //
    }
}
