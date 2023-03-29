<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedMioFieldIntoAppealsTable extends Migration
{

    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('mio_id')->unique()->nullable();
            $table->uuid('business_id')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->index(['business_id']);
        });
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropIndex(['business_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('mio_id');
            $table->dropColumn('business_id');
        });
    }
}
