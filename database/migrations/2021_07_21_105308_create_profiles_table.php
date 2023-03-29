<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->uuid('industries_id')->nullable();
            $table->string('first_name', 256)->nullable();
            $table->string('second_name', 256)->nullable();
            $table->string('last_name', 256)->nullable();
            $table->string('position', 1024)->nullable();
            $table->string('company_name', 2048)->nullable();
            $table->string('iin', 20)->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
