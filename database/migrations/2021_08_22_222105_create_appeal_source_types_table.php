<?php

use App\Models\Appeal;
use App\Repositories\Enums\AppealSourceTypeEnum;
use Database\Seeders\AppealSourceTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateAppealSourceTypesTable extends Migration
{

    public function up()
    {
        Schema::create('appeal_source_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 256);
        });

        Artisan::call('db:seed', [
            '--class' => AppealSourceTypeSeeder::class
        ]);

        Schema::table('appeals', function (Blueprint $table) {
            $table->uuid('appeal_source_type_id')->nullable();
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->foreign('appeal_source_type_id')->references('id')->on('appeal_source_types');
            $table->index(['appeal_source_type_id']);
        });

        Appeal::query()->update(['appeal_source_type_id' => AppealSourceTypeEnum::Portal]);
    }

    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
            $table->dropForeign(['appeal_source_type_id']);
            $table->dropIndex(['appeal_source_type_id']);
        });

        Schema::table('appeals', function (Blueprint $table) {
            $table->dropColumn('appeal_source_type_id');
        });

        Schema::dropIfExists('appeal_source_types');
    }
}
