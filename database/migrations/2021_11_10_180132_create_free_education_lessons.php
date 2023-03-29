<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeEducationLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_education_lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('education_id');
            $table->string('name', 1024);
            $table->text('remote_url');
            $table->timestamps();
            $table->foreign('education_id')->references('id')->on('free_education');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free_education_lessons');
    }
}
