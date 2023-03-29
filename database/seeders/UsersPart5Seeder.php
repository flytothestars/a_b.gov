<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UsersPart5Seeder extends Seeder
{

    public function run()
    {
        if(config('demo.demo_password'))
        {
            $this->addUser('a.anuarbekova@qolday.kz', 'Ануарбекова Айнура Ануарбековна', '+77015229992', RoleEnum::Manager, 'Ануарбекова', 'Айнура', 'Ануарбековна',  'Заместитель директора ДСП');
        }
    }

    private function addUser(string $email, string $name, string $phone, string $role, string $lastName, string $firstName, string $secondName, $position): void
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
                'last_name' => $lastName,
                'second_name' => $secondName,
                'position' =>$position
            ]
        );
    }
}
