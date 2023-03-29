<?php

use App\Repositories\Enums\Reports\IRatioScopeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScopeToReportRatiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_ratios', function (Blueprint $table) {
            $table->unsignedInteger('scope')->default(IRatioScopeEnum::RATIO_SCOPE_ALL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_ratios', function (Blueprint $table) {
            $table->dropColumn('scope');
        });
    }
}
