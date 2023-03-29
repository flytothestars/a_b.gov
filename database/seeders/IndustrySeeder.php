<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class IndustrySeeder extends Seeder
{

    public function run() : void
    {
        $industries = [
            ['id' => '42527fbb-a160-4e32-aa3e-60c3f868e5b7', 'name' => 'Торговля'],
            ['id' => 'cbfc9a8b-8312-4b90-ba34-0e02b643f74c', 'name' => 'Услуги'],
            ['id' => '3a0be421-442f-4b37-b723-296f49f26b20', 'name' => 'Промышленность'],
            ['id' => '5c1ac60e-e7b8-4709-887b-ae3a9d4bf79d', 'name' => 'Агропромышленный комплекс'],
        ];

        foreach ($industries as $industry) {
            Industry::query()->updateOrCreate(['id' => $industry['id']], $industry);
        }
    }
}
