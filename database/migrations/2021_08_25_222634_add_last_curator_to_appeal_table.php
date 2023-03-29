<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastCuratorToAppealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->unsignedBigInteger('last_curator_upi_id')->nullable();
            $table->unsignedBigInteger('last_curator_district_id')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('last_curator_upi_id')->references('id')->on('users');
            $table->foreign('last_curator_district_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('last_curator_upi_id');
            $table->dropColumn('last_curator_district_id');
        });
    }
}
