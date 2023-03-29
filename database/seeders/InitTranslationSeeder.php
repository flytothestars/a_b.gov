<?php


namespace Database\Seeders;


use App\Models\FrontViewServiceGroup;
use App\Models\Translation;
use App\Repositories\Enums\LanguageEnum;
use Illuminate\Database\Seeder;

class InitTranslationSeeder extends Seeder
{
    public function run() : void
    {
        $translations = [
            ['translatable_id' => 'b42717bb-c29a-440e-a9ef-6738e9bc7683', 'translatable_type' => FrontViewServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=>'Тегін оқыту']],
            ['translatable_id' => '589de0e4-be76-4f6f-b7e9-f31bf5934be1', 'translatable_type' => FrontViewServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=>"Бизнес ашу"]],
            ['translatable_id' => '929fece6-849e-47eb-98a4-d0a796269670', 'translatable_type' => FrontViewServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=> "Бизнес- жоспарды дайындау"]],
            ['translatable_id' => '9f679a8a-eccd-42d5-b8cf-63ed9c09e812', 'translatable_type' => FrontViewServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=>"Рұқсат қағаздары"]],
            ['translatable_id' => '04de848c-2f8b-4877-96d7-118769d621b9', 'translatable_type' => FrontViewServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ "name"=>"Қаржыландыруды таңдау"]],

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
