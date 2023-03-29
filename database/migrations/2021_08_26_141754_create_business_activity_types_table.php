<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessActivityTypesTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['activity_type_id']);
            $table->dropIndex(['activity_type_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('activity_type_id');
        });

        Schema::create('business_activity_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('business_id')->nullable();
            $table->uuid('activity_type_id')->unique()->nullable();
        });

        Schema::table('business_activity_types', function (Blueprint $table) {
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
            $table->index(['activity_type_id']);
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->index(['business_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_activity_types');
    }
}
