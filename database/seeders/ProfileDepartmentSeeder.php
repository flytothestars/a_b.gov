<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addDepartmentToProfile('+77788083333', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae');//	УПиИ, Направление 1
        $this->addDepartmentToProfile('+77058078788', 'dadc6867-ca42-415b-ac8f-8e07a4dbe7b4');//	УПиИ, Направление 2
        $this->addDepartmentToProfile('+77075500008', '8ed4991a-9ca7-4a70-a007-30999515885d');//	УПиИ, Направление 3
        $this->addDepartmentToProfile('+77751029632', '649d8633-6e72-46c4-b28a-15f89eb3331b');//	УПиИ, Направление 1, Отдел 1
        $this->addDepartmentToProfile('+77015112332', '3b3e4660-4724-4f42-9c4e-d7fdd8205772');//	УПиИ, Направление 1, Отдел 2
        $this->addDepartmentToProfile('+77088105638', '840542f4-4dc6-4b94-89dd-8e48bad53873');//	ЦП "Qolday", ДКРНП
        $this->addDepartmentToProfile('+77756235800', '840542f4-4dc6-4b94-89dd-8e48bad53873');//	ЦП "Qolday", ДКРНП
        $this->addDepartmentToProfile('+77086032371', '840542f4-4dc6-4b94-89dd-8e48bad53873');//	ЦП "Qolday", ДКРНП
        $this->addDepartmentToProfile('+77021377735', '840542f4-4dc6-4b94-89dd-8e48bad53873');//	ЦП "Qolday", ДКРНП
        $this->addDepartmentToProfile('+77757718499', '6362e34f-cf6d-41e4-a128-951ee62da35f');//	ЦП "Qolday", ДРД
        $this->addDepartmentToProfile('+77076565638', '6362e34f-cf6d-41e4-a128-951ee62da35f');//	ЦП "Qolday", ДРД
        $this->addDepartmentToProfile('+77011118977', '615cfce0-aa59-4f42-856a-71ab86fd97a4');//	ЦП "Qolday", ДСП
        $this->addDepartmentToProfile('+77015229992', '615cfce0-aa59-4f42-856a-71ab86fd97a4');//	ЦП "Qolday", ДСП
        $this->addDepartmentToProfile('+77788881812', '578100bf-af7e-433d-b1d4-3fd87e6a5c81');//	Алмалинский акимат
        $this->addDepartmentToProfile('+77752559101', '578100bf-af7e-433d-b1d4-3fd87e6a5c81');//	Алмалинский акимат
        $this->addDepartmentToProfile('+70010000048', '4ca27543-892c-4dc9-84e4-d7b5e774adf8');//	Алатауский акимат
        $this->addDepartmentToProfile('+77017779986', '4ca27543-892c-4dc9-84e4-d7b5e774adf8');//	Алатауский акимат
        $this->addDepartmentToProfile('+77086340056', 'df76024a-ab23-4970-8101-e4edaccf77e6');//	Ауэзовский акимат
        $this->addDepartmentToProfile('+77025000028', 'df76024a-ab23-4970-8101-e4edaccf77e6');//	Ауэзовский акимат
        $this->addDepartmentToProfile('+77015019990', 'b0c4995f-fd69-4003-9bb5-3b563ad8b716');//	Бостандыкский акимат
        $this->addDepartmentToProfile('+70010000049', 'b0c4995f-fd69-4003-9bb5-3b563ad8b716');//	Бостандыкский акимат
        $this->addDepartmentToProfile('+77054444060', '8f898799-35a1-49f2-9d37-edf5a20ae102');//	Медеуский акимат
        $this->addDepartmentToProfile('+77013784468', '8f898799-35a1-49f2-9d37-edf5a20ae102');//	Медеуский акимат
        $this->addDepartmentToProfile('+77019594439', 'dd2fa2ef-1ace-4ee6-b6c0-fa55bbb0baec');//	Наурызбайский акимат
        $this->addDepartmentToProfile('+77087702922', 'dd2fa2ef-1ace-4ee6-b6c0-fa55bbb0baec');//	Наурызбайский акимат
        $this->addDepartmentToProfile('+77021809007', '5ea60f7e-8a96-4211-84cb-5d59a9ebbd7d');//	Турксибский акимат
        $this->addDepartmentToProfile('+70010000050', '5ea60f7e-8a96-4211-84cb-5d59a9ebbd7d');//	Турксибский акимат
        $this->addDepartmentToProfile('+77762222870', 'b5550f23-be71-4839-b505-3275db0a5293');//	Жетысуский акимат
        $this->addDepartmentToProfile('+70010000051', '7f0015ec-303d-4972-a23b-41302a730330');//	Almaty MFO
        $this->addDepartmentToProfile('+77015112070', 'b5eebd4b-4d20-4f63-86f5-5c60805f31e2');//	Almaty Finance
    }

    private function addDepartmentToProfile($phone, $departmentId){
        $user = User::query()->where('phone', $phone)->first();
        if($user){
            $profile = Profile::query()->find($user->profile->id);
            if($profile){
                $profile->department_id = $departmentId;
                $profile->save();
            }
        }
    }
}
