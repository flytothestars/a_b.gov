<?php

namespace Database\Seeders;

use App\Models\AppealResultType;
use App\Repositories\Enums\AppealResultTypeEnum;
use Illuminate\Database\Seeder;

class AppealResultPart2TypeSeeder extends Seeder
{
    public function run()
    {
        $statusList = [
            [ 'id' => AppealResultTypeEnum::NotResponsiblePerson, 'name' => 'Лицо не принимающее решения' ],
            [ 'id' => AppealResultTypeEnum::NotNeedsIdentified, 'name' => 'Не выявлено потребностей' ],
        ];

        foreach ($statusList as $status) {
            AppealResultType
                ::query()
                ->updateOrCreate(
                    [ 'id' => $status[ 'id' ] ],
                    [
                        'id'   => $status[ 'id' ],
                        'name' => $status[ 'name' ],
                    ]
                )
            ;
        }
    }
}
