<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderAndGroupToReportRatiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up(): void
    {
        Schema::table('report_ratios', function (Blueprint $table) {
            $table->string('group')->nullable();
            $table->unsignedInteger('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    final public function down(): void
    {
        Schema::table('report_ratios', function (Blueprint $table) {
            $table->dropColumn('group');
            $table->dropColumn('order');
        });
    }
}
