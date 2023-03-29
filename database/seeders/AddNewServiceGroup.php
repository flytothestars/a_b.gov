<?php

namespace Database\Seeders;

use App\Models\FrontViewServiceGroup;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class AddNewServiceGroup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newServiceGroup = FrontViewServiceGroup::query()->create(['id' => '0b5cffd3-aca8-4294-964a-94b61b5d7310', 'name' => 'Бизнес-навигатор', 'order_no' => 6, 'remote_url' => 'https://jawap.velait.kz/ru/businesses/place-select/']);
        StorageFile::query()->create([
            'storable_id' => $newServiceGroup->id,
            'storable_type' => FrontViewServiceGroup::class,
            'path' => 'serviceGroup/service6.svg',
            'file_type' => 'picture',
        ]);
        //
    }
}
