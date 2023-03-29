<?php

use App\Models\Partner;
use App\Models\StorageFile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewPartnerIndZone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $newPartner = Partner::query()->create([
            'id' => 'c2fd3214-c9fa-4b05-83fc-02c6f9c6e4fb',
            'name' => 'Almaty Индурстриальная зона',
            'url' => 'https://indzone.kz/?page_id=752&lang=en',
            'order_no' => '6'
        ]);
        StorageFile::query()->create([
            'storable_id' => $newPartner->id,
            'storable_type' => Partner::class,
            'path' => 'partner/6.png',
            'file_type' => 'picture',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
