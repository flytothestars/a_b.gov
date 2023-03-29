<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewPartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\StorageFile::query()->where('storable_type',  'App\Models\Partner')->delete();
        DB::table('partners')->truncate();
        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\NewPartnersSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\StorageFile::query()->where('storable_type', 'App\Models\Partner')->delete();
        DB::table('partners')->truncate();
        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\PartnersSeeder::class
        ]);
    }
}
