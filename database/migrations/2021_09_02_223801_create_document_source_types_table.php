<?php

use Database\Seeders\DocumentSourceTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateDocumentSourceTypesTable extends Migration
{

    public function up()
    {
        Schema::create('document_source_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
        });

        Artisan::call('db:seed', [
            '--class' => DocumentSourceTypeSeeder::class
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('document_source_types');
    }
}
