<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use App\Models\FrontViewServiceGroup;
use App\Models\ServiceGroup;
use App\Models\Translation;
use App\Repositories\Enums\LanguageEnum;
use Illuminate\Database\Seeder;

class SeptemberTranslationSeeder extends Seeder
{
    public function run() : void
    {
        $translations = [
            ['translatable_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab', 'translatable_type' => ServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ 'description'=>'Кез келген кәсіпке рұқсат құжаттарының толық пакеті қажет. Кәсіпкерлердің көбіне жер қатынастары, сәулет, жылжымайтын мүлік, инфрақұрылым желілерін қосу, лицензия алуда көптеген түйткілдерге тап болатынын тәжірибе көрсетіп отыр. Егер сіз ондай түйткілге тап болсаңыз,  біздің менеджерге хабарласыңыз, қажетті құжатты уақытында аласыз. Ол үшін порталда өтінім қалдыру жеткілікті.']],
            ['translatable_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'translatable_type' => ServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ 'description'=>'Егер сізде кәсіпті бастау үшін бастапқы капитал болмаса, сіз грант ұтып немесе мемлекеттік және аймақтық бағдарламалар аясында жеңілдікпен несие ала аласыз. Біз сізге екінші деңгейдегі банктерде, «Даму» кәсіпкерлікті дамыту қоры »АҚ,« Алматы Финанс »ЖШС, « Алматы» ШНҰ» ЖШС, «Ауыл шаруашылығын қаржылай қолдау қоры» АҚ және басқа ұйымдарда сіздің жобаңызды қолдап,  ары қарай тегін кеңес береміз. Қызметті алу үшін порталда өтінім қалдырыңыз.']],
            ['translatable_id' => '0b5cffd3-aca8-4294-964a-94b61b5d7310', 'translatable_type' => FrontViewServiceGroup::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=>'Бизнес-навигатор']],
            ['translatable_id' => '321ee49a-4a05-44b8-b3a3-706dd5ba0b64', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name' => 'Кепілсіз несиелендіру', 'description'=>'"Несие сомасы:  100 000-нан 6 000 000 теңгеге дейін; Несиелендіру мерзімі:  3-айдан 24-айға дейін; Пайыздық мөлшерлемесі: жылына 12%;"']],
            ['translatable_id' => 'da4ae49c-43f2-4726-8cfc-58d18685f051', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name' => 'Мемлекеттік грант «Бизнестің жол картасы-2025»', 'description'=>'"Мемлекеттік гранттың сомасы 2 млн-нан 5 млн теңгеге дейін. Бизнес-жобаны іске асыру кезеңі 18 айдан аспайды"']],
            ['translatable_id' => 'ef23ef2e-1ba8-4b28-9b14-fb81fb91b26e', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> '58 млн теңгеге дейін жеңілдетілген несие беру', 'description'=>'Сыйақы мөлшерлемесі аз қамтылған көп балалы отбасыларға, I және II топтағы мүгедектерге, мүгедек балаларды тәрбиелеп отырған отбасыларға және өндірістік саябақтар резиденттеріне -2%; қарыз алушылардың барлық басқа санаттары үшін - 6%']],
            ['translatable_id' => '2b2701aa-02cc-4659-867b-596538dfc692', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> '58 млн-нан 500 млн. теңгеге дейін жеңілдетілген несиелендіру', 'description'=>'Сыйақы мөлшерлемесі аз қамтылған көп балалы отбасыларға, I және II топтағы мүгедектерге, мүгедек балаларды тәрбиелеп отырған отбасыларға, өндірістік саябақтар резиденттеріне - 2%, қарыз алушылардың барлық басқа санаттары үшін - 6%']],
            ['translatable_id' => '49d8df55-0be0-43ca-8dd7-748b32d20f9b', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Лицензиялар және басқа рұқсаттар', 'description'=>'Бұл бөлімде жеке және заңды тұлғаларға арналған лицензиялау мен рұқсат беру саласындағы ақпараттық материал берілген. Бөлім сұрақтар мен лицензия алу тәртібін, денсаулық сақтау, құрылыс, білім беру, туризм, көлік және т.б. салаларындағы рұқсат етуші және хабарламалық сипаттағы сұрақтарды қамтиды.']],
            ['translatable_id' => '7e378587-88fe-4935-99a5-61e82b676037', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Инженерлік желі', 'description'=>'Бұл бөлімде жеке және заңды тұлғалар үшін инженерлік инфрақұрылым саласындағы ақпараттық материал берілген. Бөлімде сұрақтар мен техникалық шарттарды алу және коммуналдық қызметтерге қосылу туралы келісім жасау тәртібі (сумен жабдықтау және канализация, газдандыру, жылумен жабдықтау және электрмен жабдықтау) бар.']],
            ['translatable_id' => '7eec6abc-8c21-4d6f-815e-de46324e5392', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Құрылыс', 'description'=>'Бұл бөлімде жеке және заңды тұлғаларға арналған сәулет және қала құрылысы (объектілерді салу және қайта жаңарту) саласындағы ақпараттық материал берілген. Бөлім бастапқы материалдарды алу тәртібін (топографиялық түсіру, нақты жобалау жоспары (НЖЖ), сәулет-жоспарлау тапсырмасы (СЖТ), қала құрылысы регламенті (қызыл сызықтар және т.б.), жобаның жобасын бекіту, жобаның басталуы туралы хабарламаны қамтиды. Сонымен қатар сызба жобасын растау, құрылыс -монтаж жұмыстарының (ҚМЖ) басталуы туралы хабарлау, пайдалануға беру актісі және техникалық паспортты тіркеу.']],
            ['translatable_id' => '93dedf07-4ae4-465c-9150-54d93c0370e1', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Жер қатынастары', 'description'=>'Бұл бөлімде жеке және заңды тұлғаларға арналған жер қатынастары саласында ақпараттық материал берілген. Бөлім мемлекеттік актіні алу, мақсатын өзгерту, аудандастыру, бөлінгіштігін және кадастрлық құнын анықтау, жер учаскесіне меншік құқығын алу, өзгерту және тоқтату бойынша сұрақтар мен рәсімдерді қамтиды.']],
            ['translatable_id' => 'addaab33-6715-4174-aafb-45ed2817463a', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Бизнес ашу', 'description'=>'Идея бар, бірақ неден бастау керек? Өтініш қалдырыңыз, біздің менеджер сізге хабарласады. Қаражат табу мен бизнесті тіркеуден бастап, жобаны іске асырудағы барлық кезеңдерінде тегін кеңес беріледі.']],
            ['translatable_id' => 'b0120dc3-5c53-4f42-9fb1-827be1cfd5ca', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Мүлікті жартылай кепілдендіру Бизнестің жол картасы-2025', 'description'=>'Кепілдіктің ең жоғарғы сомасы несие сомасының 85% дейін ']],
            ['translatable_id' => 'efeb3040-a3b9-42db-9c22-7861f32f1087', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Бизнес жоспарды әзірлеу', 'description'=>'Біз сізге екінші деңгейдегі банктер мен қаржы институттарында одан әрі қолдау көрсете отырып, бизнес-жоспарды жасауға тегін көмектесеміз. Толық ақпарат алу үшін өтінім қалдырыңыз, біздің менеджер сізбен байланысады.']],
            ['translatable_id' => 'f1aa7791-deb3-41e2-a10a-a61412a8afdb', 'translatable_type' => CategoryAppeal::class, 'language'=>LanguageEnum::KK, 'content' => [ 'name'=> 'Мемлекеттік грант «Бизнестің жол картасы-2025»', 'description'=>'"Мемлекеттік гранттың сомасы 2 млн-нан 5 млн теңгеге дейін. Бизнес-жобаны іске асыру кезеңі 18 айдан аспайды"']],
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
