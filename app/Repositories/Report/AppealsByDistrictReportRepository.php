<?php

namespace App\Repositories\Report;

use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection as SupportCollation;
use Illuminate\Support\Facades\DB;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;

class AppealsByDistrictReportRepository extends BaseRepository implements IAppealsByDistrictReportRepository
{
    private $statusesToDistr ;
    private $statusesToCateg ;
    private $statusesToCategDistr ;
    private $upi_appeals;
    private $district_curators;

    public function __construct(
    )
    {
        $this->statusesToDistr  = ' SUM (CASE
                WHEN upi_appeals.appeal_status_id = :ExecutorAssigned THEN 1
            ELSE 0
                    END
                ) AS ExecutorAssigned,
            SUM (CASE
                WHEN upi_appeals.appeal_status_id = :CoExecutorAssigned THEN 1
            ELSE 0
                    END
                ) AS CoExecutorAssigned,
            SUM (CASE
                WHEN upi_appeals.appeal_status_id = :OnConfirmDistrictCurator THEN 1
            ELSE 0
                    END
                ) AS OnConfirmDistrictCurator,
            SUM (CASE
                WHEN upi_appeals.appeal_status_id = :DistrictCuratorConfirm THEN 1
            ELSE 0
                    END
                ) AS DistrictCuratorConfirm,
            SUM (CASE
                WHEN upi_appeals.appeal_status_id = :Confirmed THEN 1
            ELSE 0
                    END
                ) AS Confirmed,
            SUM (CASE
                WHEN upi_appeals.appeal_status_id = :Completed THEN 1
            ELSE 0
                    END
                ) AS Completed,
            SUM (CASE
                WHEN upi_appeals.appeal_status_id = :Rejected THEN 1
            ELSE 0
                    END
                ) AS Rejected,
            SUM (CASE
                WHEN upi_appeals.last_coexecutor_id is null and upi_appeals.last_executor_id is null and upi_appeals.appeal_status_id = :DistributorAssigned THEN 1
            ELSE 0
                    END
                ) AS notAssigned ';

        $this->statusesToCateg  = '
            SUM (CASE
                WHEN appeals.appeal_status_id = :Completed THEN 1
            ELSE 0
                    END
                ) AS Completed,
            SUM (CASE
                WHEN appeals.appeal_status_id = :Rejected THEN 1
            ELSE 0
                    END
                ) AS Rejected,
            SUM (CASE
                WHEN appeals.appeal_status_id = :Completed
                         or appeals.appeal_status_id = :Rejected
                    THEN 1
            ELSE 0
                      END
                ) AS All';
        $this->statusesToCategDistr  = '
                SUM (CASE
                    WHEN appeals.appeal_status_id = :Completed and appeals.district_id=:district THEN 1
                ELSE 0
                        END
                    ) AS Completed,
                SUM (CASE
                    WHEN appeals.appeal_status_id = :Rejected and appeals.district_id=:district THEN 1
                ELSE 0
                        END
                    ) AS Rejected,
                SUM (CASE
                    WHEN (appeals.appeal_status_id = :Completed
                             or appeals.appeal_status_id = :Rejected)
                             and appeals.district_id=:district
                        THEN 1
                ELSE 0
                          END
                    ) AS All';


        $this->upi_appeals  = 'upi_appeals as(
            select  appeals.id,appeals.district_id,appeals.appeal_status_id,
                   appeals.last_curator_district_id,appeals.last_executor_id,appeals.last_coexecutor_id,users.name
            from appeals
                left outer join users on users.id=appeals.last_coexecutor_id
            where  appeals."createDate" between  :from and :until
            and appeals.flow_type_id=:Upi
                )';
        $this->district_curators  =' district_curators as (select districts.id,districts.name as name,
            MAX(case when  profiles.position like \'%Зам.акима%\' then profiles.last_name || \'  \' || profiles.first_name || \' \' || profiles.second_name end ) as curator,
            MAX(case when  profiles.position like \'%Соисполнитель%\' then profiles.last_name|| \' \'|| profiles.first_name || \' \'|| profiles.second_name end) as coexecutor
            from department_districts
            left outer join  districts on department_districts.district_id=districts.id
            left outer join  profiles on department_districts.department_id=profiles.department_id
            group by districts.id)';

    }


    public function getStaticsByDistricts(array $attributes): SupportCollation
    {
        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'].' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'].' 23:59:59')
            : '';
        $header=['#','Районы','Зам.аким','Соисполнители','Общее кол-во ','Назначен исполнитель','Назначен соисполнитель','На подтверждении кур. района','Подтверждено кур. района','На подтверждении','Исполнено','Отказано','Не назначено'];

        $all= DB::select('with '.$this->upi_appeals.', '.$this->district_curators.'
        select  row_number() over() as row,district_curators.name as district,district_curators.curator,
            district_curators.coexecutor,
            count(upi_appeals.id) as "all",
            '.$this->statusesToDistr.'
        from upi_appeals
            left join  district_curators on district_curators.id=upi_appeals.district_id
            group by district_curators.name,district_curators.curator,district_curators.coexecutor
        union all
        select null as row,\'Алматы\' as district ,\'ВСЕГО:\' as curator,\'  \' as coexecutors,
             count(upi_appeals.id) as "all",
             '.$this->statusesToDistr.'
        from upi_appeals',[
            'from'=>$dateFrom->format('Y-m-d H:i:s'),
            'until'=>$dateUntil->format('Y-m-d H:i:s'),
            'Upi'=>FlowTypeEnum::Upi,
            'ExecutorAssigned' => AppealStatusEnum::ExecutorAssigned,
            'CoExecutorAssigned'=>AppealStatusEnum::CoExecutorAssigned,
            'OnConfirmDistrictCurator'=>AppealStatusEnum::OnConfirmDistrictCurator,
            'DistrictCuratorConfirm'=>AppealStatusEnum::DistrictCuratorConfirm,
            'DistributorAssigned'=>AppealStatusEnum::DistributorAssigned,
            'Confirmed'=>AppealStatusEnum::Confirmed,
            'Completed'=>AppealStatusEnum::Completed,
            'Rejected'=>AppealStatusEnum::Rejected

        ]);

          $all = array_map(function ($value) {
            return (array)$value;
        }, $all);
       // print"<pre>";die(var_dump(collect($all)->prepend($header)->prepend($header)));
        return collect($all)->prepend($header);

    }

    public function getAllAppealsByStatus(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'].' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'].' 23:59:59')
            : '';

            $header=['№','Категории ','Исполнен','Отказан','ВСЕГО'];


            $all= DB::select('select  row_number() over() as row,service_groups.name,
                '.$this->statusesToCateg.'
            from appeals
                inner join service_groups  ON service_groups.id=appeals.category_id
                    where  appeals."createDate" between  :from and :until
                group by service_groups.name
            union all
                select null as row,\'ОБЩЕЕ КОЛИЧЕСТВО\',
                '.$this->statusesToCateg.'
            from appeals
                where  appeals."createDate" between  :from and :until',[
            'from'=>$dateFrom->format('Y-m-d H:i:s'),
            'until'=>$dateUntil->format('Y-m-d H:i:s'),
            'Completed'=>AppealStatusEnum::Completed,
            'Rejected'=>AppealStatusEnum::Rejected
        ]);

              $all = array_map(function ($value) {
                return (array)$value;
            }, $all);

            return collect($all)->prepend($header)->prepend(['  ','Разбивка категорий районов по статусу ВСЕ РАЙОНЫ - АЛМАТЫ ']);
    }

    public function getDistrictAppealsByStatus(array $attributes,$districtId,$districtName): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'].' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'].' 23:59:59')
            : '';


            $header=['№','Категории ','Исполнен','Отказан','ВСЕГО'];


            $all= DB::select('select  row_number() over() as row,service_groups.name,
                '.$this->statusesToCategDistr.'
            from appeals
                right join    service_groups  ON service_groups.id=appeals.category_id
                where  appeals."createDate" between  :from and :until

            group by service_groups.name

            union all
            select  null as row,\'ОБЩЕЕ КОЛИЧЕСТВО\',
                '.$this->statusesToCategDistr.'
            from appeals
                where  appeals."createDate" between  :from and :until
                ',[
            'from'=>$dateFrom->format('Y-m-d H:i:s'),
            'until'=>$dateUntil->format('Y-m-d H:i:s'),
            'district'=>$districtId,
            'Completed'=>AppealStatusEnum::Completed,
            'Rejected'=>AppealStatusEnum::Rejected
        ]);

            $all = array_map(function ($value) {
                return (array)$value;
            }, $all);

            return collect($all)->prepend($header)->prepend(['  ','Разбивка категорий района по статусам  - '.$districtName]);

    }


}
