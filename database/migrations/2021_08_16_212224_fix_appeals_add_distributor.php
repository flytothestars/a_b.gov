<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAppealsAddDistributor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeals', function(Blueprint $table){
            $table->uuid('user_status_id')->nullable();
            $table->unsignedBigInteger('distributor_id')->nullable();
            $table->unsignedBigInteger('user_id')->change();

            $table->foreign('distributor_id')->references('id')->on('users');
            $table->foreign('user_status_id')->references('id')->on('user_status');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appeals', function(Blueprint $table){
            $table->removeColumn('distributor_id');
            $table->removeColumn('user_id');
        });
    }
}
