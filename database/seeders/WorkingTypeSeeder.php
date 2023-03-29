<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorkingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createWorkingType('de518de7-b354-4ad8-9fa5-0442b5321ecd', 'Торговля', '505d7a2b-16c0-43a2-b2ef-5a946c365759');
        $this->createWorkingType('c5ec6197-9363-4ce1-ae8d-e26e4e5023b5', 'Услуги', 'd08e57f2-8d73-4378-87cc-848a835f80bf');
        $this->createWorkingType('15285dee-3cb7-482c-a3cb-e00876ada00d', 'Рестораны, кафе, столовые, бары', 'db1edf67-405b-40a8-a10a-fda925d6f804');
        $this->createWorkingType('e79ef838-90cd-4492-b6e7-cfe2d0c7ade7', 'Здравоохранение', 'c912c155-f125-4c56-8cf8-2c59cf11bc40');
        $this->createWorkingType('f96bd918-c331-40ae-98e7-f4415e40cb9f', 'Образование', '6fa8f9d6-73ed-4d04-b325-6b1e531ab5d6');
        $this->createWorkingType('3ce8678b-89dd-4b7b-9a57-06f755540ec2', 'Гостиницы', '66773478-3e95-4e92-aa2a-b7aedca03177');
        $this->createWorkingType('3af785fa-0aae-4776-8e7b-ffcf2f142142', 'Недвижимость', 'c937996f-b1a1-4e0f-aec4-2766ab62570e');
        $this->createWorkingType('b50c699f-33fd-47fb-b7ca-68d4cf67b6bd', 'Производство', '4c648766-61cb-41b6-a6f0-037be5de8d4e');
        $this->createWorkingType('6e4e09c5-0468-4b48-a9ea-dd96faef98fb', 'Развлечение и отдых', 'd6838087-39e7-42fb-9352-13beaf6aca0f');
        $this->createWorkingType('c9060ff9-2e27-42af-982e-1b70600d4290', 'Телекоммуникации и ИТ', '7ce3479f-6ef6-4c41-890a-3bf67f63bcbd');
        $this->createWorkingType('c6f8a639-b6c6-448e-a777-87d6f0e87b38', 'Финансы', '7e636686-805a-4bb8-b1d4-dc46ebe15ad7');
        $this->createWorkingType('44d22717-78e7-4138-b10d-ee27ff255c90', 'Транспорт и складирование', '494cc532-e4c7-4414-b638-8725b16fa6f9');
        $this->createWorkingType('6fadee48-8818-4599-9857-be602e837dfc', 'Строительство', '77990732-c31e-47b1-8b10-c01e52f202a5');
        $this->createWorkingType('147c1aae-6374-4a20-aaad-27e73a2761ed', 'Спорт', '15783a01-8f44-4d5e-a9de-8f8ff6a0ccc5');
        $this->createWorkingType('d00cbf0e-8604-4f08-8de0-7d6a791f7cfe', 'Другое', null);
    }

    private function createWorkingType($id, $name, $mioId)
    {
        \App\Models\WorkingType::query()->updateOrCreate([
            'id' => $id
        ], [
            'name' => $name,
            'mio_id' => $mioId
        ]);
    }
}
