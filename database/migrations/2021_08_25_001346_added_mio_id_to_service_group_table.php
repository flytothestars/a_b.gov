<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedMioIdToServiceGroupTable extends Migration
{
    public function up()
    {
        Schema::table('service_groups', function (Blueprint $table) {
            $table->uuid('mio_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('service_groups', function (Blueprint $table) {
            $table->dropColumn('mio_id');
        });
    }
}
