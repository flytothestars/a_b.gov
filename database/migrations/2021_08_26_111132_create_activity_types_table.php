<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('activity_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 250)->nullable();
            $table->string('name', 250)->nullable();
            $table->uuid('parent_id')->unique()->nullable();
            $table->uuid('activity_node_type_id')->unique()->nullable();
            $table->uuid('mio_id')->unique()->nullable();
        });

        Schema::table('activity_types', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('activity_types');
            $table->index(['parent_id']);
            $table->foreign('activity_node_type_id')->references('id')->on('activity_node_types');
            $table->index(['activity_node_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_types');
    }
}
