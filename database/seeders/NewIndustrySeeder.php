<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class NewIndustrySeeder extends Seeder
{

    public function run() : void
    {
        $industries = [
            ['id' => '42527fbb-a160-4e32-aa3e-60c3f868e5b7', 'name' => 'Торговля '],
            ['id' => 'cbfc9a8b-8312-4b90-ba34-0e02b643f74c', 'name' => 'Строительство '],
            ['id' => '3a0be421-442f-4b37-b723-296f49f26b20', 'name' => 'Промышленность'],
            ['id' => '5c1ac60e-e7b8-4709-887b-ae3a9d4bf79d', 'name' => 'Транспорт и складирование'],
            ['id' => 'ccef34aa-a9bc-4504-8118-e6c56f7a18a1', 'name' => 'Финансовые и страховые услуги '],
            ['id' => '6fc04632-f887-4379-a8be-92bfee055e16', 'name' => 'Операции с недвижимостью'],
            ['id' => '8bf58c9a-9d67-49c0-89ec-7fd384a8e297', 'name' => 'Профессиональная, научная и техническая деятельность'],
            ['id' => 'd6f63b9f-199d-4667-bd96-a7ce7773f8eb', 'name' => 'Образование'],
            ['id' => 'f77bd1e3-3a1f-4940-8f08-6f7fb5110645', 'name' => 'Здравоохранение и социальные услуги'],
            ['id' => '116e87c9-ec5d-4fc6-bb00-9b6e45b75bde', 'name' => 'Искусство, развлечения и отдых'],
            ['id' => '76179f64-3b11-43d8-a067-39954c06bcf2', 'name' => 'Информация и связь'],
            ['id' => 'a5ee8e46-9771-406d-8463-0e21f80a7205', 'name' => 'Услуги по проживанию и питанию'],
            ['id' => '04d2b2cb-6c0f-4c1b-a820-e47a6be99074', 'name' => 'Услуги по административному и вспомогательному обслуживанию'],
            ['id' => '250d97aa-b8a3-47dc-b11b-e036b1c660fd', 'name' => 'Сельское хозяйство'],
            ['id' => 'd155df5f-9e26-4cba-ab7c-45f809f2ea61', 'name' => 'Прочие услуги'],
        ];

        foreach ($industries as $industry) {
            Industry::query()->updateOrCreate(['id' => $industry['id']], $industry);
        }
    }
}
