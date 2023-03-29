<?php

namespace Database\Seeders;

use App\Models\ActivityNodeType;
use App\Repositories\Enums\ActivityNodeTypeEnum;
use Illuminate\Database\Seeder;

class ActivityNodeTypeSeeder extends Seeder
{

    public function run()
    {
        $statusList = [
            ['id' => ActivityNodeTypeEnum::ActivityType, 'name' => 'Портал'],
            ['id' => ActivityNodeTypeEnum::ActivitySection, 'name' => 'МИО'],
            ['id' => ActivityNodeTypeEnum::ActivityGroup, 'name' => 'МИО'],
            ['id' => ActivityNodeTypeEnum::ActivityClass, 'name' => 'МИО'],
            ['id' => ActivityNodeTypeEnum::ActivitySubClass, 'name' => 'МИО'],
        ];

        foreach ($statusList as $status) {
            ActivityNodeType::query()->create([
                'id' => $status['id'],
                'name' => $status['name']
            ]);
        }
    }
}
