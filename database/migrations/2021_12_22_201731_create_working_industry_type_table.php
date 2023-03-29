<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingIndustryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_industry_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 1024);
            $table->uuid('working_type_id');
            $table->uuid('mio_id');

            $table->foreign('working_type_id')->references('id')->on('working_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_industry_types');
    }
}
