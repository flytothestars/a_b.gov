<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserForEachRolePart2Seeder extends Seeder
{
    public function run()
    {
        if(config('demo.demo_password'))
        {
            $this->addUser('Administrator.Demo.P2@yupi.test.kz', 'Administrator.Demo.P2', '+70010000006', 'Administrator');
            $this->addUser('Manager.Demo.P2@yupi.test.kz', 'Manager.Demo.P2', '+70010000007', 'Manager');
            $this->addUser('Clien.Demot.P2@yupi.test.kz', 'Client.Demo.P2', '+70010000008', 'Client');
            $this->addUser('Distributor.Demo.P2@yupi.test.kz', 'Distributor.Demo.P2', '+70010000009', 'Distributor');
            $this->addUser('CoExecutor.Demo.P2@yupi.test.kz', 'CoExecutor.Demo.P2', '+70010000010', 'CoExecutor');
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
