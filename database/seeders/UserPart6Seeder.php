<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserPart6Seeder extends Seeder
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
            $this->addUser('k.sagindikov@almaty.gov.kz', '+77788083333', '+77788083333', RoleEnum::UpiCurator, 'Сагиндиков', 'Канат', 'Амангельдиевич', 'Зам.руководителя УПиИ', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae');
            $this->addUser('k.akylbekov@almaty.gov.kz', '+77058078788', '+77788083334', RoleEnum::UpiCurator, 'Акылбеков', 'Калибек', 'Акылбекович', 'Зам.руководителя УПиИ', 'dadc6867-ca42-415b-ac8f-8e07a4dbe7b4');
            $this->addUser('d.tazabek@almaty.gov.kz', '+77075500008', '+77788083335', RoleEnum::UpiCurator, 'Тазабек', 'Дамир', 'Акангалиевич', 'Зам.руководителя УПиИ', '8ed4991a-9ca7-4a70-a007-30999515885d');
            $this->addUser('77788083336@almaty.gov.kz', '+77751029632', '+77788083336', RoleEnum::Manager, 'Куанышев', 'Бекжан', '', 'Начальник отдела Услуг', '649d8633-6e72-46c4-b28a-15f89eb3331b');
            $this->addUser('77788083337@almaty.gov.kz', '+77015112332', '+77788083337', RoleEnum::Manager, 'Онжан', 'Бекжан', 'Нурланович', 'Начальник отдела Торговли', '3b3e4660-4724-4f42-9c4e-d7fdd8205772');
            $this->addUser('a.rustembekova@qolday.kz', '+77088105638', '+77788083338', RoleEnum::Head, 'Рустембекова', 'Акбота', 'Маратовна', 'Директор ДКРНП', '840542f4-4dc6-4b94-89dd-8e48bad53873');
            $this->addUser('r.kostochnika@qolday.kz', '+77756235800', '+77788083339', RoleEnum::Distributor, 'Косточкина', 'Регина', 'Викторовна', 'Главный менеджер', '840542f4-4dc6-4b94-89dd-8e48bad53873');
            $this->addUser('i.kudaibergenov@qolday.kz', '+77086032371', '+77788083340', RoleEnum::Distributor, 'Кудайбергенов', 'Исламбек', 'Нурадилулы', 'Менеджер', '840542f4-4dc6-4b94-89dd-8e48bad53873');
            $this->addUser('a.kurenbekov@qolday.kz', '+77021377735', '+77788083341', RoleEnum::Distributor, 'Куренбеков', 'Аскар', 'Алимкулович', 'Проектный менеджер', '840542f4-4dc6-4b94-89dd-8e48bad53873');
            $this->addUser('ye.alipbay@qolday.kz', '+77757718499', '+77788083342', RoleEnum::DivisionCurator, 'Әліпбай', 'Ерболат', 'Есболатұлы', 'Директор ДРД', '6362e34f-cf6d-41e4-a128-951ee62da35f');
            $this->addUser('r.tarakukha@qolday.kz', '+77076565638', '+77788083343', RoleEnum::Manager, 'Тарануха', 'Рузана', 'Саматовна', 'Заместитель директора ДРД', '6362e34f-cf6d-41e4-a128-951ee62da35f');
            $this->addUser('a.zholdasbayeva@qolday.kz', '+77011118977', '+77788083344', RoleEnum::DivisionCurator, 'Жолдасбаева', 'Айжан', 'Сансызбаевна', 'Директор ДСП', '615cfce0-aa59-4f42-856a-71ab86fd97a4');
            $this->addUser('a.anuarbekova@qolday.kz', '+77015229992', '+77788083345', RoleEnum::Manager, 'Ануарбекова', 'Айнура', 'Ануарбековна', 'Заместитель директора ДСП', '615cfce0-aa59-4f42-856a-71ab86fd97a4');
            $this->addUser('s.ormanova@qolday.kz.', '+77015500111', '+77788083346', RoleEnum::DivisionCurator, 'Орманова', 'Сауле', 'Баяновна', 'Директор ДО', '5942d308-041c-49da-8e0e-4a31b7d5d068');
            $this->addUser('sh.baimagambetova@qolday.kz', '+77015500112', '+77788083347', RoleEnum::Manager, 'Баймагамбетова', 'Шапагат', 'Аскарбековна', 'Заместитель директора ДО', '5942d308-041c-49da-8e0e-4a31b7d5d068');
            $this->addUser('ye.khairullin@almaty.gov.kz', '+77788881812', '+77788083348', RoleEnum::DistrictCurator, 'Хайруллин', 'Ерден', 'Рашидович', 'Зам.акима Алмалинского района', '578100bf-af7e-433d-b1d4-3fd87e6a5c81');
            $this->addUser('m.berdiev@almaty.gov.kz', '+77752559101', '+77788083349', RoleEnum::CoExecutor, 'Бердиев', 'Максат', 'Аскарович', 'Соисполнитель', '578100bf-af7e-433d-b1d4-3fd87e6a5c81');
            $this->addUser('b.sabitov@almaty.gov.kz', '+70010000048', '+77788083350', RoleEnum::DistrictCurator, 'Сабитов', 'Бектас', 'Ерланович', 'Зам.акима Алатауского района', '4ca27543-892c-4dc9-84e4-d7b5e774adf8');
            $this->addUser('o.belgibaev@almaty.gov.kz', '+77017779986', '+77788083351', RoleEnum::CoExecutor, 'Белгибаев', 'Олжас', 'Талгатович', 'Соисполнитель', '4ca27543-892c-4dc9-84e4-d7b5e774adf8');
            $this->addUser('r.keneev@almaty.gov.kz', '+77086340056', '+77788083352', RoleEnum::DistrictCurator, 'Кенеев', 'Ренат', 'Бакдаулетович', 'Зам.акима Ауэзовского района', 'df76024a-ab23-4970-8101-e4edaccf77e6');
            $this->addUser('a.umirbekov@almaty.gov.kz', '+77025000028', '+77788083353', RoleEnum::CoExecutor, 'Умирбеков', 'Айбол', 'Ерикович', 'Соисполнитель', 'df76024a-ab23-4970-8101-e4edaccf77e6');
            $this->addUser('zha.sadvakasova@almaty.gov.kz', '+77015019990', '+77788083354', RoleEnum::DistrictCurator, 'Садвакасова', 'Жанар', 'Сейтжановна', 'Зам.акима Бостандыкского района', 'b0c4995f-fd69-4003-9bb5-3b563ad8b716');
            $this->addUser('d.murzin@almaty.gov.kz', '+70010000049', '+77788083355', RoleEnum::CoExecutor, 'Мурзин', 'Джанибек', 'Алматулы', 'Соисполнитель', 'b0c4995f-fd69-4003-9bb5-3b563ad8b716');
            $this->addUser('be.soltanbaev@almaty.gov.kz', '+77054444060', '+77788083356', RoleEnum::DistrictCurator, 'Солтанбаев', 'Берик', 'Бекмырзаулы', 'Зам.акима Медеуского района', '8f898799-35a1-49f2-9d37-edf5a20ae102');
            $this->addUser('ka.nurkasymov@almaty.gov.kz', '+77013784468', '+77788083357', RoleEnum::CoExecutor, 'Нуркасымов', 'Кайрат', 'Нурсоветович', 'Соисполнитель', '8f898799-35a1-49f2-9d37-edf5a20ae102');
            $this->addUser('b.dandybaev@almaty.gov.kz', '+77019594439', '+77788083358', RoleEnum::DistrictCurator, 'Дандыбаев', 'Баглан', 'Ерболович', 'Зам.акима Наурызбайского района', 'dd2fa2ef-1ace-4ee6-b6c0-fa55bbb0baec');
            $this->addUser('e.zaurbekov@almaty.gov.kz', '+77087702922', '+77788083359', RoleEnum::CoExecutor, 'Заурбеков', 'Ерлан', 'Абирбекович', 'Соисполнитель', 'dd2fa2ef-1ace-4ee6-b6c0-fa55bbb0baec');
            $this->addUser('na.lebaev@almaty.gov.kz', '+77021809007', '+77788083360', RoleEnum::DistrictCurator, 'Лебаев', 'Наиль', 'Муратжанович', 'Зам.акима Турксибского района', '5ea60f7e-8a96-4211-84cb-5d59a9ebbd7d');
            $this->addUser('r.userov@almaty.gov.kz', '+70010000050', '+77788083361', RoleEnum::CoExecutor, 'Усеров', 'Рустем', 'Ерикович', 'Соисполнитель', '5ea60f7e-8a96-4211-84cb-5d59a9ebbd7d');
            $this->addUser('da.akezhanov@almaty.gov.kz', '+77762222870', '+77788083362', RoleEnum::DistrictCurator, 'Акежанов', 'Дамир', 'Нурсултанович', 'Зам.акима Жетысуского района', 'b5550f23-be71-4839-b505-3275db0a5293');
            $this->addUser('77788083363@almaty.gov.kz', '+70010000051', '+77788083363', RoleEnum::CoExecutor, 'Какенов', 'Сырымбет', 'Шакибаевич', 'Соисполнитель', '7f0015ec-303d-4972-a23b-41302a730330');
            $this->addUser('77788083364@almaty.gov.kz', '+77015112070', '+77788083364', RoleEnum::CoExecutor, 'Хаиров', 'Тимур', 'Кенжебулатович', 'Соисполнитель', 'b5eebd4b-4d20-4f63-86f5-5c60805f31e2');
            $this->addUser('a.tastanbekova@qolday.kz', '+77071145632','+77071145632',RoleEnum::PressSecretary,'Тастанбекова', 'Анар', 'Рахимбердиевна',  'Пресс-секретарь', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae');
        }
    }

    private function addUser(string $email, string $oldPhone, string $newPhone, string $role, string $lastName, string $firstName, string $secondName, $position, $departmentId): void
    {

        $user = User::query()->updateOrCreate(
            ['phone' => $oldPhone], [
                'name' => $lastName . ' ' . $firstName . ' ' . $secondName,
                'password' => bcrypt(config('demo.demo_password')),
                'phone' => $newPhone,
                'email' => $email
            ]
        );

        $user->syncRoles($role);

        Profile::query()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'id' => Uuid::uuid4(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'second_name' => $secondName,
                'position' =>$position,
                'department_id' => $departmentId
            ]
        );
    }
}
