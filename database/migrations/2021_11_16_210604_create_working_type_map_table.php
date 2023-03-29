<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingTypeMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_type_maps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('working_type_id');
            $table->uuid('activity_type_id')->unique();

            $table->foreign('working_type_id')->references('id')->on('working_types');
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_type_map');
    }
}
