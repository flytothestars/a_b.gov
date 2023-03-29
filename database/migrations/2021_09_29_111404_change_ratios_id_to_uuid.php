<?php

use App\Repositories\Enums\Reports\IRatioScopeEnum;
use Database\Seeders\InvestmentsRatiosSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class ChangeRatiosIdToUuid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('report_city_ratios');
        Schema::dropIfExists('report_region_ratios');
        Schema::dropIfExists('report_ratios');
        Schema::create('report_ratios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('report_type_id');
            $table->string('name');
            $table->unsignedBigInteger('scope')->default(IRatioScopeEnum::RATIO_SCOPE_ALL);

            $table->foreign('report_type_id')->on('report_types')->references('id');
        });
        Schema::create('report_city_ratios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('city_id');
            $table->unsignedBigInteger('report_type_id');
            $table->uuid('ratio_id');
            $table->float('value');
            $table->date('date');
            $table->timestamps();

            $table->foreign('city_id')->on('cities')->references('id');
            $table->foreign('report_type_id')->on('report_types')->references('id');
            $table->foreign('ratio_id')->on('report_ratios')->references('id');

            $table->unique(['city_id','report_type_id', 'ratio_id', 'date'], 'unique_ratio');
        });
        Schema::create(
            'report_region_ratios',
            function (Blueprint $table)
            {
                $table->uuid('id')
                      ->primary()
                ;
                $table->uuid('city_id');
                $table->uuid('region_id');
                $table->unsignedBigInteger('report_type_id');
                $table->uuid('ratio_id');
                $table->float('value');
                $table->date('date');
                $table->timestamps();

                $table->foreign('city_id')
                      ->on('cities')
                      ->references('id')
                ;
                $table->foreign('report_type_id')
                      ->on('report_types')
                      ->references('id')
                ;
                $table->foreign('ratio_id')
                      ->on('report_ratios')
                      ->references('id')
                ;
                $table->foreign('region_id')
                      ->on('regions')
                      ->references('id')
                ;

                $table->unique([ 'city_id', 'report_type_id', 'ratio_id', 'region_id', 'date' ], 'unique_ratio_region');
            }
        );
        Artisan::call(
            'db:seed',
            [
                '--class' => InvestmentsRatiosSeeder::class,
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_city_ratios');
        Schema::dropIfExists('report_region_ratios');
        Schema::dropIfExists('report_ratios');
        Schema::create('report_ratios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_type_id');
            $table->string('name');

            $table->foreign('report_type_id')->on('report_types')->references('id');
        });
        Schema::create('report_city_ratios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('city_id');
            $table->unsignedBigInteger('report_type_id');
            $table->unsignedBigInteger('ratio_id');
            $table->float('value');
            $table->date('date');
            $table->timestamps();

            $table->foreign('city_id')->on('cities')->references('id');
            $table->foreign('report_type_id')->on('report_types')->references('id');
            $table->foreign('ratio_id')->on('report_ratios')->references('id');

            $table->unique(['city_id','report_type_id', 'ratio_id', 'date'], 'unique_ratio');
        });
        Schema::create(
            'report_region_ratios',
            function (Blueprint $table)
            {
                $table->uuid('id')
                      ->primary()
                ;
                $table->uuid('city_id');
                $table->uuid('region_id');
                $table->unsignedBigInteger('report_type_id');
                $table->unsignedBigInteger('ratio_id');
                $table->float('value');
                $table->date('date');
                $table->timestamps();

                $table->foreign('city_id')
                      ->on('cities')
                      ->references('id')
                ;
                $table->foreign('report_type_id')
                      ->on('report_types')
                      ->references('id')
                ;
                $table->foreign('ratio_id')
                      ->on('report_ratios')
                      ->references('id')
                ;
                $table->foreign('region_id')
                      ->on('regions')
                      ->references('id')
                ;

                $table->unique([ 'city_id', 'report_type_id', 'ratio_id', 'region_id', 'date' ], 'unique_ratio_region');
            }
        );

    }
}
