<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FrontViewServiceGroup;
use App\Repositories\Enums\ServiceCategoryEnum;

class FreeEducationsLink extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontViewServiceGroup::query()->where('id', 'b42717bb-c29a-440e-a9ef-6738e9bc7683')
            ->update(
                [
                    'remote_url' => '/services/list/-/' . ServiceCategoryEnum::FreeEducation
                ]
            );

        //
    }
}
