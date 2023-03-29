<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserForRoleUpiHead extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addUser('e.orazalin@almaty.gov.kz', 'Оразалин Еркебулан Нурланович', '+77027277717', 'UPIHead', 'Оразалин', 'Еркебулан', 'Нурланович');
    }

    private function addUser(string $email, string $name, string $phone, string $role, $lastName, $firstName, $secondName): void
    {
//        $user = User::query()->updateOrCreate(
//            ['email' => $email], [
//                'name' => $name,
//                'password' => bcrypt(config('demo.demo_password')),
//                'phone' => $phone
//            ]
//        );

//        $user = User::query()->where('phone', '+77027277717');
//
//        $user->assignRole($role);
//
//        Profile::query()->updateOrCreate(
//            ['user_id' => $user->id],
//            [
//                'id' => Uuid::uuid4(),
//                'first_name' => $firstName,
//                'last_name' => $lastName,
//                'second_name' => $secondName,
//            ]
//        );
    }
}
