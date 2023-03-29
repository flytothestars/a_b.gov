<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryAppeal;

class UpdateCategoryAppealsFreeEducations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CategoryIDs = [
            '0a9d10a7-a95e-42e6-8837-3173991e2354',
            '195792ce-7dfd-44e5-81ee-c2e6d37a19c6',
            '20b16819-8a86-4cee-ba8c-dcecae919787',
            '2dd2639f-eea6-44ed-ae44-4bfb96831b77',
            '48b48c64-5523-44d3-8e51-cb1c537ec755',
            '9ee7a799-45b7-4df6-831d-78ae4d406458',
            'ad6a41f6-bb25-4241-883d-772c6e0e9c42',
            'aead41dc-db4f-4502-9148-70a9760c17b4',
        ];

        foreach ($CategoryIDs as $id) {
            CategoryAppeal::query()->where('id', $id)
                ->update(
                    [
                        'remote_url' => '/freeEducation/detail/' . $id
                    ]
                );
        }
        //
    }
}
