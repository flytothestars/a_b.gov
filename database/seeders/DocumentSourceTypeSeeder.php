<?php

namespace Database\Seeders;

use App\Models\DocumentSourceType;
use App\Repositories\Enums\DocumentSourceTypeEnum;
use Illuminate\Database\Seeder;

class DocumentSourceTypeSeeder extends Seeder
{

    public function run()
    {
        $statusList = [
            ['id' => DocumentSourceTypeEnum::ClientDocument, 'name' => 'Документ клиент'],
            ['id' => DocumentSourceTypeEnum::ManagerDocument, 'name' => 'Документ менеджера'],
        ];

        foreach ($statusList as $status) {
            DocumentSourceType::query()->updateOrCreate(
                ['id' => $status['id']],
                [
                    'id' => $status['id'],
                    'name' => $status['name']
                ]);
        }
    }
}
