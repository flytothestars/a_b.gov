<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run() : void
    {
        if(config('demo.demo_password')) {

            $admin = User::firstOrCreate(
                ['email' => 'administrator@yupi.test.kz'], [
                    'name' => 'Administrator',
                    'password' => bcrypt(config('demo.demo_password')),
                ]
            );
            $admin->assignRole('Administrator');


        }
    }
}
