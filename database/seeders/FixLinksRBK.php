<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceBanks;

class FixLinksRBK extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'bank_code' => 'rbk',
            'open_account_url' => 'https://www.bankrbk.kz/ru/corp-business/rko/otkryt-schet-1',
            'get_loan_url' => 'https://www.bankrbk.kz/ru/corp-business/loans'
        ];
        ServiceBanks::query()->where('bank_code', $data['bank_code'])
            ->update(
                [
                    'open_account_url' => $data['open_account_url'],
                    'get_loan_url' => $data['get_loan_url']
                ]
            );
        //
    }
}
