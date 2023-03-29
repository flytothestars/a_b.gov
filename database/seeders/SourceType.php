<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SourceType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSourceType('512548a4-c7bc-4cf7-ac69-ff7e8ed7ee68', 'Портал');
        $this->createSourceType('75f1caf5-63c0-4f6e-9b27-0cbed0e69927', 'Обход');
        $this->createSourceType('ec4ac54a-7f52-41d8-89b4-4daaf0a4ddcf', 'Колл Центр');
        $this->createSourceType('a171a48e-29cf-43b9-8512-a40794d0ca01', 'МСБ');
    }

    private function createSourceType($id, $name)
    {
        \App\Models\SourceType::query()->updateOrCreate([
            'id' => $id
        ], [
            'name' => $name
        ]);
    }
}
