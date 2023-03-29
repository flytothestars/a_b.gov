<?php

namespace Database\Seeders;

use App\Models\CategoryAppeal;
use App\Models\Partner;
use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\TypesAppeal;
use Illuminate\Database\Seeder;

class FixTextOfAppealsType extends Seeder
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
                'description' => 'Ставка вознаграждения: 2% — для многодетных малообеспеченных семей, инвалидов I и II группы, семей воспитывающих детей-инвалидов и резидентов промышленных парков; 6% — для всех других категорий заемщиков',
            ],
            [
                'id' => '321ee49a-4a05-44b8-b3a3-706dd5ba0b64',
                'name' => 'Беззалоговое кредитование',
                'description' => 'Сумма кредитования: от 100 000 до 6 000 000 тенге; Сроки кредитования: от 3х до 24х месяцев; Ставка вознаграждения: 12% годовых;',
            ],
            [
                'id' => 'b0120dc3-5c53-4f42-9fb1-827be1cfd5ca',
                'name' => 'Частичное гарантирование Дорожная карта бизнеса - 2025',
                'description' => 'Максимальный размер гарантии: до 85 % от суммы займа',
            ],
            [
                'id' => 'ef23ef2e-1ba8-4b28-9b14-fb81fb91b26e',
                'name' => 'Льготное кредитование до 58 млн. тенге',
                'description' => 'Ставка вознаграждения: 2% — для многодетных малообеспеченных семей, инвалидов I и II группы, семей воспитывающих детей-инвалидов и резидентов промышленных парков; 6% — для всех других категорий заемщиков',
            ],
            [
                'id' => 'f1aa7791-deb3-41e2-a10a-a61412a8afdb',
                'name' => 'Государственные гранты Дорожная карта бизнеса 2025',
                'description' => 'Сумма государственного гранта от 2 до 5 млн тенге Срок реализации бизнес-проекта не более 18 месяцев',
            ],
        ];
        foreach ($data as $category) {
            CategoryAppeal::query()->where('id',$category['id'])->update([
                'name' => $category['name'],
                'description' => $category['description']
            ]);
        }
    }
}
