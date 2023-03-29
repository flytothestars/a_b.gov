<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceGroupAddRemoteServiceUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('service_groups', 'remote_service_url')) {
            Schema::table('service_groups', function (Blueprint $table) {
                $table->text('remote_service_url')->nullable();
            });
        }
        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\AddRemoteUrlForService::class
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
            $table->dropColumn('remote_service_url');
        });
    }
}
