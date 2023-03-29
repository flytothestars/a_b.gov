<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDistrictIdNullableInAppealsTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('district_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            //
        });
    }
}
