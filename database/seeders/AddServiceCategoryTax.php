<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class AddServiceCategoryTax extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceCategory::query()->create([
            'id' => '33244a88-10cd-4487-b549-32d31ac4ec4f',
            'name' => 'Налоговые',
            'order_no' => 5
        ]);
    }
}
