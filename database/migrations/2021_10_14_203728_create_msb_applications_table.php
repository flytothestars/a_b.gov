<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsbApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'msb_applications',
            function (Blueprint $table)
            {
                $table->uuid('id')
                      ->primary()
                ;
                $table->string('bin');
                $table->string('name');
                $table->string('phone');
                $table->string('amount');
                $table->string('turnover');
                $table->unsignedBigInteger('program_id');
                $table->unsignedBigInteger('program_type');
                $table->json('banks');
                $table->boolean('is_send')
                      ->nullable()
                ;
                $table->integer('response_code')
                      ->nullable()
                ;
                $table->longText('response')
                      ->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msb_applications');
    }
}
