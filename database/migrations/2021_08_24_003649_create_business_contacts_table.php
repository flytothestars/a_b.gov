<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessContactsTable extends Migration
{

    public function up()
    {
        Schema::create('business_contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name', 256)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->uuid('mio_id')->unique()->nullable();
            $table->uuid('business_id')->nullable();
        });

        Schema::table('business_contacts', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->index(['business_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_contacts');
    }
}
