<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_education', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_appeals_id');
            $table->string('header', 1024);
            $table->string('lead', 1024);
            $table->text('description');
            $table->text('remote_url');
            $table->timestamps();

            $table->foreign('category_appeals_id')->references('id')->on('category_appeals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free_education');
    }
}
