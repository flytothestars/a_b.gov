<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class NewPartnersSeeder extends Seeder
{

    public function run() : void
    {
        $partnerList = [
            ['id' => 'c781c9a7-01fd-4fe0-81ee-277b154738c5', 'no' => 1, 'name' => 'Qolday', 'url' => 'https://qolday.kz/'],
            ['id' => '475bf087-1d10-4936-ac3f-99ba2d847761', 'no' => 2, 'name' => 'SPK Almaty', 'url' => 'https://spk-almaty.kz/'],
            ['id' => 'ac6909ab-8cb0-4e96-ab14-9339059a74a7', 'no' => 3, 'name' => 'Almaty Finance', 'url' => 'http://almatyfinance.kz/'],
            ['id' => '9f2b26c5-9d19-4b01-aab4-39037c35cd4a', 'no' => 4, 'name' => 'Almaty MFO', 'url' => 'https://mfoalmaty.kz/'],
            ['id' => 'd4a0dd12-c5a8-4302-a520-66f01446e201', 'no' => 5, 'name' => 'СЭЗ ПИТ Алатау', 'url' => 'https://pitalatau.kz/'],
        ];
        foreach ($partnerList as $partner) {
            $newPartner = Partner::query()->create([
                'id' => $partner['id'],
                'name' => $partner['name'],
                'url' => $partner['url'],
                'order_no' => $partner['no']
            ]);
            StorageFile::query()->create([
                'storable_id' => $newPartner->id,
                'storable_type' => Partner::class,
                'path' => 'partner/' . $partner['no'] . '.png',
                'file_type' => 'picture',
            ]);
        }
    }
}
