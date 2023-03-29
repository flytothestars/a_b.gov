<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    public function run() : void
    {
        NewsCategory::query()->create(['id'=>'0e82b0ef-2dd7-4755-a172-66623930719e','name'=>'Новости бизнеса', 'code'=>'novosti-biznesa']);
        NewsCategory::query()->create(['id'=>'195de499-9130-426d-9160-1d1614172dda','name'=>'Полезные статьи', 'code'=>'poleznye-stati']);
    }
}
