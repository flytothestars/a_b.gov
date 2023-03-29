<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class CategoryAppealsPermittingDocuments extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => 'efeb3040-a3b9-42db-9c22-7861f32f1087',
                'name' => 'Подготовка бизнес-плана',
                'description' => 'Мы поможем Вам бесплатно разработать бизнес-план с дальнейшим сопровождением в банках второго уровня и финансовых институтах. Для получения детальной информации оставьте заявку, и наш менеджер свяжется с Вами.',
                'service_groups_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/businessPlanPreparation'
            ],
            [
                'id' => 'addaab33-6715-4174-aafb-45ed2817463a',
                'name' => 'Открыть бизнес',
                'description' => 'Есть идея, но не знаете, с чего начать? Оставьте заявку, и наш менеджер свяжется с Вами. Вы получите бесплатную консультацию по всем этапам реализации проекта, включая поиск источников финансирования и регистрацию бизнеса.',
                'service_groups_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'remote_url' => '/startBusiness'
            ],
            [
                'id' => '93dedf07-4ae4-465c-9150-54d93c0370e1',
                'name' => 'Земельные отношения',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в области земельных отношении. Раздел включает в себя вопросы и порядок по получению государственного акта, изменению целевого назначения, зонирования, определения делимости и кадастровой стоимости, приобретения, изменения и прекращения права собственности на земельный участок.',
                'service_groups_id' => '23ed0560-60f2-4bcd-b3e0-13cfde9e272a',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/permittingDocuments#landRelation-tab'
            ],
            [
                'id' => '7e378587-88fe-4935-99a5-61e82b676037',
                'name' => 'Инженерные сети',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в области инженерной инфраструктуры. Раздел включает в себя вопросы и порядок получения технических условий и заключения договора на подключение к инженерным сетям (водоснабжение и водооотведение, газификация, теплоснабжение и электроснабжение).',
                'service_groups_id' => '6f4a2d26-6119-41fd-b6fa-ec6358b73675',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/permittingDocuments#networkEngineering-tab'
            ],
            [
                'id' => '49d8df55-0be0-43ca-8dd7-748b32d20f9b',
                'name' => 'Лицензий и другие разрешения',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в сфере лицензирования и разрешений. Раздел включает в себя вопросы и порядок получения лицензий, вопросы разрешительного и уведомительного характера в сферах здравоохранения, строительства, образования, туризма, транспорта итд.',
                'service_groups_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/permittingDocuments#licenses-tab'
            ],
            [
                'id' => '7eec6abc-8c21-4d6f-815e-de46324e5392',
                'name' => 'Строительство',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в области архитектуры и градостроительства (строительство и реконструкция объектов). Раздел включает в себя порядок получения исходных материалов (топографическая съемка, план детальной планировки (ПДП), архитектурно-планировочное задание (АПЗ), градостроительные регламенты (красные линии итп), согласования эскизного проекта, уведомление о начале строительно-монтажных работ (СМР), акта ввода в эксплуатацию и оформления технического паспорта.',
                'service_groups_id' => '91816472-2491-4ae5-996f-dcbda5d6b4dc',
                'types_appeal_id' => '726317d1-0e12-4c7d-aa31-9801cd5744a6',
                'remote_url' => '/permittingDocuments#building-tab'
            ],
        ];

        foreach ($data as $category) {
            CategoryAppeal::query()->updateOrCreate([
                'id' => $category['id'],
            ],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'service_group_id' => $category['service_groups_id'],
                    'types_appeal_id' => $category['types_appeal_id'],
                    'remote_url' => $category['remote_url']
                ]);

            StorageFile::query()->updateOrCreate([
                'storable_id' => $category['id'],
            ], [
                'storable_type' => CategoryAppeal::class,
                'path' => 'appealType/' . $category['id'] . '.png',
                'file_type' => 'thumbnail',
            ]);
        }
    }

}
