<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageFilesTable extends Migration
{

    public function up() : void
    {
        Schema::create('storage_files', function (Blueprint $table) {
            $table->id();
            $table->uuid('storable_id')->index();
            $table->string('storable_type');
            $table->string('path',256);
            $table->string('file_type',256);
            $table->timestamps();
            $table->unique(['storable_type', 'storable_id', 'file_type']);
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('storage_files');
    }
}
