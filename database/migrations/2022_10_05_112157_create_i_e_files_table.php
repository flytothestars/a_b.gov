<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIEFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_e_files', function (Blueprint $table) {
            $table->id();
            $table->uuid('appeal_id');
            $table->string('user_id');
            $table->string('file1');
            $table->string('file2');
            $table->string('file3');
            $table->string('file4');
            $table->string('file5');
            $table->string('file6');
            $table->string('file7');
            $table->string('file8');
            $table->string('file9');
            $table->string('file10');
            $table->string('file11');
            $table->string('file12');
            $table->string('file13');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_e_files');
    }
}
