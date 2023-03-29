<?php

namespace Database\Seeders;

use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class CategoryAppealsBanks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '7162978d-5c1a-48cc-a69f-762d94fa1b52',
                'name' => 'Онлайн открытие счета в банке',
                'description' => 'Подбор банка для открытия счета онлайн',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/banks/openAccount',
                'service_category_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'
            ],
            [
                'id' => '53edb36a-9ec7-4733-bf97-b0607dc4e36b',
                'name' => 'Онлайн кредиты для бизнеса',
                'description' => 'Подбор банка для получения онлайн кредита',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/banks/getLoan',
                'service_category_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'
            ],
        ];

        foreach ($data as $category) {
            CategoryAppeal::query()->updateOrCreate(
                [
                    'id' => $category['id'],
                ],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'service_group_id' => $category['service_groups_id'],
                    'types_appeal_id' => $category['types_appeal_id'],
                    'remote_url' => $category['remote_url'],
                    'service_category_id' => $category['service_category_id'],
                ]
            );

            StorageFile::query()->updateOrCreate([
                'storable_id' => $category['id'],
            ], [
                'storable_type' => CategoryAppeal::class,
                'path' => 'appealType/' . $category['id'] . '.png',
                'file_type' => 'thumbnail',
            ]);
        }
        //
    }
}
