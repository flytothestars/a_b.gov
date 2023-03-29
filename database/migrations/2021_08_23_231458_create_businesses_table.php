<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('display_name', 250)->nullable();
            $table->string('address_line', 2048)->nullable();
            $table->string('address_line_stat', 2048)->nullable();
            $table->string('source', 64)->nullable();
            $table->integer('employee_count')->nullable();
            $table->boolean('has_cash_register')->nullable();
            $table->integer('cash_register_count')->nullable();
            $table->boolean('has_payment_terminal')->nullable();
            $table->boolean('need_to_contact')->nullable();
            $table->boolean('refused_to_provide_identification_number')->nullable();
            $table->boolean('identification_number_not_found_in_stat')->nullable();
            $table->string('status', 64)->nullable();
            $table->dateTime("status_changed")->nullable();
            $table->dateTime("created")->nullable();
            $table->dateTime("modified")->nullable();
            $table->decimal('location_long', 16, 13)->nullable();
            $table->decimal('location_lat', 16, 13)->nullable();
            $table->uuid('mio_id')->unique()->nullable();
        });

        Schema::table('businesses', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->index(['organization_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
