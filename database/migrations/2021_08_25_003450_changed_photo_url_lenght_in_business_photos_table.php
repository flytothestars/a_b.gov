<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangedPhotoUrlLenghtInBusinessPhotosTable extends Migration
{
    public function up()
    {
        Schema::table('business_photos', function (Blueprint $table) {
            $table->string('photo_url', 2048)->nullable()->change();
        });
    }


    public function down()
    {

    }
}
