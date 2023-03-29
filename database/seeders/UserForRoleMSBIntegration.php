<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserForRoleMSBIntegration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addUser('MSBIntegration@yupi.test.kz', 'MSBIntegration', '+70010010000', 'MSBIntegration', 'MSBIntegration');
    }

    private function addUser(string $email, string $name, string $phone, string $role, $firstName): void
    {
        $user = User::query()->firstOrCreate(
            ['email' => $email], [
                'name' => $name,
                'password' => bcrypt('>,Qcqsqv6;AVdcYcZflR[df9;q4n:5'),
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
