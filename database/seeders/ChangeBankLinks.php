<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceBanks;

class ChangeBankLinks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'alfa' => [
                'bank_code' => 'alfa',
                'loan_content' => '<p class="font-bold mb-4 font-md">Требования</p>
                <ul>
                    <li>ИП - гражданин РК</li>
                    <li>Возраст ИП от 21 до 65 лет</li>
                    <li>Наличие ЭЦП НУЦ</li>
                    <li>Опыт работы по основной деятельности не менее 6 месяцев</li>
                </ul>
                <hr>
                <p class="font-bold mb-4 font-md">Цель кредитования</p>
        
                <ul>
                    <li>Пополнение оборотных средств (ПОС)</li>
                </ul>
                <hr>
                <p class="font-bold mb-4 font-md">Максимальная сумма кредитования</p>
        
                <ul>
                    <li>2 000 000 (два миллиона) тенге</li>
                </ul>
                <hr>
                <p class="font-bold mb-4 font-md">Комиссия за предоставление займа</p>
        
                <ul>
                    <li>Отсутствует</li>
                </ul>',
                'open_account_url' => 'https://alfabank.kz/small-business/page/open-account-promo?utm_source=google&utm_medium=cpa&utm_campaign=mb-promo&utm_content=search_%D0%A1%D1%87%D0%B5%D1%82_%D0%B1%D1%80%D0%B5%D0%BD%D0%B4&utm_term=%D0%BE%D1%82%D0%BA%D1%80%D1%8B%D1%82%D0%B8%D0%B5%20%D1%81%D1%87%D0%B5%D1%82%D0%B0%20%D0%B4%D0%BB%D1%8F%20%D0%B8%D0%BF%20%D0%B0%D0%BB%D1%8C%D1%84%D0%B0%20%D0%B1%D0%B0%D0%BD%D0%BA&gclid=Cj0KCQiA15yNBhDTARIsAGnwe0V0Q6uFSRNsLwRC1V4dBwyse0EAbsFTfChy71Tmrg2NszB29GqS5i8aAiYwEALw_wcB',
                'get_loan_url' => 'https://office.alfabank.kz/credit/home?utm_source=ab&utm_medium=cpa&utm_campaign=mb-credit',
            ],
            'sber' => [
                'bank_code' => 'sber',
                'open_account_url' => 'https://sberbank.kz/ru/open_online?utm_source=google&utm_medium=cpc&utm_campaign=sber_business&utm_content=sberbank_ip_contextad_rus%7C%7C13391985307%7C121019391817%7C525871066729%7Cc%7C9063099%7C%2B%D1%81%D0%B1%D0%B5%D1%80%D0%B1%D0%B0%D0%BD%D0%BA%20%2B%D1%81%D1%87%D0%B5%D1%82%20%2B%D0%B4%D0%BB%D1%8F%20%2B%D0%B8%D0%BF%7C&utm_term=keywords&gclid=Cj0KCQiA15yNBhDTARIsAGnwe0UyQsIflxVqdae8vjAyq1ghKOv3NgWyfRCt6-N8biti7xf7KYwow6waAhpkEALw_wcB',
                'get_loan_url' => 'https://www.sberbank.kz/ru/finansing_business?utm_source=promo&utm_medium=referral&utm_campaign=promo',

            ]
        ];
        ServiceBanks::query()->where('bank_code', $data['alfa']['bank_code'])
            ->update(
                [
                    'loan_content' => $data['alfa']['loan_content'],
                    'open_account_url' => $data['alfa']['open_account_url'],
                    'get_loan_url' => $data['alfa']['get_loan_url']
                ]
            );
        ServiceBanks::query()->where('bank_code', $data['sber']['bank_code'])
            ->update(
                [
                    'open_account_url' => $data['sber']['open_account_url'],
                    'get_loan_url' => $data['sber']['get_loan_url']
                ]
            );
        //
    }
}
