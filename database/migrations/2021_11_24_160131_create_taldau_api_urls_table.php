<?php

use App\Contracts\Taldau\ITaldauApiUrlContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaldauApiUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'taldau_api_urls',
            function (Blueprint $table)
            {
                $table->uuid(ITaldauApiUrlContract::FIELD_ID)
                      ->primary()
                ;
                $table->boolean(ITaldauApiUrlContract::FIELD_IS_ACTIVE)
                      ->default(false)
                ;
                $table->text(ITaldauApiUrlContract::FIELD_URL);
                $table->unsignedBigInteger(ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID);
                $table->uuid(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID);

                $table->foreign(ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID)->on('report_types')->references('id');
                $table->foreign(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID)->on('report_ratios')->references('id');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taldau_api_urls');
    }
}
