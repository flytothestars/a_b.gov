<?php


namespace App\Services;

use App\Models\Appeal;
use App\Models\Business;
use App\Models\Organization;
use App\Models\BusinessContact;
use App\Models\ServiceGroup;
use App\Models\SourceType;
use App\Models\ClientAppealStatus;
use App\Models\Profile;
use App\Models\AppealStatus;
use App\Models\AppealQoldayProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class MioExportServices
{
    public static function exportLoansData(){
        $loans = Appeal::leftJoin('appeal_statuses','appeal_statuses.id','=','appeals.appeal_status_id')
            ->leftJoin('client_appeal_statuses','client_appeal_statuses.id','=','appeals.client_appeal_status_id')  
            ->where('appeal_status_id','=','08992438-a890-4a12-8850-d536f326bd9f')
            ->orWhere('appeal_status_id','=','23dcd77e-6a53-4562-a175-9f35f7696906')
            ->orWhere('appeal_status_id','=','107ad887-047c-405d-916e-3d2e3517a17d')
            ->select(
                'appeals.mio_id',
                'appeals.appeal_status_id',
                'appeals.client_appeal_status_id',
                'appeal_statuses.name as appeal_name',
                'client_appeal_statuses.name as client_name'
            );
        return $loans->get();
    }
}
