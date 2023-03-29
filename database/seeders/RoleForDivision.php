<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;

class RoleForDivision extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('demo.demo_password'))
        {
            $this->addRole('DivisionCurator');

            $this->addUser('DivisionCurator1.P1@yupi.test.kz', 'DivisionCurator1.P1', '+70010000060', 'DivisionCurator', 'DivisionCurator1.P1', '5942d308-041c-49da-8e0e-4a31b7d5d068');
            $this->addUser('DivisionCurator2.P1@yupi.test.kz', 'DivisionCurator2.P1', '+70010000061', 'DivisionCurator', 'DivisionCurator2.P1', '615cfce0-aa59-4f42-856a-71ab86fd97a4');

        }
    }

    private function addRole(string $name){
        Role::query()->firstOrCreate([
            'name' => $name
        ], [
            'guard_name' => 'web'
        ]);
    }

    private function addUser(string $email, string $name, string $phone, string $role, $firstName, $departmentId): void
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
                'last_name' => ' ',
                'department_id' => $departmentId
            ]
        );
    }
}


//flow_type добавить
//колдау
//упи
//
//добавить в appeal и в appeal_histories UipCurator и DistrictCurator

