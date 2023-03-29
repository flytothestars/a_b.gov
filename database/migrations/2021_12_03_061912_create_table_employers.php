<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('bin_iin');
            $table->string('code_no')->nullable();
            $table->integer('count_np')->nullable();
            $table->enum('risk_degree', [
                'low', 'medium', 'high'
            ]);
            $table->date('relevance_date');
            $table->timestamps();

            $table->index(['bin_iin', 'risk_degree']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
