<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class ChangeAppealsTable extends Migration
{

    public function up() : void
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('status')->references('id')->on('status_appeals');
            $table->foreign('category_id')->references('id')->on('service_groups');
        });
	}
    public function down() : void
    {
        //
    }
}
