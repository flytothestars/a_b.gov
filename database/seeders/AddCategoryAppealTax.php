<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use App\Repositories\Enums\ServiceCategoryEnum;
use App\Repositories\Enums\ServiceGroupEnum;
use App\Repositories\Enums\TypesAppealEnum;

class AddCategoryAppealTax extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryAppeal::query()->updateOrCreate([
            'id' => '8a2ea6c0-5420-4867-a726-a585e2949357',
        ],
            [
                'name' => 'Налоговый светофор',
                'description' => 'Узнайте, как налоговая оценивает вашу компанию по степени риска',
                'service_category_id' => ServiceCategoryEnum::Taxing,
                'service_group_id' => ServiceGroupEnum::Taxing,
                'types_appeal_id' => TypesAppealEnum::ForBeginner,
                'remote_url' => '/online-business-risk-check'
            ]);
        StorageFile::query()->updateOrCreate([
            'storable_id' => '8a2ea6c0-5420-4867-a726-a585e2949357',
        ], [
            'storable_type' => CategoryAppeal::class,
            'path' => 'appealType/8a2ea6c0-5420-4867-a726-a585e2949357' . '.png',
            'file_type' => 'thumbnail',
        ]);

    }
}
