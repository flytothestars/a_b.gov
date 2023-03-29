<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceGroup;
use App\Models\Translation;
use App\Repositories\Enums\LanguageEnum;

class NewServiceGroupTranslate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
            ['translatable_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'translatable_type' => ServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name' => 'Қаржыландыру', 'description' => 'Егер сізде кәсіпті бастау үшін бастапқы капитал болмаса, сіз грант ұтып немесе мемлекеттік және аймақтық бағдарламалар аясында жеңілдікпен несие ала аласыз. Біз сізге екінші деңгейдегі банктерде, «Даму» кәсіпкерлікті дамыту қоры »АҚ,« Алматы Финанс »ЖШС, « Алматы» ШНҰ» ЖШС, «Ауыл шаруашылығын қаржылай қолдау қоры» АҚ және басқа ұйымдарда сіздің жобаңызды қолдап,  ары қарай тегін кеңес береміз. Қызметті алу үшін порталда өтінім қалдырыңыз.']],
            ['translatable_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab', 'translatable_type' => ServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => ['name' => 'Лицензиялар және өзге рұқсат қағаздар' , 'description' => 'Кез келген кәсіпке рұқсат құжаттарының толық пакеті қажет. Кәсіпкерлердің көбіне жер қатынастары, сәулет, жылжымайтын мүлік, инфрақұрылым желілерін қосу, лицензия алуда көптеген түйткілдерге тап болатынын тәжірибе көрсетіп отыр. Егер сіз ондай түйткілге тап болсаңыз,  біздің менеджерге хабарласыңыз, қажетті құжатты уақытында аласыз. Ол үшін порталда өтінім қалдыру жеткілікті.']],
           
        ];

        foreach ($translations as $translation) {
            Translation::query()->create( [
                'translatable_id'=> $translation['translatable_id'],
                'translatable_type'=> $translation['translatable_type'],
                'language'=>$translation['language'],
                'content' => $translation['content']
            ]);
        }
        //
    }
}
