<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealDocumentsTable extends Migration
{

    public function up()
    {
        Schema::create('appeal_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->uuid('appeal_id');
            $table->uuid('document_source_type_id');
            $table->string('description', 512)->nullable();
            $table->foreignId('created_by')->constrained('users','id');
        });

        Schema::table('appeal_documents', function (Blueprint $table) {
            $table->foreign('appeal_id')->references('id')->on('appeals');
            $table->index(['appeal_id']);
            $table->foreign('document_source_type_id')->references('id')->on('document_source_types');
            $table->index(['document_source_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appeal_documents');
    }
}
