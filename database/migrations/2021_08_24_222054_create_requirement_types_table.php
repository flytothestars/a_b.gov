<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementTypesTable extends Migration
{
    public function up()
    {
        Schema::create('requirement_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 250)->nullable();
            $table->string('description', 2048)->nullable();
            $table->uuid('mio_id')->unique()->nullable();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->uuid('mio_id')->unique()->nullable();
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->uuid('mio_id')->unique()->nullable();
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->uuid('mio_id')->unique()->nullable();
        });

    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('mio_id');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('mio_id');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('mio_id');
        });

        Schema::dropIfExists('requirement_types');
    }
}
