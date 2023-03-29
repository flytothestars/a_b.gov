<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\ServiceGroup;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsList = [
            ['no' => 1, 'id' => 'e6b11157-ad84-418e-82ca-16135e821ad6', 'news_category_id' => '0e82b0ef-2dd7-4755-a172-66623930719e', 'is_published' => 1,
                'create_date' => '20210110', 'code' => 'lgotnoe-kreditovanie-biznesa-zapustili-v-almaty',
                'header' => 'Льготное кредитование бизнеса запустили в Алматы',
                'lead' => 'Субъекты малого и среднего бизнеса, реализующие проекты в Алатауском, Жетысуском, Турксибском и Наурызбайском районах, могут',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing viverra ultrices risus volutpat porttitor pretium felis, ut. Purus tortor vitae tellus placerat. Dictum mi mattis sollicitudin pharetra adipiscing curabitur. Aliquet vitae vitae proin pretium diam venenatis eros amet, a. Enim sit nam fames nibh id urna morbi massa. Nisi luctus quisque tempor magna et magnis et lacus. Libero nec nunc ut vitae pretium sed. Ipsum pretium sed euismod lacus massa. Nulla in in erat nec urna porta sit tristique tortor. Est, sit commodo vitae aliquam nisl quis. Vitae, volutpat tempor nisl in. Amet morbi vulputate sit accumsan ultrices pulvinar bibendum. Pretium facilisis nisl neque quis aenean a diam id egestas. Quis nullam gravida senectus sapien tortor pretium interdum viverra eget. Adipiscing morbi netus tellus interdum suscipit. Turpis nec faucibus nunc mauris, sed amet dignissim odio. Senectus varius tristique venenatis scelerisque phasellus convallis et dictum tortor. Cursus scelerisque habitasse amet sit tellus aliquam eget. Id egestas blandit arcu tortor consequat integer quis.</p>'
            ],
            ['no' => 2, 'id' => '5850e998-11b2-4166-a75d-2ebb5c6e6706', 'news_category_id' => '0e82b0ef-2dd7-4755-a172-66623930719e', 'is_published' => 1,
                'create_date' => '20210111', 'code' => 'grant-v-2-mln-tenge-na-proizvodstvo-ulev',
                'header' => 'Грант в 2 млн тенге на производство ульев',
                'lead' => 'Темирбек Медеубеков из Алматы получил грант от государства в размере 2 млн тенге на производство',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing viverra ultrices risus volutpat porttitor pretium felis, ut. Purus tortor vitae tellus placerat. Dictum mi mattis sollicitudin pharetra adipiscing curabitur. Aliquet vitae vitae proin pretium diam venenatis eros amet, a. Enim sit nam fames nibh id urna morbi massa. Nisi luctus quisque tempor magna et magnis et lacus. Libero nec nunc ut vitae pretium sed. Ipsum pretium sed euismod lacus massa. Nulla in in erat nec urna porta sit tristique tortor. Est, sit commodo vitae aliquam nisl quis. Vitae, volutpat tempor nisl in. Amet morbi vulputate sit accumsan ultrices pulvinar bibendum. Pretium facilisis nisl neque quis aenean a diam id egestas. Quis nullam gravida senectus sapien tortor pretium interdum viverra eget. Adipiscing morbi netus tellus interdum suscipit. Turpis nec faucibus nunc mauris, sed amet dignissim odio. Senectus varius tristique venenatis scelerisque phasellus convallis et dictum tortor. Cursus scelerisque habitasse amet sit tellus aliquam eget. Id egestas blandit arcu tortor consequat integer quis.</p>'
            ],
            ['no' => 3, 'id' => 'a24172aa-2c28-43a9-a7cf-ddb42dbc271f', 'news_category_id' => '0e82b0ef-2dd7-4755-a172-66623930719e', 'is_published' => 1,
                'create_date' => '20210111', 'code' => 'pochti-desyat-tysyach-almatincev-obuchilis',
                'header' => 'Почти десять тысяч алматинцев обучились',
                'lead' => 'С начала деятельности (с сентября 2019 года) в Центре предпринимательства «Qoldaý» основам предпринимательства обучились',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing viverra ultrices risus volutpat porttitor pretium felis, ut. Purus tortor vitae tellus placerat. Dictum mi mattis sollicitudin pharetra adipiscing curabitur. Aliquet vitae vitae proin pretium diam venenatis eros amet, a. Enim sit nam fames nibh id urna morbi massa. Nisi luctus quisque tempor magna et magnis et lacus. Libero nec nunc ut vitae pretium sed. Ipsum pretium sed euismod lacus massa. Nulla in in erat nec urna porta sit tristique tortor. Est, sit commodo vitae aliquam nisl quis. Vitae, volutpat tempor nisl in. Amet morbi vulputate sit accumsan ultrices pulvinar bibendum. Pretium facilisis nisl neque quis aenean a diam id egestas. Quis nullam gravida senectus sapien tortor pretium interdum viverra eget. Adipiscing morbi netus tellus interdum suscipit. Turpis nec faucibus nunc mauris, sed amet dignissim odio. Senectus varius tristique venenatis scelerisque phasellus convallis et dictum tortor. Cursus scelerisque habitasse amet sit tellus aliquam eget. Id egestas blandit arcu tortor consequat integer quis.</p>'
            ],
            ['no' => 4, 'id' => '41ab1eca-ff10-42f4-8934-34f1a9d70614', 'news_category_id' => '0e82b0ef-2dd7-4755-a172-66623930719e', 'is_published' => 1,
                'create_date' => '20210112', 'code' => 'besplatnyj-sportzal-dlya-lic-s-ogranichennymi',
                'header' => 'Бесплатный спортзал для лиц с ограниченными',
                'lead' => 'Центр коррекции тела "LegenDA" заработал в начале этого года при финансовой поддержке МФО "Алматы", которое',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing viverra ultrices risus volutpat porttitor pretium felis, ut. Purus tortor vitae tellus placerat. Dictum mi mattis sollicitudin pharetra adipiscing curabitur. Aliquet vitae vitae proin pretium diam venenatis eros amet, a. Enim sit nam fames nibh id urna morbi massa. Nisi luctus quisque tempor magna et magnis et lacus. Libero nec nunc ut vitae pretium sed. Ipsum pretium sed euismod lacus massa. Nulla in in erat nec urna porta sit tristique tortor. Est, sit commodo vitae aliquam nisl quis. Vitae, volutpat tempor nisl in. Amet morbi vulputate sit accumsan ultrices pulvinar bibendum. Pretium facilisis nisl neque quis aenean a diam id egestas. Quis nullam gravida senectus sapien tortor pretium interdum viverra eget. Adipiscing morbi netus tellus interdum suscipit. Turpis nec faucibus nunc mauris, sed amet dignissim odio. Senectus varius tristique venenatis scelerisque phasellus convallis et dictum tortor. Cursus scelerisque habitasse amet sit tellus aliquam eget. Id egestas blandit arcu tortor consequat integer quis.</p>'
            ],
            ['no' => 5, 'id' => '37464ce2-1394-4e9f-9bc8-378537cdf20d', 'news_category_id' => '0e82b0ef-2dd7-4755-a172-66623930719e', 'is_published' => 1,
                'create_date' => '20210113', 'code' => 'nakopilis-voprosy-zadajte-ih-nashim-ekspertam-ne-vyhodya-iz-doma',
                'header' => 'Накопились вопросы? Задайте их нашим экспертам, не выходя из дома',
                'lead' => 'Сегодня, 20 мая 2021 года, на нашем обучающем портале edu.qolday.kz пройдут 2 тренинга с участием',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing viverra ultrices risus volutpat porttitor pretium felis, ut. Purus tortor vitae tellus placerat. Dictum mi mattis sollicitudin pharetra adipiscing curabitur. Aliquet vitae vitae proin pretium diam venenatis eros amet, a. Enim sit nam fames nibh id urna morbi massa. Nisi luctus quisque tempor magna et magnis et lacus. Libero nec nunc ut vitae pretium sed. Ipsum pretium sed euismod lacus massa. Nulla in in erat nec urna porta sit tristique tortor. Est, sit commodo vitae aliquam nisl quis. Vitae, volutpat tempor nisl in. Amet morbi vulputate sit accumsan ultrices pulvinar bibendum. Pretium facilisis nisl neque quis aenean a diam id egestas. Quis nullam gravida senectus sapien tortor pretium interdum viverra eget. Adipiscing morbi netus tellus interdum suscipit. Turpis nec faucibus nunc mauris, sed amet dignissim odio. Senectus varius tristique venenatis scelerisque phasellus convallis et dictum tortor. Cursus scelerisque habitasse amet sit tellus aliquam eget. Id egestas blandit arcu tortor consequat integer quis.</p>'
            ],
            ['no' => 5, 'id' => '88f9ee89-c461-43b7-8a72-f4d79a4f0b32', 'news_category_id' => '0e82b0ef-2dd7-4755-a172-66623930719e', 'is_published' => 1,
                'create_date' => '20210213', 'code' => 'onlajn-urok-dlya-rukovoditelej-biznesa-po',
                'header' => 'Онлайн-урок для руководителей бизнеса по',
                'lead' => 'Дорогие друзья! 13 мая с 16.00 до 18.00 часов в рамках нашего курса для руководителей',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing viverra ultrices risus volutpat porttitor pretium felis, ut. Purus tortor vitae tellus placerat. Dictum mi mattis sollicitudin pharetra adipiscing curabitur. Aliquet vitae vitae proin pretium diam venenatis eros amet, a. Enim sit nam fames nibh id urna morbi massa. Nisi luctus quisque tempor magna et magnis et lacus. Libero nec nunc ut vitae pretium sed. Ipsum pretium sed euismod lacus massa. Nulla in in erat nec urna porta sit tristique tortor. Est, sit commodo vitae aliquam nisl quis. Vitae, volutpat tempor nisl in. Amet morbi vulputate sit accumsan ultrices pulvinar bibendum. Pretium facilisis nisl neque quis aenean a diam id egestas. Quis nullam gravida senectus sapien tortor pretium interdum viverra eget. Adipiscing morbi netus tellus interdum suscipit. Turpis nec faucibus nunc mauris, sed amet dignissim odio. Senectus varius tristique venenatis scelerisque phasellus convallis et dictum tortor. Cursus scelerisque habitasse amet sit tellus aliquam eget. Id egestas blandit arcu tortor consequat integer quis.</p>'
            ],
        ];

        foreach ($newsList as $news) {
            $_news = News::query()->create([
                'id' => $news['id'],
                'news_category_id' => $news['news_category_id'],
                'header' => $news['header'],
                'lead' => $news['lead'],
                'content' => $news['content'],
                'create_date' => $news['create_date'],
                'is_published' => $news['is_published'],
                'code' => $news['code'],
            ]);
            StorageFile::query()->create([
                'storable_id' => $_news->id,
                'storable_type' => News::class,
                'path' => 'news/thumbnail/' . $news['no'] . '.png',
                'file_type' => 'thumbnail',
            ]);
        }

    }
}
