<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_industries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 1024);
            $table->uuid('working_industry_type_id');
            $table->uuid('activity_type_id');
            $table->uuid('mio_id');

            $table->foreign('working_industry_type_id')->references('id')->on('working_industry_types');
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
        Schema::dropIfExists('working_industries');
    }
}
