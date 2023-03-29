<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use Illuminate\Database\Seeder;

class UpdateCategoryAppeals extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => '2b2701aa-02cc-4659-867b-596538dfc692',
                'name' => 'Льготное кредитование от 58 млн. до 500 млн. тенге',
                'service_category' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'remote_url' => '/survey?#fromMillion'
            ],
            [
                'id' => '321ee49a-4a05-44b8-b3a3-706dd5ba0b64',
                'name' => 'Беззалоговое кредитование',
                'service_category' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'remote_url' => '/survey?#noCollateral'
            ],
            [
                'id' => 'b0120dc3-5c53-4f42-9fb1-827be1cfd5ca',
                'name' => 'Частичное гарантирование Дорожная карта бизнеса - 2025',
                'service_category' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'remote_url' => '/survey?#notEnoughCollateral'
            ],
            [
                'id' => 'ef23ef2e-1ba8-4b28-9b14-fb81fb91b26e',
                'name' => 'Льготное кредитование до 58 млн. тенге',
                'service_category' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'remote_url' => '/survey?#upToMillion'
            ],
            [
                'id' => 'da4ae49c-43f2-4726-8cfc-58d18685f051',
                'name' => 'Государственные гранты Дорожная карта бизнеса 2025',
                'service_category' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'remote_url' => '/survey?#stateGrant'
            ],
            [
                'id' => '0a9d10a7-a95e-42e6-8837-3173991e2354',
                'name' => 'Qolday System: Магазины у дома',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=63'
            ],
            [
                'id' => '2dd2639f-eea6-44ed-ae44-4bfb96831b77',
                'name' => 'Qolday System: Внутренний туризм',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=94'
            ],
            [
                'id' => '48b48c64-5523-44d3-8e51-cb1c537ec755',
                'name' => 'Qolday System: Кондитерское дело',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=95'
            ],
            [
                'id' => 'aead41dc-db4f-4502-9148-70a9760c17b4',
                'name' => 'Qolday System: Фитнес центр',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=96'
            ],
            [
                'id' => '195792ce-7dfd-44e5-81ee-c2e6d37a19c6',
                'name' => 'Qolday Profi: Soft Skills: публичное выступлени',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=92'
            ],
            [
                'id' => '9ee7a799-45b7-4df6-831d-78ae4d406458',
                'name' => 'Qolday Profi: Кайдзен',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=93'
            ],
            [
                'id' => '20b16819-8a86-4cee-ba8c-dcecae919787',
                'name' => 'Бизнес Акселератор Almaty Business',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.almatybusiness.gov.kz/'
            ],
            [
                'id' => 'efeb3040-a3b9-42db-9c22-7861f32f1087',
                'name' => 'Подготовка бизнес-плана',
                'service_category' => '91da119d-478f-497e-b966-1c8d7f0f9013',
                'remote_url' => '/businessPlanPreparation'
            ],
            [
                'id' => 'addaab33-6715-4174-aafb-45ed2817463a',
                'name' => 'Открыть бизнес',
                'service_category' => '91da119d-478f-497e-b966-1c8d7f0f9013',
                'remote_url' => '/startBusiness'
            ],
            [
                'id' => '93dedf07-4ae4-465c-9150-54d93c0370e1',
                'name' => 'Земельные отношения',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#landRelation-tab'
            ],
            [
                'id' => '7e378587-88fe-4935-99a5-61e82b676037',
                'name' => 'Инженерные сети',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#networkEngineering-tab'
            ],
            [
                'id' => '49d8df55-0be0-43ca-8dd7-748b32d20f9b',
                'name' => 'Лицензий и другие разрешения',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#licenses-tab'
            ],
            [
                'id' => '7eec6abc-8c21-4d6f-815e-de46324e5392',
                'name' => 'Строительство',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#building-tab'
            ],
        ];


        foreach ($data as $category) {
            CategoryAppeal::query()->where('id', $category['id'])
                ->update(
                    [
                        'service_category_id' => $category['service_category'],
                        'remote_url' => $category['remote_url']
                    ]
                );
        }
    }
}
