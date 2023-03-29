<?php


namespace Database\Seeders;


use App\Models\ServiceCategory;
use App\Models\Translation;
use App\Repositories\Enums\LanguageEnum;
use Illuminate\Database\Seeder;

class NewTranslationSeeder extends Seeder
{
    public function run() : void
    {
        $translations = [
            ['translatable_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'translatable_type' => ServiceCategory::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=>'Қаржылық қызметтер']],
            ['translatable_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab', 'translatable_type' => ServiceCategory::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=>"Тегін оқыту"]],
            ['translatable_id' => '91da119d-478f-497e-b966-1c8d7f0f9013', 'translatable_type' => ServiceCategory::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=> "Кеңес беру және сүйемелдеу"]],
            ['translatable_id' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3', 'translatable_type' => ServiceCategory::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=>"Рұқсат беру құжаттарын реттеуге көмек"]],
        ];

        foreach ($translations as $translation) {
            Translation::query()->create( [
                'translatable_id'=> $translation['translatable_id'],
                'translatable_type'=> $translation['translatable_type'],
                'language'=>$translation['language'],
                'content' => $translation['content']
            ]);
        }
    }
}
