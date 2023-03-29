<?php


namespace App\Services;

use App\Models\Appeal;
use App\Models\AppealHistory;
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


class LoansExportServices
{

    public function exportHistory(){
        $loans = AppealHistory::select('appeal_id', 'created_at');
        return $loans;
    }

    public static function exportLoansData($filter){
        //SQL Query 
        // $loans = DB::select('SELECT businesses.id, organizations.full_name, businesses.name, organizations.iin, 
        //     (SELECT array_agg(distinct(bc.phone_number)) as phone_number FROM business_contacts bc where bc.business_id = businesses.id),
        //     service_groups.name as category,
        //     source_types.name as source_type,
        //     client_appeal_statuses.name as client_appeal_status,
        //     profiles.last_name,
        //     appeals.*,
        //     profiles.first_name,
        //     appeal_statuses.name as appeal_status,
        //     appeal_qolday_products.comment
        //     FROM appeals 
        //     LEFT JOIN businesses ON businesses.id = appeals.business_id
        //     LEFT JOIN organizations ON organizations.id = businesses.organization_id
        //     LEFT JOIN service_groups ON service_groups.id = appeals.category_id
        //     LEFT JOIN source_types ON source_types.id = appeals.source_type_id
        //     LEFT JOIN client_appeal_statuses ON client_appeal_statuses.id = appeals.client_appeal_status_id
        //     LEFT JOIN profiles ON profiles.user_id = appeals.distributor_id
        //     LEFT JOIN appeal_statuses ON appeal_statuses.id = appeals.appeal_status_id
        //     LEFT JOIN appeal_qolday_products ON appeal_qolday_products.appeal_id = appeals.id
        // ');

    $loans = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
    ->leftJoin('organizations','organizations.id','=','organization_id')
    ->leftJoin('business_contacts','business_contacts.business_id','=','businesses.id')
    ->leftJoin('service_groups','service_groups.id','=','appeals.category_id')
    ->leftJoin('client_appeal_statuses','client_appeal_statuses.id','=','appeals.client_appeal_status_id')
    ->leftJoin('appeal_qolday_products', 'appeal_qolday_products.appeal_id', '=', 'appeals.id')
    ->leftJoin('appeal_statuses','appeal_statuses.id','=','appeals.appeal_status_id')
    ->leftJoin('source_types','source_types.id','=','appeals.source_type_id')
    ->leftJoin('profiles','profiles.user_id','=','appeals.distributor_id')
    ->distinct('appeals.id')
    ->select(
        'appeals.id',
        'businesses.id',
        'businesses.name',
        'organizations.iin',
        'organizations.full_name',
        'business_contacts.phone_number as phone_number',
        'appeals.content',
        'profiles.last_name',
        'profiles.first_name',
        'service_groups.name as category',
        'client_appeal_statuses.name as client_appeal_status',
        'appeal_statuses.name as appeal_status',
        'appeals.createDate',
        'appeals.updated_at',
        'appeal_qolday_products.comment',
    )->whereNotNull('appeals.id');

        //ORM Query
        // $loans = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
        //     ->leftJoin('organizations','organizations.id','=','organization_id')
        //     ->leftJoin('service_groups','service_groups.id','=','appeals.category_id')
        //     ->leftJoin('source_types','source_types.id','=','appeals.source_type_id')
        //     ->leftJoin('client_appeal_statuses','client_appeal_statuses.id','=','appeals.client_appeal_status_id')
        //     ->join('profiles','profiles.user_id','=','appeals.distributor_id')
        //     ->leftJoin('appeal_statuses','appeal_statuses.id','=','appeals.appeal_status_id')
        //     ->leftJoin('appeal_qolday_products', 'appeal_qolday_products.appeal_id', '=', 'appeals.id')
        //     ->distinct('appeals.id')
        //     ->select(
        //     'businesses.id',
        //     'organizations.full_name',
        //     'businesses.name',
        //     'organizations.iin',
        //     'appeals.content',
        //     'service_groups.name as category',
        //     'source_types.name as source_type',
        //     'client_appeal_statuses.name as client_appeal_status',
        //     'appeals.createDate',
        //     'profiles.last_name',
        //     'profiles.first_name',
        //     'appeal_statuses.name as appeal_status',
        //     'appeals.updated_at',
        //     'appeal_qolday_products.comment',
        //     );
            //Filter appeals
            if(isset($filter)){
                if(isset($filter['district_id'])){
                    $loans->where('appeals.district_id','=',$filter['district_id']);
                }
                if(isset($filter['client_appeal_status_id'])){
                    $loans->where('appeals.client_appeal_status_id','=', $filter['client_appeal_status_id']);
                }
                if(isset($filter['category_id'])){
                    $loans->where('appeals.category_id','=', $filter['category_id']);
                }
                if(isset($filter['distributor_id'])){
                    $loans->where('appeals.distributor_id','=', $filter['distributor_id']);
                }
                if(isset($filter['source_type_id'])){
                    $loans->where('appeals.source_type_id','=', $filter['source_type_id']);
                }
                if(isset($filter['start_date'])){
                    $loans->where('appeals.createDate','>', $filter['start_date']);
                }
                if(isset($filter['end_date'])){
                    $loans->where('appeals.createDate','<', $filter['end_date']);
                }
            }
        return $loans->get();
    }

    public static function exportLoansData2($filter):Builder{
        $loans = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->leftJoin('service_groups','service_groups.id','=','appeals.category_id')
            ->leftJoin('client_appeal_statuses','client_appeal_statuses.id','=','appeals.client_appeal_status_id')
            ->leftJoin('appeal_qolday_products', 'appeal_qolday_products.appeal_id', '=', 'appeals.id')
            ->leftJoin('appeal_statuses','appeal_statuses.id','=','appeals.appeal_status_id')
            ->distinct('appeals.id')
            ->select(
                'appeals.id',
                'appeals.mio_id',
                'businesses.name',
                'organizations.iin',
                'appeals.content',
                'service_groups.name as category',
                'client_appeal_statuses.name as client_appeal_status',
                'appeal_statuses.name as appeal_status',
                'appeals.createDate',
                'appeals.updated_at',
                'appeal_qolday_products.comment',
            )->whereNotNull('appeals.id');
        if(count($filter)){
            if(isset($filter['district_id'])){
                $loans->where('appeals.district_id','=',$filter['district_id']);
            }
            if(isset($filter['appeal_status_id'])){
                $loans->where('appeal_statuses.id','=', $filter['appeal_status_id']);
            }
            if(isset($filter['category_id'])){
                $loans->where('appeals.category_id','=', $filter['category_id']);
            }
            if(isset($filter['distributor_id'])){
                $loans->where('appeals.distributor_id','=', $filter['distributor_id']);
            }
            if(isset($filter['source_type_id'])){
                $loans->where('appeals.source_type_id','=', $filter['source_type_id']);
            }
        }
        return $loans;
    }

    public static function exportLoansData3($filter):Builder {
        $loans = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
//            ->leftJoin('business_contacts','business_contacts.business_id','=','appeals.business_id')
            ->leftJoin('profiles','profiles.organization_id','=','organizations.id')
            ->leftJoin('users','users.id','=','profiles.user_id')
            ->distinct('users.phone')
            ->select(
                'appeals.id',
                'appeals.mio_id',
                'users.id as userId',
                'businesses.name',
                'organizations.iin',
                'users.phone as phone_number',
            )->whereNotNull('users.phone')->whereNotNull('organizations.iin');

        if(count($filter)){
            if(isset($filter['district_id'])){
                $loans->where('appeals.district_id','=',$filter['district_id']);
            }
            if(isset($filter['category_id'])){
                $loans->where('appeals.category_id','=', $filter['category_id']);
            }
            if(isset($filter['source_type_id'])){
                $loans->where('appeals.source_type_id','=', $filter['source_type_id']);
            }
        }
        return $loans;
    }
}