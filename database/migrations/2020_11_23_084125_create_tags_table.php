<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{

    public function up() : void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->uuid('project_id')->nullable();
            $table->string('name', 256);
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->index(['project_id']);
        });
    }

    public function down() : void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropIndex(['project_id']);
        });

        Schema::dropIfExists('tags');
    }
}
