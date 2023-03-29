<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeServiceGroupsOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \App\Models\StorageFile::query()->where('storable_type', 'App\Models\ServiceGroup')->delete();
        DB::table('service_groups')->truncate();
        Schema::table('service_groups', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\ChangeOrderOfServiceGroupSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_groups', function (Blueprint $table){
            $table->dropColumn('description');
        });
    }
}
