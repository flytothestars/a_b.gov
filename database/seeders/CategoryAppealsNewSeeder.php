<?php


namespace Database\Seeders;


use App\Models\CategoryAppeal;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class CategoryAppealsNewSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'id' => 'ad6a41f6-bb25-4241-883d-772c6e0e9c42',
                'name' => 'Qolday Start',
                'description' => 'Kурс для начинающих предпринимателей и лиц с бизнес-инициативой',
                'service_groups_id' => '7230d5b8-24a8-4577-b399-f4ce66ed8fcb',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'service_category' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'remote_url' => 'https://edu.qolday.kz/course/view.php?id=91'
            ],
            [
                'id' => '78b65436-51c2-454f-8673-a617df5dcfbe',
                'name' => 'Государственные гранты Дорожная карта бизнеса 2025',
                'description' => 'Сумма государственного гранта от 2 до 5 млн тенге Срок реализации бизнес-проекта не более 18 месяцев',
                'service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'service_category' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b',
                'remote_url' => '/survey?#stateGrant'
            ],

            [
                'id' => 'e62d6d8a-5632-4ebc-bf88-be2509e90181',
                'name' => 'Земельные отношения',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в области земельных отношении. Раздел включает в себя вопросы и порядок по получению государственного акта, изменению целевого назначения, зонирования, определения делимости и кадастровой стоимости, приобретения, изменения и прекращения права собственности на земельный участок.',
                'service_groups_id' => '23ed0560-60f2-4bcd-b3e0-13cfde9e272a',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#landRelation-tab'
            ],
            [
                'id' => '69df034b-ded6-4b6a-ab27-7e87296de90e',
                'name' => 'Инженерные сети',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в области инженерной инфраструктуры. Раздел включает в себя вопросы и порядок получения технических условий и заключения договора на подключение к инженерным сетям (водоснабжение и водооотведение, газификация, теплоснабжение и электроснабжение).',
                'service_groups_id' => '6f4a2d26-6119-41fd-b6fa-ec6358b73675',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#networkEngineering-tab'
            ],
            [
                'id' => 'fd8b434c-9895-471a-9638-ca2b279dd2d9',
                'name' => 'Лицензий и другие разрешения',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в сфере лицензирования и разрешений. Раздел включает в себя вопросы и порядок получения лицензий, вопросы разрешительного и уведомительного характера в сферах здравоохранения, строительства, образования, туризма, транспорта итд.',
                'service_groups_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#licenses-tab'
            ],
            [
                'id' => '14c6c87a-57c0-4a80-b7de-ef9bf8b1ee08',
                'name' => 'Строительство',
                'description' => 'В данном разделе предоставлен информационный материал для физических и юридических лиц в области архитектуры и градостроительства (строительство и реконструкция объектов). Раздел включает в себя порядок получения исходных материалов (топографическая съемка, план детальной планировки (ПДП), архитектурно-планировочное задание (АПЗ), градостроительные регламенты (красные линии итп), согласования эскизного проекта, уведомление о начале строительно-монтажных работ (СМР), акта ввода в эксплуатацию и оформления технического паспорта.',
                'service_groups_id' => '91816472-2491-4ae5-996f-dcbda5d6b4dc',
                'types_appeal_id' => '262525f7-452d-4fc9-a90f-b7938dd7add1',
                'service_category' => 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3',
                'remote_url' => '/permittingDocuments#building-tab'
            ],
        ];

        foreach ($data as $category) {
            CategoryAppeal::query()->create([
                'id' => $category['id'],
                'name' => $category['name'],
                'description' => $category['description'],
                'service_group_id' => $category['service_groups_id'],
                'types_appeal_id' => $category['types_appeal_id'],
                'remote_url' => $category['remote_url'],
                'service_category_id'=> $category['service_category']
            ]);

            StorageFile::query()->create([
                'storable_id' => $category['id'],
                'storable_type' => CategoryAppeal::class,
                'path' => 'appealType/' . $category['id'] . '.png',
                'file_type' => 'thumbnail',
            ]);
        }
    }

}
