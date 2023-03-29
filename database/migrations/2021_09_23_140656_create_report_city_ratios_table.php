<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportCityRatiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_city_ratios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('city_id');
            $table->unsignedBigInteger('report_type_id');
            $table->unsignedBigInteger('ratio_id');
            $table->float('value');
            $table->date('date');
            $table->timestamps();

            $table->foreign('city_id')->on('cities')->references('id');
            $table->foreign('report_type_id')->on('report_types')->references('id');
            $table->foreign('ratio_id')->on('report_ratios')->references('id');

            $table->unique(['city_id','report_type_id', 'ratio_id', 'date'], 'unique_ratio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_city_ratios');
    }
}
