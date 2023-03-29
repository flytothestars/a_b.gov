<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCuratorToAppealHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('curator_upi_id')->nullable();
            $table->unsignedBigInteger('curator_district_id')->nullable();
        });

        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->foreign('curator_upi_id')->references('id')->on('users');
            $table->foreign('curator_district_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appeal_histories', function (Blueprint $table) {
            $table->dropColumn('curator_upi_id');
            $table->dropColumn('curator_district_id');
        });
    }
}
