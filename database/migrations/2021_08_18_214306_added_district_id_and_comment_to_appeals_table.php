<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedDistrictIdAndCommentToAppealsTable extends Migration
{
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('district_id')->nullable();
            $table->string('comment','1024')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('districts');
            $table->index(['district_id']);
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
            $table->dropIndex(['district_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('district_id');
        });
    }
}
