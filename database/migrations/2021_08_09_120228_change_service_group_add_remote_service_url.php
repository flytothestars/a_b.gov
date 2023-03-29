<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeServiceGroupAddRemoteServiceUrl extends Migration
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
                $table->string('remote_service_url', 4096)->nullable();
            });
        }
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => \Database\Seeders\ChangeOrderOfServiceGroupSeederRemoteUrl::class
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
