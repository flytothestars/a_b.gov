<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTypeTagsTable extends Migration
{
    public function up()
    {
        Schema::create('activity_type_tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 250)->nullable();
            $table->uuid('activity_type_id')->unique()->nullable();
        });

        Schema::table('activity_type_tags', function (Blueprint $table) {
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
            $table->index(['activity_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_type_tags');
    }
}
