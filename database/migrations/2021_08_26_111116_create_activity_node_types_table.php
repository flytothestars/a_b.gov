<?php

use Database\Seeders\ActivityNodeTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateActivityNodeTypesTable extends Migration
{
    public function up()
    {
        Schema::create('activity_node_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 250)->nullable();
        });

        Artisan::call('db:seed', [
            '--class' => ActivityNodeTypeSeeder::class
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('activity_node_types');
    }
}
