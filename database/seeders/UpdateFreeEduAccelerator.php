<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FreeEducation;

class UpdateFreeEduAccelerator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "category_appeals_id" => "20b16819-8a86-4cee-ba8c-dcecae919787",
            "remote_url" => "https://edu.almatybusiness.gov.kz/",
        ];
        FreeEducation::query()->where('category_appeals_id', $data['category_appeals_id'])
            ->update(
                [
                    'remote_url' => $data['remote_url']
                ]
            );
        //
    }
}
