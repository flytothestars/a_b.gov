<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserForEachRoleSeeder extends Seeder
{

    public function run()
    {
        if(config('demo.demo_password'))
        {
            $this->addUser('Administrator.Demo@yupi.test.kz', 'Administrator.Demo', '+70010000001', 'Administrator');
            $this->addUser('Manager.Demo@yupi.test.kz', 'Manager.Demo', '+70010000002', 'Manager');
            $this->addUser('Clien.Demot@yupi.test.kz', 'Client.Demo', '+70010000003', 'Client');
            $this->addUser('Distributor.Demo@yupi.test.kz', 'Distributor.Demo', '+70010000004', 'Distributor');
            $this->addUser('CoExecutor.Demo@yupi.test.kz', 'CoExecutor.Demo', '+70010000005', 'CoExecutor');
        }
    }

    private function addUser(string $email, string $name, string $phone, string $role): void
    {
        $user = User::query()->firstOrCreate(
            ['email' => $email], [
                'name' => $name,
                'password' => bcrypt(config('demo.demo_password')),
                'phone' => $phone
            ]
        );

        $user->assignRole($role);
    }
}
