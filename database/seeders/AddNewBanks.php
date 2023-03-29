<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceBanks;

class AddNewBanks extends Seeder
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
                'account_content' => '<p>Открытие счёта для Вашего бизнеса совершенно бесплатно! KZT, USD, EUR, RUB</p>
                <br>
                <p>Подключение к StarBusiness   0 ₸<p>
                <p>Подключение к системе «Интернет-банкинг» 0 ₸<p>
                <br>
                <p class="font-bold mb-4 font-md">Вместе со счётом Вам станут доступны<p>
                <ul>
                <li>Бесплатное открытие и ведение валютного счета<\li>
                <li>Онлайн-конвертация валют по биржевому курсу<\li>
                <li>Онлайн-получение учетного номера за 1 час<\li>
                <li>Автоматическое уведомление клиента через Систему «Интернет-банкинг» о поступлении денежных средств<\li>
                <li>Зачисление денежных средств на счет сразу после валютного контроля<\li>
                <li>Бесплатная предварительная проверка контракта и предоставление консультации в случае, если начинаете работать с новым партнером или заключаете новую сделку<\li>
                </ul>',
                'loan_content' => '<p>Заявка - офлайн</p>
                <br>
                <p>РАСТУЩИЙ БИЗНЕС без залога<p>
                <br>
                <p>КРЕДИТ НА РАЗВИТИЕ БИЗНЕСА: пополнение оборотных средств, инвестиции</p>
                <p>Максимальная сумма займа для для субъектов микро, малого и среднего бизнеса - до 20 000 000 ₸</p>
                <p>МАКСИМАЛЬНЫЙ СРОК – до 24 месяца</p>
                <p>СТАВКА - от 21,25%</p>
                <p>КОМИССИЯ за выдачу - 2% от суммы кредита (мин 10 000 тенге)</p>
                <br>
                <p>также доступно финансирование в рамках условий государственных программ от 6% для заемщика.
                минимальный пакет документов и быстрое решение</p>
                ',
                'application' => 'Онлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '1 000 тг',
                'account_managment' => '1 000 тг/мес',
                'open_account_url' => 'https://www.bcc.kz/current-account/',
                'get_loan_url' => 'https://www.bcc.kz/product/programma-kreditovaniya-dlya-individualnykh-predprinimateley/',
            ],


            [

                'bank_code' => 'halyk',
                'header' => 'Halyk bank',
                'account_content' => '<p>Начните свой бизнес не выходя из дома. <p>
                <p>Все можно сделать онлайн - зарегистрируйте ИП и откройте счет за 10 минут<p>
                <br>
                <p class="font-bold mb-4 font-md">Вы получите БЕСПЛАТНО<p>
                <ul>
                <li>
                регистрация ИП онлайн 0 ₸</li>
                  
                <li>открытие и ведение счета в тарифном пакете 0 ₸ </li>
                  
                <li>выпуск карты для бизнеса 0 ₸</li>
                  
                <li>онлайн бухгалтерия 0 ₸</li>
                  
                <li> мобильное приложение Onlinebank  0 ₸</li>
                  
                <li> круглосуточные платежи и переводы в Onlinebank 0 ₸ </li>
                </ul>
                ',
                'loan_content' => '<p>Кредит для ИП на развитие бизнеса</p>
                <br>
                <p>Заявка - онлайн</p>
                <ul>
                <li>Сумма финансирования – до 30 млн тенге</li>
                </ul>
                <p>Сроки:</p>
                <ul>
                <li>на развитие бизнеса - до 24 месяцев </li>
                <li>на инвестиции - до 60 месяцев</li>
                <li>Целевое использование займа – пополнение оборотных средств, инвестиционные цели</li>
                <li> Ставка вознаграждения- до от 17 % (ГЭСВ от 20,8 %) годовых</li>
                <li>Размер субсидий- до 10% годовых.</li>
                <li>Без залога</li>
                </ul>
                ',
                'application' => 'Онлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '1 000 тг',
                'account_managment' => '1 000 тг/мес',
                'open_account_url' => 'https://halykbank.kz/ru/business/account/otkryt-schet-ip',
                'get_loan_url' => 'https://onlinecredit.halykbank.kz',
            ],
            [

                'bank_code' => 'eubank',
                'header' => 'Eurasian Bank',
                'account_content' => '<p class="font-bold mb-4 font-md">Откройте банковский счет в Евразийском банке и получите доступ ко всем продуктам банка.</p>
                <br>

                <p class="font-bold mb-4 font-md"> Наши преимущества</p>
                <ul>
                <li>Открытие счета за 1 час</li>
                <li>Удобство и качество услуг</li>
                <li>Индивидуальный подход к каждому клиенту</li>
                </ul>
                <p class="font-bold mb-4 font-md">Как открыть счет</p>
                <ol>
                <li>Подготовить список необходимых документов.</li>
                <li>Посетить отделение банка.</li>
                <li>Получить реквизиты новых счетов.</li>
                </ol>
                ',
                'loan_content' => ' 
                <p class="font-bold mb-4 font-md">«Овердрафт»</p>
                <hr>
                <p class="font-bold mb-4 font-md">Кредит на пополнение оборотных средств или покрытие кассового разрыва онлайн</p>
                <br>
                <ul>
                <li>Выдача транша в течение 2 минут с момента подачи заявки в Client’s Bank</li>
                <li>Залог не требуется</li>
                <li>Срок действия лимита: 180 дней</li>
                <li> Ставка: 21% (ГЭСВ от 28,1%).</li>
                <li>Комиссия за открытие лимита: 0%</li>
                <li>Комиссия за выдачу транша: 0,3% от суммы транша.</li>
                <li>Максимальная сумма: 30 млн тенге.</li>
                <li> Срок использования транша: 30 календарных дней.</li>
                </ul>
                ',
                'application' => 'Оффлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '1 000 тг',
                'account_managment' => '1 000 тг/мес',
                'open_account_url' => 'https://eubank.kz/business/opening-a-bank-account/',
                'get_loan_url' => 'https://eubank.kz/business/loans-for-legal-entities/overdraft/',
            ],
            [

                'bank_code' => 'rbk',
                'header' => 'RBK Bank',
                'account_content' => '<p class="font-bold mb-4 font-md">Ваши преимущества со счётом в Bank RBK:</p>
                <br>
                <p class="font-bold mb-4 font-md">Текущие счета в тенге и иностранной валюте</p>

                <ul>
                <li>открытие и обслуживание счетов в различных валютах</li>
                <li>наличные и безналичные операции по счетам</li>
                <li>сопровождение валютных контрактов</li>
                </ul>
                
                <br>
                <p class="font-bold mb-4 font-md">Эскроу и Репозит-счета</p>
                <ul>
                <li>Предназначены для размещения и временного депонирования (хранения) денег клиента с целью дальнейшего их перечисления в пользу получателя, при условии предоставления клиентом/получателем Банку документов, подтверждающих выполнение получателем договорных обязательств</li>
                </ul>
                
                ',
                'loan_content' => '<p> Заявка - офлайн</p>
                <br>

                <p class="font-bold mb-4 font-md">«Механизм кредитования приоритетных проектов»</p>
                <ul>
                <li>Сумма финансирования – без ограничения</li>
                <li> Сроки –  до 10 лет</li>
                <li>Целевое использование займа - пополнение оборотных средств, инвестиционные цели</li>
                <li>Ставка вознаграждения- до 15 % годовых</li>
                <li>Размер субсидий- до 10% годовых.</li>
                </ul>
                
                ',
                'application' => 'Оффлайн',
                'rate' => 'До 25%',
                'term' => '36 мес.',
                'open_account' => 'Онлайн',
                'account_price' => '1 000 тг',
                'account_managment' => '1 000 тг/мес',
                'open_account_url' => 'https://eubank.kz/business/opening-a-bank-account/',
                'get_loan_url' => 'https://eubank.kz/business/loans-for-legal-entities/overdraft/',
            ]

        ];

        foreach ($data as $bank) {
            $processexist = ServiceBanks::select('*')
                ->where('bank_code', $bank['bank_code'])
                ->first();
            if ($processexist == null) //if doesn't exist: create
            {
                ServiceBanks::query()
                    ->create(

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
            } else {
                ServiceBanks::query()->where('bank_code', $bank['bank_code'])
                    ->update(

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
}
