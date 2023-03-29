<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPhotosTable extends Migration
{

    public function up()
    {
        Schema::create('business_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('description', 1024)->nullable();
            $table->string('photo_url', 64)->nullable();
            $table->uuid('mio_id')->unique()->nullable();
            $table->uuid('business_id')->nullable();
        });

        Schema::table('business_photos', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->index(['business_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('business_photos');
    }
}
