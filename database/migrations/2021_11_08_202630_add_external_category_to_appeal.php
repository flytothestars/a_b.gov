<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExternalCategoryToAppeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('external_category_id')->nullable();

            $table->foreign('external_category_id')->references('id')->on('external_categories');
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
            //
        });
    }
}
