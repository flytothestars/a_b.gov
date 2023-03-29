<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_maps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_group_id');
            $table->uuid('external_category_id');

            $table->foreign('service_group_id')->references('id')->on('service_groups');
            $table->foreign('external_category_id')->references('id')->on('external_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_maps');
    }
}
