<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('news_category_id');
            $table->string('header', 1024);
            $table->string('lead', 1024);
            $table->text('content');
            $table->dateTime('create_date');
            $table->boolean('is_published')->default(false);
            $table->string('code', 128)->unique();

            $table->foreign('news_category_id')->references('id')->on('news_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
