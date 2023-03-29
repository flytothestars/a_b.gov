<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class septemberAddFreeEducationStartservice extends Seeder
{
    public function run(): void
    {
        $data = [[
            'id' => 'ad6a41f6-bb25-4241-883d-772c6e0e9c42',
            'name' => 'Qolday Start',
            'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
            'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
            'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
            'remote_url' => 'https://edu.qolday.kz/course/view.php?id=91',
            'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'
        ]];

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
