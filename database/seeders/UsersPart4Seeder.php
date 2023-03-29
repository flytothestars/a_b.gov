<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UsersPart4Seeder extends Seeder
{

    public function run()
    {
        if(config('demo.demo_password'))
        {
            $this->addUser('77751029632@yupi.test.kz', 'Куанышев Бекжан Орынбаевич', '+77751029632', RoleEnum::Manager, 'Куанышев', 'Бекжан', 'Орынбаевич',  'Начальник отдела Услуг');
            $this->addUser('77015112332@yupi.test.kz', 'Онжан Бекжан Нурланович', '+77015112332', RoleEnum::Manager, 'Онжан', 'Бекжан', 'Нурланович',  'Начальник отдела Торговли');
            $this->addUser('70010000040@yupi.test.kz', 'Рустембекова Акбота Маратовна', '+70010000040', RoleEnum::Head, 'Рустембекова', 'Акбота', 'Маратовна',  'Директор');
            $this->addUser('70010000041@yupi.test.kz', 'Косточкина Регина Викторовна', '+70010000041', RoleEnum::Distributor, 'Косточкина', 'Регина', 'Викторовна',  'Главный менеджер');
            $this->addUser('70010000042@yupi.test.kz', 'Кудайбергенов Исламбек Нурадилулы', '+70010000042', RoleEnum::Distributor, 'Кудайбергенов', 'Исламбек', 'Нурадилулы',  'Менеджер');
            $this->addUser('70010000043@yupi.test.kz', 'Куренбеков Аскар Алимкулович', '+70010000043', RoleEnum::Distributor, 'Куренбеков', 'Аскар', 'Алимкулович',  'Проектный менеджер');
            $this->addUser('70010000044@yupi.test.kz', 'Әліпбай Ерболат Есболатұлы', '+70010000044', RoleEnum::Manager, 'Әліпбай', 'Ерболат', 'Есболатұлы',  'Директор ДРД');
            $this->addUser('70010000045@yupi.test.kz', 'Тарануха Рузана Саматовна', '+70010000045', RoleEnum::Manager, 'Тарануха', 'Рузана', 'Саматовна',  'Заместитель директора ДРД');
            $this->addUser('70010000046@yupi.test.kz', 'Жолдасбаева Айжан Сансызбаевна', '+70010000046', RoleEnum::Manager, 'Жолдасбаева', 'Айжан', 'Сансызбаевна',  'Директор ДСП');
            $this->addUser('77788881812@yupi.test.kz', 'Хайруллин Ерден Рашидович', '+77788881812', RoleEnum::Head, 'Хайруллин', 'Ерден', 'Рашидович',  'Зам.акима');
            $this->addUser('77752559101@yupi.test.kz', 'Бердиев Максат Аскарович', '+77752559101', RoleEnum::CoExecutor, 'Бердиев', 'Максат', 'Аскарович',  null);
            $this->addUser('70010000048@yupi.test.kz', 'Сабитов Бектас Ерланович', '+70010000048', RoleEnum::DistrictCurator, 'Сабитов', 'Бектас', 'Ерланович',  'Зам.акима Алмалинского района');
            $this->addUser('77017779986@yupi.test.kz', 'Белгибаев Олжас Талгатович', '+77017779986', RoleEnum::CoExecutor, 'Белгибаев', 'Олжас', 'Талгатович',  null);
            $this->addUser('77086340056@yupi.test.kz', 'Кенеев Ренат Бакдаулетович', '+77086340056', RoleEnum::DistrictCurator, 'Кенеев', 'Ренат', 'Бакдаулетович',  'Зам.акима Алатауского района');
            $this->addUser('77025000028@yupi.test.kz', 'Умирбеков Айбол Ерикович', '+77025000028', RoleEnum::CoExecutor, 'Умирбеков', 'Айбол', 'Ерикович',  null);
            $this->addUser('77015019990@yupi.test.kz', 'Садвакасова Жанар Сейтжановна', '+77015019990', RoleEnum::DistrictCurator, 'Садвакасова', 'Жанар', 'Сейтжановна',  'Зам.акима Бостандыкского района');
            $this->addUser('70010000049@yupi.test.kz', 'Мурзин Джанибек Алматулы', '+70010000049', RoleEnum::CoExecutor, 'Мурзин', 'Джанибек', 'Алматулы',  null);

            $this->addUser('77054444060@yupi.test.kz', 'Солтанбаев Берик Бекмырзаулы', '+77054444060', RoleEnum::DistrictCurator, 'Солтанбаев', 'Берик', 'Бекмырзаулы',  'Зам.акима Медеуского района');
            $this->addUser('77013784468@yupi.test.kz', 'Нуркасымов Кайрат Нурсоветович', '+77013784468', RoleEnum::CoExecutor, 'Нуркасымов', 'Кайрат', 'Нурсоветович',  null);

            $this->addUser('77019594439@yupi.test.kz', 'Дандыбаев Баглан Ерболович', '+77019594439', RoleEnum::DistrictCurator, 'Дандыбаев', 'Баглан', 'Ерболович',  'Зам.акима Наурызбайского района');
            $this->addUser('77087702922@yupi.test.kz', 'Заурбеков Ерлан Абирбекович', '+77087702922', RoleEnum::CoExecutor, 'Заурбеков', 'Ерлан', 'Абирбекович',  null);

            $this->addUser('77021809007@yupi.test.kz', 'Лебаев Наиль Муратжанович', '+77021809007', RoleEnum::DistrictCurator, 'Лебаев', 'Наиль', 'Муратжанович',  'Зам.акима Турксибского района');
            $this->addUser('70010000050@yupi.test.kz', 'Усеров Рустем Ерикович', '+70010000050', RoleEnum::CoExecutor, 'Усеров', 'Рустем', 'Ерикович',  null);

            $this->addUser('77762222870@yupi.test.kz', 'Акежанов Дамир Нурсултанович', '+77762222870', RoleEnum::DistrictCurator, 'Акежанов', 'Дамир', 'Нурсултанович',  'Зам.акима Жетысуского района');
            $this->addUser('70010000051@yupi.test.kz', 'Какенов Сырымбет Шакибаевич', '+70010000051', RoleEnum::CoExecutor, 'Какенов', 'Сырымбет', 'Шакибаевич',  null);

            $this->addUser('77015112070@yupi.test.kz', 'Хаиров Тимур Кенжебулатович', '+77015112070', RoleEnum::CoExecutor, 'Хаиров', 'Тимур', 'Кенжебулатович',  null);
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
