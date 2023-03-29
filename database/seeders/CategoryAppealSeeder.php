<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryAppeal;

class CategoryAppealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryList = [
            ['id' => 'ba00cce0-5993-4b95-98c8-208cdef2aaab', 'name' => 'Финансирование' ],
            ['id' => '908bc2d2-5719-408a-9237-d275291553ca', 'name' => 'Земельные отношения'],
            ['id' => 'eb415b78-c087-43aa-8034-d4b16482b403', 'name' => 'Инженерные сети'],
            ['id' => '604f1206-68df-437a-a397-c3244381c991', 'name' => 'Лицензии и другие разрешения'],
            ['id' => 'b05d1f0d-8244-4f03-8f83-bf788be35987', 'name' => 'Строительство'],
            ['id' => 'b2a7e319-517b-429d-a9ce-170c91ae3ddf', 'name' => 'Бесплатное обучение']

        ];
        foreach ($categoryList as $category) {
            CategoryAppeal::query()->create([
                'id' => $category['id'],
                'name' => $category['name']
            ]);
        }
    }
}
