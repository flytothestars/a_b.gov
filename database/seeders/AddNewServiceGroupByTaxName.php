<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceGroup;

class AddNewServiceGroupByTaxName extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceGroup::query()->updateOrCreate(
            ['id' => 'e1492213-579f-4eff-86c2-1e50c2e2c9ab'],
            ['name' => 'Налоговые',
                'description' => 'Узнайте, как налоговая оценивает вашу компанию по степени риска',
                'order_no'=>8]);
    }
}
