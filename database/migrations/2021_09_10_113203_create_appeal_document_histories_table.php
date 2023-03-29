<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealDocumentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeal_document_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('appeal_id');
            $table->uuid('appeal_document_id');
            $table->unsignedBigInteger('appeal_history_id');
            $table->timestamps();

            $table->foreign('appeal_id')->references('id')->on('appeals');
            $table->foreign('appeal_document_id')->references('id')->on('appeal_documents');
            $table->foreign('appeal_history_id')->references('id')->on('appeal_histories');
            $table->unique(['appeal_document_id', 'appeal_history_id', 'appeal_id'], 'unique_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeal_document_histories');
    }
}
