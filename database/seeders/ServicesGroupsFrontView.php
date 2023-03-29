<?php


namespace Database\Seeders;


use App\Models\FrontViewServiceGroup;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class ServicesGroupsFrontView extends Seeder
{
    public function run(): void
    {
        $serviceGroupList = [
            ['id' => 'b42717bb-c29a-440e-a9ef-6738e9bc7683', 'no' => 1, 'name'=>'Бесплатное обучение', 'remote_url' => 'https://edu.qolday.kz/login/index.php'],
            ['id' => '589de0e4-be76-4f6f-b7e9-f31bf5934be1', 'no' => 2, 'name'=>'Открыть бизнес', 'remote_url' => '/startBusiness'],
            ['id' => '929fece6-849e-47eb-98a4-d0a796269670', 'no' => 3, 'name'=>'Подготовка бизнес плана', 'remote_url' => '/businessPlanPreparation'],
            ['id' => '9f679a8a-eccd-42d5-b8cf-63ed9c09e812', 'no' => 4, 'name'=>'Разрешительные документы', 'remote_url' => '/permittingDocuments'],
            ['id' => '04de848c-2f8b-4877-96d7-118769d621b9', 'no' => 5, 'name'=>'Подбор финансирования', 'remote_url' => '/financingPrograms']
        ];

        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = FrontViewServiceGroup::query()->create(['id' => $serviceGroup['id'], 'name' => $serviceGroup['name'], 'order_no' => $serviceGroup['no'], 'remote_url' => $serviceGroup['remote_url']]);
            StorageFile::query()->create([
                'storable_id' => $newServiceGroup->id,
                'storable_type' => FrontViewServiceGroup::class,
                'path' => 'serviceGroup/service' . $serviceGroup['no'] . '.svg',
                'file_type' => 'picture',
            ]);
        }
    }
}
