<?php


namespace Database\Seeders;


use App\Models\Appeal;
use App\Models\CategoryAppeal;
use App\Models\ServiceGroup;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class NewServiceGroups extends Seeder
{
    public function run() : void
    {
        StorageFile::query()->where('storable_type',  'App\Models\CategoryAppeal')->delete();
        CategoryAppeal::query()->delete();
        Appeal::query()->delete();
        StorageFile::query()->where('storable_type',  'App\Models\ServiceGroup')->delete();
        ServiceGroup::query()->delete();

        $data = [
            ['id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'no'=>1, 'name' => 'Финансирование', 'description' => 'Если у Вас нет первоначального капитала для открытия бизнеса, Вы можете выиграть безвозмездный грант или получить льготное кредитование в рамках государственных и региональных программ. Мы окажем Вам бесплатную консультацию с дальнейшим сопровождением Вашего проекта в банках второго уровня, АО «Фонд развития предпринимательства «Даму», ТОО «Almaty Finance», ТОО «МФО «Almaty», АО «Фонд финансовой поддержки сельского хозяйства» и других организациях. Для получения услуги оставьте заявку на портале.' ],
            ['id' => '23ed0560-60f2-4bcd-b3e0-13cfde9e272a', 'no'=>2, 'name' => 'Земельные отношения' , 'description' => ''],
            ['id' => '6f4a2d26-6119-41fd-b6fa-ec6358b73675', 'no'=>3, 'name' => 'Инженерные сети' , 'description' => ''],
            ['id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab', 'no'=>4, 'name' => 'Лицензий и другие разрешения' , 'description' => 'Любому бизнесу нужен полный пакет разрешительных документов. Как показывает практика, наиболее часто предприниматели сталкиваются с проблемами получения документов в сфере земельных отношений, архитектуры, недвижимости, подключения к инфраструктурным сетям и получения лицензий. Если Вы столкнулись с подобной проблемой, обратитесь к нашему менеджеру, и Вы получите нужный документ в установленные сроки. Для этого достаточно оставить заявку на портале.' ],
            ['id' => '91816472-2491-4ae5-996f-dcbda5d6b4dc', 'no'=>5, 'name' => 'Строительство' , 'description' => ''],
            ['id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb', 'no'=>6, 'name' => 'Бесплатное обучение' , 'description' => '' ],
            ['id' => '17fca7d8-47ce-4c98-abb6-ee3bb405a9db', 'no'=>7, 'name' => 'Другое'  , 'description' => ''],
        ];
        foreach ($data as $serviceGroup) {
            ServiceGroup::query()->updateOrCreate(['id' => $serviceGroup['id']], ['name' => $serviceGroup['name'], 'description' => $serviceGroup['description'], 'order_no'=>$serviceGroup['no']]);
        }

    }
}
