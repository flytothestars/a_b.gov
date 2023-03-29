<?php

use Database\Seeders\AddServiceCategoryToCategoryAppealsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignServiceCategoriesToCategoryAppeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_appeals', function (Blueprint $table) {
            $table->uuid('service_category_id')->nullable();
        });
        Schema::table('category_appeals', function (Blueprint $table) {
            $table->foreign('service_category_id')->references('id')->on('service_categories');
        });
        Artisan::call('db:seed', [
            '--class' => AddServiceCategoryToCategoryAppealsSeeder::class
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_appeals', function (Blueprint $table) {
            //
        });
    }
}
