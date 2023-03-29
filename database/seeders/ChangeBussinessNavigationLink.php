<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FrontViewServiceGroup;

class ChangeBussinessNavigationLink extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontViewServiceGroup::query()->where('id', '0b5cffd3-aca8-4294-964a-94b61b5d7310')
            ->update(
                [
                    'remote_url' => 'https://navigator.almatybusiness.gov.kz/ru/businesses/place-select/'
                ]
            );
        //
    }
}
