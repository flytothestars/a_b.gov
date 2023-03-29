<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FreeEducation;
use App\Models\FreeEducationLessons;

class AddFreeEducationAccelerator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = [

            "category_appeals_id" => "20b16819-8a86-4cee-ba8c-dcecae919787",
            "header" => "Бизнес Акселератор Almaty Business ",
            "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
            "description" => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
            "remote_url" => "https://edu.qolday.kz/course/index.php?categoryid=12",
            "lessons" => [
                [
                    "name" => "Финансовые рассчеты",
                    "remote_url" => "https://edu.qolday.kz/course/view.php?id=117",
                ],
                [
                    "name" => "Настройка таргетированной рекламы ",
                    "remote_url" => "https://edu.qolday.kz/course/view.php?id=116",
                ],
                [
                    "name" => "Разработка бизнес-модели",
                    "remote_url" => "https://edu.qolday.kz/course/view.php?id=106",
                ],
                [
                    "name" => "Выбор типа организации и режима налогообложения в Казахстане",
                    "remote_url" => "https://edu.qolday.kz/course/view.php?id=107",
                ],
                [
                    "name" => "Бизнес-план",
                    "remote_url" => "https://edu.qolday.kz/course/view.php?id=109",
                ],
                [
                    "name" => "Бизнес калькуляторы",
                    "remote_url" => "https://edu.qolday.kz/course/view.php?id=111",
                ]
            ]
        ];
        $educationId = FreeEducation::query()->create([
            'category_appeals_id' => $record['category_appeals_id'],
            'header' => $record['header'],
            'lead' => $record['lead'],
            'description' => $record['description'],
            'remote_url' => $record['remote_url'],
        ]);
        if (isset($record['lessons'])) {
            foreach ($record['lessons'] as $lesson) {
                FreeEducationLessons::query()->create([
                    'education_id' => $educationId->id,
                    'name' => $lesson['name'],
                    'remote_url' => $lesson['remote_url']
                ]);
            }
        }
        //
    }
}
