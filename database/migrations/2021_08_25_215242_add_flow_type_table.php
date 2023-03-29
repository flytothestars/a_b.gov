<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlowTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 64);
        });

        Schema::table('appeals', function (Blueprint $table) {
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
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['appeals_flow_type_id_foreign']);
            $table->dropColumn('flow_type_id');
        });
        Schema::dropIfExists('flow_types');
    }
}
