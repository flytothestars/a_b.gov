<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToAppealResultMatrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeal_result_matrices', function (Blueprint $table) {
            $table->boolean('is_active')->default(false);
            $table->uuid('flow_type_id')->nullable();

            $table->foreign('flow_type_id')->references('id')->on('flow_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appeal_result_matrices', function (Blueprint $table) {
            //
        });
    }
}
