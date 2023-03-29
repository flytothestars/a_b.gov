<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::dropIfExists('appeals');
        Schema::create('appeals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->uuid('type_id');
            $table->text('content');
            $table->uuid('status');

			$table->timestamp('createDate')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updateDate')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeals');
    }
}
