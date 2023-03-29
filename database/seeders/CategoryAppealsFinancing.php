<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class CategoryAppealsFinancing extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => '2b2701aa-02cc-4659-867b-596538dfc692',
                'name' => 'Льготное кредитование от 58 млн. до 500 млн. тенге',
                'description' => 'Ставка вознаграждения: 2% — для многодетных малообеспеченных семей, инвалидов I и II группы, семей воспитывающих детей-инвалидов и резидентов промышленных парков; 6% — для всех других категорий заемщиков',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/survey?#fromMillion'
            ],
            [
                'id' => '321ee49a-4a05-44b8-b3a3-706dd5ba0b64',
                'name' => 'Беззалоговое кредитование',
                'description' => 'Сумма кредитования: от 100 000 до 6 000 000 тенге; Сроки кредитования: от 3х до 24х месяцев; Ставка вознаграждения: 12% годовых;',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/survey?#noCollateral'
            ],
            [
                'id' => 'b0120dc3-5c53-4f42-9fb1-827be1cfd5ca',
                'name' => 'Частичное гарантирование Дорожная карта бизнеса - 2025',
                'description' => 'Максимальный размер гарантии: до 85 % от суммы займа',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/survey?#notEnoughCollateral'
            ],
            [
                'id' => 'ef23ef2e-1ba8-4b28-9b14-fb81fb91b26e',
                'name' => 'Льготное кредитование до 58 млн. тенге',
                'description' => 'Ставка вознаграждения: 2% — для многодетных малообеспеченных семей, инвалидов I и II группы, семей воспитывающих детей-инвалидов и резидентов промышленных парков; 6% — для всех других категорий заемщиков',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/survey?#upToMillion'
            ],
            [
                'id' => 'f1aa7791-deb3-41e2-a10a-a61412a8afdb',
                'name' => 'Государственные гранты Дорожная карта бизнеса 2025',
                'description' => 'Сумма государственного гранта от 2 до 5 млн тенге Срок реализации бизнес-проекта не более 18 месяцев',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/survey?#stateGrant'
            ],
        ];

        foreach ($data as $category) {
            CategoryAppeal::query()->updateOrCreate([
                'id' => $category['id'],
                ],
                [
                'name' => $category['name'],
                'description' => $category['description'],
                'service_group_id' => $category['service_groups_id'],
                'types_appeal_id' => $category['types_appeal_id'],
                'remote_url' => $category['remote_url']
            ]);

            StorageFile::query()->updateOrCreate([
                'storable_id' => $category['id'],
                ], [
                'storable_type' => CategoryAppeal::class,
                'path' => 'appealType/' . $category['id'] . '.png',
                'file_type' => 'thumbnail',
            ]);
        }
    }

}
