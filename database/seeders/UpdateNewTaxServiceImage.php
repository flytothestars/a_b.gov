<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StorageFile;

class UpdateNewTaxServiceImage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StorageFile::query()->where('storable_id', '8a2ea6c0-5420-4867-a726-a585e2949357')
            ->update(
                [
                    'path' => 'serviceGroup/taxing.png',
                ]
            );
    }
}
