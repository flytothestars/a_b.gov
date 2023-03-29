<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryAppeal;

class UpdateCategoryAppealsFinancing extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '2b2701aa-02cc-4659-867b-596538dfc692',
                'name' => 'Льготное кредитование от 58 млн. до 500 млн. тенге',
                'remote_url' => '/financingPrograms/detail/fromMillion'
            ],
            [
                'id' => '321ee49a-4a05-44b8-b3a3-706dd5ba0b64',
                'name' => 'Беззалоговое кредитование',
                'remote_url' => '/financingPrograms/detail/noCollateral'
            ],
            [
                'id' => 'b0120dc3-5c53-4f42-9fb1-827be1cfd5ca',
                'name' => 'Частичное гарантирование Дорожная карта бизнеса - 2025',
                'remote_url' => '/financingPrograms/detail/notEnoughCollateral'
            ],
            [
                'id' => 'ef23ef2e-1ba8-4b28-9b14-fb81fb91b26e',
                'name' => 'Льготное кредитование до 58 млн. тенге',
                'remote_url' => '/financingPrograms/detail/upToMillion'
            ],
            [
                'id' => 'da4ae49c-43f2-4726-8cfc-58d18685f051',
                'name' => 'Государственные гранты Дорожная карта бизнеса 2025',
                'remote_url' => '/financingPrograms/detail/stateGrant'
            ],
        ];
        //

        foreach ($data as $category) {
            CategoryAppeal::query()->where('id', $category['id'])
                ->update(
                    [
                        'remote_url' => $category['remote_url']
                    ]
                );
        }
    }
}
