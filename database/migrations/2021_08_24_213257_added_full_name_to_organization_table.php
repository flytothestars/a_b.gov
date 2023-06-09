<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedFullNameToOrganizationTable extends Migration
{
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('full_name', 250)->nullable();
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('full_name');
        });
    }
}
