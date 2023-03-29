<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UsersPart3Seeder extends Seeder
{

    public function run()
    {
        if(config('demo.demo_password'))
        {
            $this->addUser('Manager.Demo.P3_1@yupi.test.kz', 'Manager.Demo.P3_1', '+70010000011', 'Manager', 'Исполнитель ДСП Qolday');
            $this->addUser('Manager.Demo.P3_2@yupi.test.kz', 'Manager.Demo.P3_2', '+70010000012', 'Manager', 'Исполнитель ДО Qolday');
        }
    }

    private function addUser(string $email, string $name, string $phone, string $role, string $firstName): void
    {
        $user = User::query()->firstOrCreate(
            ['email' => $email], [
                'name' => $name,
                'password' => bcrypt(config('demo.demo_password')),
                'phone' => $phone
            ]
        );

        $user->assignRole($role);

        Profile::query()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'id' => Uuid::uuid4(),
                'first_name' => $firstName,
                'last_name' => ' '
            ]
        );
    }
}
