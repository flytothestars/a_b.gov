<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceBanks;

class ServiceBanksSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'bank_code' => 'bcc',
                'header' => 'Банк Центр Кредит',
                'account_content' => '',
                'loan_content' => '',
                'application' => 'Онлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '1 000 тг',
                'account_managment' => '1 000 тг/мес',
                'open_account_url' => 'https://www.bcc.kz/kartakarta/',
                'get_loan_url' => 'https://www.bcc.kz/fizical/kreditovanie/',
            ],
            [
                'bank_code' => 'alfa',
                'header' => 'Альфа Банк',
                'account_content' => ' <ul>
                <li>Счёт для ИП и Малого бизнеса</li>
                <li>Откроем за 10 минут</li>
                <li>С ЭЦП НУЦ</li>
                <li>По удостоверению личности РК</li>
                <li>Выпустим карту для бизнеса</li>
            </ul>
            <hr>
            <p class="font-bold mb-4 font-md">Условия</p>
            <ul>
                <li>Вам понадобятся ЭЦП НУЦ и фото удостоверения личности</li>
                <li>Налоговое резиденство РК. В том числе у всех учредителей ТОО</li>
                <li>Нет другого счёта компании в Альфа-Банке</li>
                <li>Упрощеная структура компании. Не более 10 учредителей физ.лиц</li>
                <li>Нет арестов и задолженностей. У компании и учредителей</li>
                <li>Онлайн открытие счета только для ИП и ТОО</li>
            </ul>
            <hr>
    
            <p class="font-bold mb-4 font-md">Для онлайн открытия счёта нужно:</p>
            <ul>
                <li>Закачать на компьютер ЭЦП руководителя компании. Получить ЭЦП онлайн можно на сайте e-gov</li>
                <li>Быть резидентом РК</li>
                <li>У компании должно быть не более 10 учредителей</li>
                <li>Только ИП(КХ) или ТОО могут открыть счёт онлайн</li>
                <li>Не должно быть арестов и задолженностей</li>
                <li>Не должно быть юридического счёта в Альфа-Банке</li>
                <li>Фото удостоверения руководителя. Для ТОО - удостоверения учредителей и тех, кому даёте доступ к управлению счётом (бухгалтер, директор и тп.) Для других форм организации, нерезидентов и сложных ТОО (более 10 учредителей или имеющих в составе учредителей юридическое лицо) счёт откроем в отделении. Посмотрите список отделений по ссылке и уточните время работы.</li>
    
            </ul>',
                'loan_content' => '<p class="font-bold mb-4 font-md">Сумма займа</p>
                <ul>
                    <li>от 100 тыс. тг до 2 млн. тг</li>
                </ul>
                <hr>
                <p class="font-bold mb-4 font-md">Срок финансирования</p>
        
                <ul>
                    <li>до 36 месяцев</li>
                </ul>
                <hr>
                <p>Освоение осуществляется наличным или безналичным путем<br>
                    Комиссия за предоставление займа – отсутствует</p>',
                'application' => 'Онлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '0 тг',
                'account_managment' => 'Согласно тарифам',
                'open_account_url' => 'https://alfabank.kz/persons/payment-cards',
                'get_loan_url' => 'https://alfabank.kz/persons/credits/',
            ],
            [

                'bank_code' => 'sber',
                'header' => 'Сбербанк',
                'account_content' => '<ul>
                <li class="mb-4">Для клиентов Сбер Банка доступна услуга по бесплатному открытию счета для ИП и ТОО с единственным учредителем.</li>
                <li class="mb-4">Процедура максимальна упрощена и абсолютно бесплатна. Занимает всего несколько минут и доступна из любой точки мира.</li>
                <li class="mb-4">Важно подчеркнуть, что для открытия счета требуется всего один документ – удостоверение личности. Пользователь должен быть единственным учредителем и руководителем ТОО, а также резидентом Казахстана.</li>
                <li class="mb-4">После открытия счета клиент моментально получает доступ к нему и всем сервисам приложения СберБизнес.</li>
                <li class="mb-4">Например, получение информации по счетам компании, выписки в режиме онлайн, оплата счетов, предоставление необходимых данных для налоговой службы, онлайн выпуск корпоративных карт, заказ и получение наличных онлайн с помощью услуги «Электронный чек» и многое другое.</li>
    
            </ul>
            <hr>
    
    
            <p class="font-bold mb-4 font-md">Для онлайн открытия счёта нужно:</p>
            <ul>
                <li>Скачать и пройти авторизациюв мобильном приложении СберБизнес</li>
                <li>Подписать документы на открытие счета с помощью ЭЦП Банка и сразу же можно пользоваться счетом.</li>
            </ul>',
                'loan_content' => '',
                'application' => 'Онлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '0 тг',
                'account_managment' => 'Согласно тарифам',
                'open_account_url' => 'https://sber.kz/visa-allin',
                'get_loan_url' => 'https://sber.kz/credits',
            ],
            [

                'bank_code' => 'halyk',
                'header' => 'Halyk bank',
                'account_content' => '',
                'loan_content' => '',
                'application' => 'Онлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '1 000 тг',
                'account_managment' => '1 000 тг/мес',
                'open_account_url' => 'https://halykbank.kz/card/dostavka',
                'get_loan_url' => 'https://halykbank.kz/credits/onlajn-kredit',
            ],

        ];

        foreach ($data as $bank) {
            ServiceBanks::query()->updateOrCreate(

                [
                    'bank_code' => $bank['bank_code'],
                    'header' => $bank['header'],
                    'account_content' => $bank['account_content'],
                    'loan_content' => $bank['loan_content'],
                    'application' => $bank['application'],
                    'rate' => $bank['rate'],
                    'term' => $bank['term'],
                    'open_account' => $bank['open_account'],
                    'account_price' => $bank['account_price'],
                    'account_managment' => $bank['account_managment'],
                    'open_account_url' => $bank['open_account_url'],
                    'get_loan_url' => $bank['get_loan_url'],
                ]
            );
        }
    }
}
