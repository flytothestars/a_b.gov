<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('translatable_id')->index();
            $table->string('translatable_type');
            $table->string('language');
            $table->json('content');
            $table->timestamps();
            $table->unique(['translatable_type', 'translatable_id', 'language']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
