<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_banks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('bank_code');
            $table->string('header', 1024);
            $table->text('account_content');
            $table->text('loan_content');
            $table->string('application');
            $table->string('rate');
            $table->string('term');
            $table->string('open_account');
            $table->string('account_price');
            $table->string('account_managment');
            $table->text('open_account_url');
            $table->text('get_loan_url');
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
        Schema::dropIfExists('service_banks');
    }
}
