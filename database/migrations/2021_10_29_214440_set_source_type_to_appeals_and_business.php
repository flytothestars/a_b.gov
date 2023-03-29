<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetSourceTypeToAppealsAndBusiness extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            update appeals set source_type_id = appeal_source_type_id;"
        );
        \Illuminate\Support\Facades\DB::statement("
            update businesses set source_type_id = '75f1caf5-63c0-4f6e-9b27-0cbed0e69927' where mio_id is not null;"
        );
        \Illuminate\Support\Facades\DB::statement("
            update businesses set source_type_id = '512548a4-c7bc-4cf7-ac69-ff7e8ed7ee68' where mio_id is null;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
