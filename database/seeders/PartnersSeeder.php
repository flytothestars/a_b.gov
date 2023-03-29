<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    public function run(): void
    {
        $partnerList = [
            ['id' => 'c781c9a7-01fd-4fe0-81ee-277b154738c5', 'no' => 1, 'name' => 'Airbnb', 'url' => 'https://www.airbnb.ru/kazakhstan/stays'],
            ['id' => '475bf087-1d10-4936-ac3f-99ba2d847761', 'no' => 2, 'name' => 'Amazon', 'url' => 'https://www.amazon.com/'],
            ['id' => 'ac6909ab-8cb0-4e96-ab14-9339059a74a7', 'no' => 3, 'name' => 'FedEx', 'url' => 'https://www.fedex.com/'],
            ['id' => '9f2b26c5-9d19-4b01-aab4-39037c35cd4a', 'no' => 4, 'name' => 'Microsoft', 'url' => 'https://www.microsoft.com/'],
            ['id' => 'd4a0dd12-c5a8-4302-a520-66f01446e201', 'no' => 5, 'name' => 'Google', 'url' => 'https://www.google.kz/'],
            ['id' => 'd84bd868-0d31-4a57-a14b-3623c002366c', 'no' => 6, 'name' => 'OLA', 'url' => null],
            ['id' => 'a645dad0-9d2f-458f-8705-8eba251b1bca', 'no' => 7, 'name' => 'Walmart', 'url' => 'https://www.walmart.com/'],
            ['id' => '0d348cc1-1bc0-41b0-a4d0-736048b40b71', 'no' => 8, 'name' => 'OYO', 'url' => 'https://www.oyorooms.com/'],
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
