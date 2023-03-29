<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealReferenceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'appeal_reference_histories',
            function (Blueprint $table)
            {
                $table->uuid('id')
                      ->primary()
                ;
                $table->uuid('appeal_id');
                $table->uuid('parent_appeal_id');
                $table->unsignedBigInteger('distributor_id')
                      ->nullable()
                ;
                $table->timestamps();
                $table->unique(['appeal_id', 'parent_appeal_id'], 'unique_reference');
            }
        );

        Schema::table('appeal_reference_histories', function (Blueprint $table) {
            $table->foreign('appeal_id')->references('id')->on('appeals');
            $table->foreign('parent_appeal_id')->references('id')->on('appeals');
            $table->foreign('distributor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeal_reference_histories');
    }
}
