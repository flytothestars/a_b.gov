<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StorageFile;
use App\Models\CategoryAppeal;

class ChangeBankLoanImg extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryID = '7162978d-5c1a-48cc-a69f-762d94fa1b52';
        StorageFile::query()->updateOrCreate([
            'storable_id' => $categoryID,
        ], [
            'storable_type' => CategoryAppeal::class,
            'path' => 'appealType/' . $categoryID . '.png',
            'file_type' => 'thumbnail',
        ]);
        //
    }
}
