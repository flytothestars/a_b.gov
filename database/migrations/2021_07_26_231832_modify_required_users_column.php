<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRequiredUsersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::table('users')->truncate();
        Schema::table('users', function (Blueprint $table) {
            $table->string('email',255)->nullable()->change();
            $table->string('phone',12)->nullable(false)->unique()->change();
        });
        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\UsersWithPhoneRequiredSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone',12)->nullable()->change();
            $table->dropUnique('users_phone_unique');
        });
    }
}
