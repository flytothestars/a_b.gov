<?php

namespace Database\Seeders;
use App\Models\FrontViewServiceGroup;

use Illuminate\Database\Seeder;

class ChangeFinancingProgramLink extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontViewServiceGroup::query()->where('id', '04de848c-2f8b-4877-96d7-118769d621b9')
                        ->update(
                            [
                                'remote_url' => '/survey' 
                            ]
                        );
        //
    }
}
