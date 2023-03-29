<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryMapSeeder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*\Illuminate\Support\Facades\DB::statement('
            insert into external_categories
            select mio_id, name from service_groups where mio_id is not null
        ');

        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => \Database\Seeders\CategoryMap::class
        ]);*/
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
