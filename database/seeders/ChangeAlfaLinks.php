<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceBanks;

class ChangeAlfaLinks extends Seeder
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
                'open_account_url' => 'https://office.alfabank.kz/account?utm_source=almatybusiness&utm_medium=cpa&utm_campaign=mb-office',
                'get_loan_url' => 'https://office.alfabank.kz/credit/home?utm_source=almatybusiness&utm_medium=cpa&utm_campaign=mb-credit',
            ],
        ];
        ServiceBanks::query()->where('bank_code', $data['alfa']['bank_code'])
            ->update(
                [
                    'open_account_url' => $data['alfa']['open_account_url'],
                    'get_loan_url' => $data['alfa']['get_loan_url']
                ]
            );
        //
    }
}
