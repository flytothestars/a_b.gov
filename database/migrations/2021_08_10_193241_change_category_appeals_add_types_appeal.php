<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCategoryAppealsAddTypesAppeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_appeals', function (Blueprint $table) {
            $table->uuid('types_appeal_id')->nullable();
            $table->renameColumn('service_groups_id', 'service_group_id');
        });

        Schema::table('category_appeals', function (Blueprint $table) {
            $table->foreign('types_appeal_id')->references('id')->on('types_appeal');
            $table->foreign('service_group_id')->references('id')->on('service_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
