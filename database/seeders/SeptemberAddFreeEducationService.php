<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class SeptemberAddFreeEducationService extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => '0a9d10a7-a95e-42e6-8837-3173991e2354',
                'name' => 'Qolday System: Магазины у дома',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=63',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
            ],
            [
                'id' => '2dd2639f-eea6-44ed-ae44-4bfb96831b77',
                'name' => 'Qolday System: Внутренний туризм',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=94',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
            ],
            [
                'id' => '48b48c64-5523-44d3-8e51-cb1c537ec755',
                'name' => 'Qolday System: Кондитерское дело',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=95',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
            ],
            [
                'id' => 'aead41dc-db4f-4502-9148-70a9760c17b4',
                'name' => 'Qolday System: Фитнес центр',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=96',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
            ],
            [
                'id' => '195792ce-7dfd-44e5-81ee-c2e6d37a19c6',
                'name' => 'Qolday Profi: Soft Skills: публичное выступлени',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=92',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
            ],
            [
                'id' => '9ee7a799-45b7-4df6-831d-78ae4d406458',
                'name' => 'Qolday Profi: Кайдзен',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=93',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
            ],
            [
                'id' => '20b16819-8a86-4cee-ba8c-dcecae919787',
                'name' => 'Бизнес Акселератор Almaty Business',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => 'https://edu.almatybusiness.gov.kz/',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
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
