<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;

class RoleForUIP extends Seeder
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
            $this->addRole('Head');
            $this->addRole('UpiCurator');
            $this->addRole('DistrictCurator');

            $this->addUser('Head.Demo.P2@yupi.test.kz', 'Head.Demo.P2', '+70010000020', 'Head', 'Head');
            $this->addUser('UpiCurator1.Demo.P2@yupi.test.kz', 'Сагиндиков К.А. Зам.руководителя УПиИ', '+70010000021', 'UpiCurator', 'Сагиндиков К.А. Зам.руководителя УПиИ');
            $this->addUser('UpiCurator2.Demo.P2@yupi.test.kz', 'UАкылбеков К.А. Зам.руководителя УПиИ', '+70010000022', 'UpiCurator', 'Акылбеков К.А. Зам.руководителя УПиИ');
            $this->addUser('UpiCurator3.Demo.P2@yupi.test.kz', 'Тазабек Д.А. Зам.руководителя УПиИ', '+70010000023', 'UpiCurator', 'Тазабек Д.А. Зам.руководителя УПиИ');
            $this->addUser('DistrictCurator1.Demo.P2@yupi.test.kz', 'Зам.акима 1', '+70010000024', 'DistrictCurator', 'Зам.акима 1');
            $this->addUser('DistrictCurator2.Demo.P2@yupi.test.kz', 'Зам.акима 2', '+70010000025', 'DistrictCurator', 'Зам.акима 2');
            $this->addUser('DistrictCurator3.Demo.P2@yupi.test.kz', 'Зам.акима 3', '+70010000026', 'DistrictCurator', 'Зам.акима 3');
        }
    }

    private function addRole(string $name){
        Role::query()->firstOrCreate([
            'name' => $name
        ], [
            'guard_name' => 'web'
        ]);
    }

    private function addUser(string $email, string $name, string $phone, string $role, $firstName): void
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


//flow_type добавить
//колдау
//упи
//
//добавить в appeal и в appeal_histories UipCurator и DistrictCurator

