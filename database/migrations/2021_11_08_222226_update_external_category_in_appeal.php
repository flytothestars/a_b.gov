<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExternalCategoryInAppeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('
            with sg as (
                select service_groups.id, ec.id as ec_id  from service_groups
                                                                   inner join external_categories ec on service_groups.mio_id = ec.id
            )
            update appeals
            set external_category_id = sg.ec_id
            from sg
            where appeals.category_id = sg.id;
        ');
        \Illuminate\Support\Facades\DB::commit();

        $categoryMapList = \App\Models\CategoryMap::query()->get();
        foreach ($categoryMapList as $categoryMap){
            $serviceGroup = \App\Models\ServiceGroup::query()->where('mio_id', $categoryMap->external_category_id)->first();

            if($serviceGroup) {
                \App\Models\Appeal::query()
                    ->where('category_id', $serviceGroup->id)
                    ->update(['category_id' => $categoryMap->service_group_id]);

                try {
                    $serviceGroup->delete();
                } catch (\Exception $e){}
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appeal', function (Blueprint $table) {
            //
        });
    }
}
