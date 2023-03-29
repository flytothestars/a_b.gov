<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewServiceTax extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' =>  \Database\Seeders\AddNewServiceGroupByTaxName::class
        ]);

        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' =>  \Database\Seeders\AddCategoryAppealTax::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
