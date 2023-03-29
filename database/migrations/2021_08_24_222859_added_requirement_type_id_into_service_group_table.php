<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedRequirementTypeIdIntoServiceGroupTable extends Migration
{
    public function up()
    {
        Schema::table('service_groups', function (Blueprint $table) {
            $table->uuid('requirement_type_id')->nullable();
        });

        Schema::table('service_groups', function (Blueprint $table) {
            $table->foreign('requirement_type_id')->references('id')->on('requirement_types');
            $table->index(['requirement_type_id']);
        });
    }

    public function down()
    {
        Schema::table('service_groups', function (Blueprint $table) {
            $table->dropForeign(['requirement_type_id']);
            $table->dropIndex(['requirement_type_id']);
        });

        Schema::table('service_groups', function (Blueprint $table) {
            $table->dropColumn('requirement_type_id');
        });
    }
}
