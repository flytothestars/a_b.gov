<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_buses', function (Blueprint $table) {
            $table->uuid();
            $table->string('business_uid');
            $table->string('name');
            $table->string('display_name');
            $table->string('location');
            $table->string('address_line');
            $table->string('address_line_stat');
            $table->string('region_uid');
            $table->string('district_uid');
            $table->string('source');
            $table->string('activity_subclasses');
            $table->string('employee_count');
            $table->string('has_cash_register');
            $table->string('cash_register_count');
            $table->string('need_to_contact');
            $table->string('refused_to_provide_identification_number');
            $table->string('identification_number_not_found_in_stat');
            $table->string('status');
            $table->string('status_changed');
            $table->string('created');
            $table->string('modified');
            $table->string('industries');
            $table->string('entities');
            $table->string('entity_name');
            $table->string('entity_full_name');
            $table->string('entity_identification_number');
            $table->string('entity_activity_codes');
            $table->string('entity_is_individual');
            $table->string('activity_comment');
            $table->string('last_request_date');
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
        Schema::dropIfExists('entity_buses');
    }
}
