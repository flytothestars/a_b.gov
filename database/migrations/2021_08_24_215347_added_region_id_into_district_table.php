<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedRegionIdIntoDistrictTable extends Migration
{

    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->uuid('region_id')->nullable();
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions');
            $table->index(['region_id']);
        });
    }

    public function down()
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropIndex(['region_id']);
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('region_id');
        });
    }
}
