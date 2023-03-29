<?php

use App\Models\ServiceGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixLicenseServiceName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            ['id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab', 'name' => 'Лицензии и другие разрешения' ],
        ];
        foreach ($data as $serviceGroup) {
            ServiceGroup::query()->updateOrCreate(['id' => $serviceGroup['id']], ['name' => $serviceGroup['name']]);
        }

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
