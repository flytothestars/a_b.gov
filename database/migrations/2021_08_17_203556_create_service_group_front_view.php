<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceGroupFrontView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_view_service_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
            $table->smallInteger('order_no');
            $table->text('remote_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_view_service_groups');
    }
}
