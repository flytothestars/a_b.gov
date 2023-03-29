<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FreeEducation;
use App\Models\FreeEducationLessons;

class FreeEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educationsList = [
            [

                "category_appeals_id" => "ad6a41f6-bb25-4241-883d-772c6e0e9c42",
                "header" => "Qolday Start – онлайн обучение",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
                <p class="font-bold">Курс для начинающих предпринимателей "Qoldaý Start".</p>
                <ul >
                    <li>Вы получите знания по запуску бизнеса;</li>
                    <li>начнете мыслить как предприниматель; </li>
                    <li> научитесь использовать реальные практические инструменты в маркетинге, финансовом планировании, налоговом учете, системе первичного документооборота в бизнесе;</li>
                    <li>сформируете иные практические навыки для самостоятельной предпринимательской деятельности в современных рыночных условиях.</li>
                </ul>
                ',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=91",
                "lessons" => [
                    [
                        "name" => "Основы предпринимательства",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=91#section-1",
                    ],
                    [
                        "name" => "Финансовая грамотность",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=91#section-2",
                    ],
                    [
                        "name" => "Управление личными финансами",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=91#section-3",
                    ],
                    [
                        "name" => "Маркетинг",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=91#section-4",
                    ],
                    [
                        "name" => "Бизнес планирование",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=91#section-5",
                    ],
                    [
                        "name" => "Все о мерах госдарственной поддержки бизнеса",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=91#section-6",
                    ]
                ]
            ],
            [

                "category_appeals_id" => "195792ce-7dfd-44e5-81ee-c2e6d37a19c6",
                "header" => "Soft Skills: публичное выступление",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
               
                <p></p>- Soft Skills и Hard Skills?<br>- Как выступать публично?<br>- Как развивать себя?
                <p></p>',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=92",

            ],
            [

                "category_appeals_id" => "9ee7a799-45b7-4df6-831d-78ae4d406458",
                "header" => "Кайдзен",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
                <p></p>-&nbsp; Что такое Кайзден?<br>-&nbsp; Как внедирить Кайзден?<br>-&nbsp; Как систематизировать Кайзден?<p></p>
           ',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=93",

            ],
            [

                "category_appeals_id" => "2dd2639f-eea6-44ed-ae44-4bfb96831b77",
                "header" => "Внутренний туризм",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
                <p>Kурс для начинающих предпринимателей и лиц с бизнес-инициативой</p>
           ',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=94",
                "lessons" => [
                    [
                        "name" => "Кейс от экспертов и профессионалов бизнеса",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-1",
                    ],
                    [
                        "name" => "Анализ рынка",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-2",
                    ],
                    [
                        "name" => "Налоги",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-3",
                    ],
                    [
                        "name" => "Командообразование",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-4",
                    ],
                    [
                        "name" => "Маркетинг",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-5",
                    ],
                    [
                        "name" => "Продажи",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-6",
                    ],
                    [
                        "name" => "Автоматизация",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-7",
                    ],
                    [
                        "name" => "Документооборот",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-8",
                    ],
                    [
                        "name" => "Финансовый план",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-9",
                    ],
                    [
                        "name" => "Сертификат",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=94#section-10",
                    ],

                ]

            ],
            [

                "category_appeals_id" => "48b48c64-5523-44d3-8e51-cb1c537ec755",
                "header" => "Кондитерское дело",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
                    <p>Kурс для начинающих предпринимателей и лиц с бизнес-инициативой</p>
               ',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=95",
                "lessons" => [
                    [
                        "name" => "Кейс от экспертов и профессионалов бизнеса",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-1",
                    ],
                    [
                        "name" => "Анализ рынка",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-2",
                    ],
                    [
                        "name" => "Налоги",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-3",
                    ],
                    [
                        "name" => "Командообразование",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-4",
                    ],
                    [
                        "name" => "Маркетинг",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-5",
                    ],
                    [
                        "name" => "Продажи",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-6",
                    ],
                    [
                        "name" => "Автоматизация",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-7",
                    ],
                    [
                        "name" => "Документооборот",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-8",
                    ],
                    [
                        "name" => "Финансовый план",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-9",
                    ],
                    [
                        "name" => "Сертификат",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=95#section-10",
                    ],

                ]

            ],
            [

                "category_appeals_id" => "0a9d10a7-a95e-42e6-8837-3173991e2354",
                "header" => "Магазины у дома",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
                        <p>Kурс для начинающих предпринимателей и лиц с бизнес-инициативой</p>
                   ',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=63",
                "lessons" => [
                    [
                        "name" => "Кейс от экспертов и профессионалов бизнеса",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-1",
                    ],
                    [
                        "name" => "Анализ рынка",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-2",
                    ],
                    [
                        "name" => "Налоги",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-3",
                    ],
                    [
                        "name" => "Командообразование",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-4",
                    ],
                    [
                        "name" => "Маркетинг",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-5",
                    ],
                    [
                        "name" => "Продажи",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-6",
                    ],
                    [
                        "name" => "Автоматизация",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-7",
                    ],
                    [
                        "name" => "Документооборот",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-8",
                    ],
                    [
                        "name" => "Финансовый план",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-9",
                    ],
                    [
                        "name" => "Сертификат",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=63#section-10",
                    ],

                ]

            ],
            [

                "category_appeals_id" => "aead41dc-db4f-4502-9148-70a9760c17b4",
                "header" => "Фитнес центр",
                "lead" => "Kурс для начинающих предпринимателей и лиц с бизнес-инициативой",
                "description" => '
                            <p>Kурс для начинающих предпринимателей и лиц с бизнес-инициативой</p>
                       ',
                "remote_url" => "https://edu.qolday.kz/course/view.php?id=96",
                "lessons" => [
                    [
                        "name" => "Кейс от экспертов и профессионалов бизнеса",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-1",
                    ],
                    [
                        "name" => "Анализ рынка",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-2",
                    ],
                    [
                        "name" => "Налоги",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-3",
                    ],
                    [
                        "name" => "Командообразование",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-4",
                    ],
                    [
                        "name" => "Маркетинг",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-5",
                    ],
                    [
                        "name" => "Продажи",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-6",
                    ],
                    [
                        "name" => "Автоматизация",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-7",
                    ],
                    [
                        "name" => "Документооборот",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-8",
                    ],
                    [
                        "name" => "Финансовый план",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-9",
                    ],
                    [
                        "name" => "Сертификат",
                        "remote_url" => "https://edu.qolday.kz/course/view.php?id=96#section-10",
                    ],

                ]

            ]
        ];
        foreach ($educationsList as $education) {
            $educationId = FreeEducation::query()->create([
                'category_appeals_id' => $education['category_appeals_id'],
                'header' => $education['header'],
                'lead' => $education['lead'],
                'description' => $education['description'],
                'remote_url' => $education['remote_url'],
            ]);
            if (isset($education['lessons'])) {
                foreach ($education['lessons'] as $lesson) {
                    FreeEducationLessons::query()->create([
                        'education_id' => $educationId->id,
                        'name' => $lesson['name'],
                        'remote_url' => $lesson['remote_url']
                    ]);
                }
            }
        }
        //
    }
}
