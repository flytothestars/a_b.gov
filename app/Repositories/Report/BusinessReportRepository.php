<?php

namespace App\Repositories\Report;

use App\Models\AppealStatus;
use App\Models\WorkingType;
use App\Models\ServiceGroup;
use App\Models\Appeal;
use App\Repositories\BaseRepository;
use App\Repositories\Enums\SourceTypeEnum;
use Carbon\Carbon;
use Illuminate\Support\Collection as SupportCollation;
use Illuminate\Support\Facades\DB;
use App\Repositories\Enums\Dictionaries;

class BusinessReportRepository extends BaseRepository implements IBusinessReportRepository
{

    public function __construct()
    {
    }

    public function getBusinessCnt(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $exsist = DB::select('select \'Всего обращений\' as header,t.bydate,(t.bydate*100)/t.all::decimal as percent from (
            select SUM (CASE
                     WHEN appeals."createDate" between :from and :until THEN 1
                     ELSE 0
                     END
                      ) AS bydate,
                    count(appeals.id) as all
                    from appeals

            ) t
            union all
            select \'Количество бизнесов с обращениями\' as header,t.bydate,(t.bydate*100)/t.all::decimal as percent from (
                        SELECT count(businesses.id) as all,
                            SUM (CASE
                                    WHEN EXISTS
                            (SELECT 1
                            FROM appeals
                            WHERE appeals.business_id = businesses.id
                            and appeals."createDate" between :from and :until) THEN 1
                                    ELSE 0
                                    END
                                    )AS bydate
                        FROM businesses ) t
            union all
            select \'Количество бизнесов без обращений\' as header,t.bydate,(t.bydate*100)/t.all::decimal as percent from (
                        SELECT count(businesses.id) as all,
                            SUM (CASE
                                    WHEN Not EXISTS
                            (SELECT 1
                            FROM appeals
                            WHERE appeals.business_id = businesses.id
                            and appeals."createDate" between :from and :until) THEN 1
                                    ELSE 0
                                    END
                                    )AS bydate
                        FROM businesses ) t', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);


        $exsist = array_map(function ($value) {
            return (array)$value;
        }, $exsist);


        $result = ['Таблица 1', 'Кол-во', 'Доли'];


        // print"<pre>";die(var_dump($result));
        return collect($exsist)->prepend($result);
    }

    public function getBusinessCntExt(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $exsist = DB::select('
        select \'Количество субъектов бизнеса\' as header, count(t.id) as all_data, null as upi, null as qolday  FROM businesses t
            union all
        select \'Количество субъектов без потребностей\' as header, t.all_data, 0 , 0 from (
                    SELECT
                        SUM (CASE
                                WHEN Not EXISTS
                        (SELECT 1
                        FROM appeals
                        WHERE appeals.business_id = businesses.id
                        and appeals."createDate" between :from and :until) THEN 1
                                ELSE 0
                                END
                                ) AS all_data
                    FROM businesses ) t
            union all
         select \'Количество субъектов с потребностями\' as header,t.all_data, 0 , 0 from (
                        SELECT
                            SUM (CASE
                                    WHEN EXISTS
                            (SELECT 1
                            FROM appeals
                            WHERE appeals.business_id = businesses.id
                            and appeals."createDate" between :from and :until) THEN 1
                                    ELSE 0
                                    END
                                    ) AS all_data
                        FROM businesses ) t
            
             union all
            select \'Общее количество потребностей\' as header, t.all_data, t.upi, t.qolday from (
                            select
                                   SUM (CASE
                                     WHEN appeals.flow_type_id = \'5aeff8a2-aa51-49bf-9c4a-2b5db2977e9b\' THEN 1
                                     ELSE 0
                                     END
                                      ) AS upi,
                                   SUM (CASE
                                     WHEN appeals.flow_type_id = \'34971c0d-0dfe-4e50-a2b3-0842c74ac9ac\'  or appeals.flow_type_id is null THEN 1
                                     ELSE 0
                                     END
                                      ) AS qolday,
                                    count(appeals.id) AS all_data
                                    from appeals
                            where appeals."createDate" between :from and :until
                            ) t', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);


        $exsist = array_map(function ($value) {
            return (array)$value;
        }, $exsist);


        $result = ['Таблица 1', 'Кол-во', 'Доли'];


        // print"<pre>";die(var_dump($result));
        return collect($exsist)->prepend($result);
    }

    public function getBusinessByDistrict(array $attributes): SupportCollation
    {
        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';
        $header[] = 'Таблица 2';
        $header[] = 'Всего';

        $dict_list = Dictionaries::Districts;

        foreach ($dict_list as $dict) {
            if ($dict['name'] != 'Вне города') {
                $caseToAppelas[] = 'SUM (CASE
            WHEN appeals.district_id = \'' . $dict['id'] . '\' THEN 1
                   ELSE 0
                  END
            ) AS "' . $dict['name'] . '"';
                $caseToBusiness[] = 'SUM (CASE
            WHEN businesses.district_id = \'' . $dict['id'] . '\' THEN 1
                   ELSE 0
                  END
            ) AS "' . $dict['name'] . '"';
            } else {
                $caseToAppelas[] = 'SUM (CASE
            WHEN appeals.district_id = \'' . $dict['id'] . '\' or appeals.district_id is null THEN 1
                   ELSE 0
                  END
            ) AS "' . $dict['name'] . '"';
                $caseToBusiness[] = 'SUM (CASE
            WHEN businesses.district_id = \'' . $dict['id'] . '\' or businesses.district_id is null  THEN 1
                   ELSE 0
                  END
            ) AS "' . $dict['name'] . '"';
            }
            $header[] = $dict['name'];
        }

        $all = DB::select('select t.* from (
        select  \'Количество потребностей\' as header,4 as ordr,
        count(appeals.id) as "all",' .
            implode(',', $caseToAppelas)
            . 'from appeals

        where  appeals."createDate" between :from and :until
        union all
        select  \'Количество субъектов с потребностями\' as header,3 as ordr,
        count(businesses.id) as "all",' .
            implode(',', $caseToBusiness)
            . '
        from businesses
        where EXISTS
            (SELECT 1
            FROM appeals a
            WHERE a.business_id = businesses.id
            and a."createDate" between :from and :until)
        union all
         
            select  \'Количество субъектов без потребностей\' as header,2 as ordr,
            count(businesses.id) as "all",' .
            implode(',', $caseToBusiness)
            . '
        from businesses
        where not EXISTS
                (SELECT 1
                FROM appeals a
                WHERE a.business_id = businesses.id
                and a."createDate" between :from and :until)
        union all
        select \'Количество субъектов бизнеса\' as header, 1 as ordr,
        count(businesses.id) as "all",' .
            implode(',', $caseToBusiness)
            . '
         from businesses) t order by t.ordr ', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);
        // print "<pre>";
        // die(var_dump($all));
        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getBusinessByIndustry(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 3';
        $header[] = 'Всего';

        $dict_list = Dictionaries::ActivityTypes;

        foreach ($dict_list as $dict) {
            $caseToActivity[] = 'SUM (CASE
                WHEN businesses.root = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }
        $caseToActivity[] = 'SUM (CASE
                WHEN businesses.root is null THEN 1
                       ELSE 0
                      END
                ) AS "Другое"';
        $header[] = 'Другое';

        $all = DB::select('with activity_dict as(
                WITH RECURSIVE r AS (
                  SELECT id, parent_id, name, 1 AS level, id as root
                  FROM activity_types
                  WHERE parent_id is null
                  UNION ALL
                  SELECT activity_types.id, activity_types.parent_id, activity_types.name, r.level + 1 AS level, r.root
                  FROM activity_types
                    JOIN r ON activity_types.parent_id = r.id
                )

                SELECT id, parent_id, name, level,
                        root
                FROM r
                ),
                allBusinesses as (
                            select DISTINCT ON (businesses.id)
                            businesses.id,
                            activity_dict.root
            from businesses
            left join business_activity_types  on businesses.id = business_activity_types.business_id
            left join  activity_dict  ON activity_dict.id=business_activity_types.activity_type_id
                )

            select \'Количество бизнесов с обращениями\' as header,
                count(businesses.id) as "all",
                    ' .
            implode(',', $caseToActivity)
            . '
            from allBusinesses as businesses
            where EXISTS
                (SELECT 1
                FROM appeals a
                WHERE a.business_id = businesses.id
                and a."createDate" between :from and :until)
            union all
            select \'Количество бизнесов без обращений\' as header,
                count(businesses.id) as "all",
                    ' .
            implode(',', $caseToActivity)
            . '
            from allBusinesses as businesses
            where not EXISTS
                (SELECT 1
                FROM appeals a
                WHERE a.business_id = businesses.id
                and a."createDate" between :from and :until)', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getBusinessByCatIndustry(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 4';
        $header[] = 'Всего';

        $dict_list = Dictionaries::ActivityTypes;

        foreach ($dict_list as $dict) {
            $caseToActivity[] = 'SUM (CASE
                WHEN allAppeals.root = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }
        $caseToActivity[] = 'SUM (CASE
                WHEN allAppeals.root is null THEN 1
                       ELSE 0
                      END
                ) AS "Другое"';
        $header[] = 'Другое';

        $all = DB::select('with activity_dict as(
                WITH RECURSIVE r AS (
                  SELECT id, parent_id, name, 1 AS level, id as root
                  FROM activity_types
                  WHERE parent_id is null
                  UNION ALL
                  SELECT activity_types.id, activity_types.parent_id, activity_types.name, r.level + 1 AS level, r.root
                  FROM activity_types
                    JOIN r ON activity_types.parent_id = r.id
                )

                SELECT id, parent_id, name, level,
                        root
                FROM r
                ),
                allBusinesses as (
                    select DISTINCT ON (businesses.id)
                    businesses.id,
                    activity_dict.root
                    from businesses
                    left join business_activity_types  on businesses.id = business_activity_types.business_id
                    left join  activity_dict  ON activity_dict.id=business_activity_types.activity_type_id
                )
                ,allAppeals as (
                    select appeals.id,appeals.category_id,appeals.business_id, allBusinesses.root
                    from appeals
                        left join allBusinesses on appeals.business_id = allBusinesses.id
                    where  appeals."createDate" between :from and :until)
            select  service_groups.name,
                count(allAppeals.id) as "all",
                ' .
            implode(',', $caseToActivity)
            . '
            from allAppeals
            inner join   service_groups  ON service_groups.id=allAppeals.category_id
            group by service_groups.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getAppealsByWorkingType(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 4';
        $header[] = 'Всего';

        $dict_list = WorkingType::all();

        foreach ($dict_list as $dict) {
            $caseToActivity[] = 'SUM (CASE
                WHEN allAppeals.working_type_id = \'' . $dict->id . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict->name . '"';
            $header[] = $dict->name;
        }


        $all = DB::select('with 
                allBusinesses as (
                    select DISTINCT ON (businesses.id)
                    businesses.id,
                    working_type_maps.working_type_id
                    from businesses
                    left join business_activity_types  on businesses.id = business_activity_types.business_id
                    left join working_type_maps on working_type_maps.activity_type_id = business_activity_types.activity_type_id
                )
                ,allAppeals as (
                    select appeals.id,appeals.category_id,appeals.business_id, allBusinesses.working_type_id
                    from appeals
                    left join allBusinesses on appeals.business_id = allBusinesses.id
                    where  appeals."createDate" between :from and :until)
            select  service_groups.name,
                count(allAppeals.id) as "all",
                ' .
            implode(',', $caseToActivity)
            . '
            from allAppeals
            inner join   service_groups  ON service_groups.id=allAppeals.category_id
            group by service_groups.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getBusinessByCatDistrict(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 5';
        $header[] = 'Всего';

        $dict_list = Dictionaries::Districts;

        foreach ($dict_list as $dict) {
            if ($dict['name'] != 'Вне города') {
                $caseToDistrict[] = 'SUM (CASE
                WHEN businesses.district_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            } else {
                $caseToDistrict[] = 'SUM (CASE
                WHEN businesses.district_id = \'' . $dict['id'] . '\' or businesses.district_id is null THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            }
            $header[] = $dict['name'];
        }

        $all = DB::select('select  service_groups.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToDistrict)
            . '
            from appeals
            inner join   service_groups  ON service_groups.id=appeals.category_id
            left join businesses on appeals.business_id = businesses.id
            where  appeals."createDate" between  :from and :until
            group by service_groups.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getAppealsByCatStatus(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 6';
        $header[] = 'Всего';

        $dict_list = AppealStatus::all();

        foreach ($dict_list as $dict) {
            $caseToAppealsStatus[] = 'SUM (CASE
                WHEN appeals.appeal_status_id = \'' . $dict->id . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict->name . '"';
            $header[] = $dict->name;
        }

        $all = DB::select('select  service_groups.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsStatus)
            . '
            from appeals
            inner join   service_groups  ON service_groups.id=appeals.category_id
            where  appeals."createDate" between :from and :until
            group by service_groups.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getAppealsByCategory(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 19';
        $header[] = 'Всего';

        $dict_list = ServiceGroup::all();

        foreach ($dict_list as $dict) {
            $caseToAppealsStatus[] = 'SUM (CASE
                WHEN appeals.category_id = \'' . $dict->id . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict->name . '"';
            $header[] = $dict->name;
        }

        $all = DB::select(
            'select t.* from( select \'Потребности субъектов, выявленные при обходе\' as header,1 as ordr,
            count(appeals.id) as "all",
            ' .
                implode(',', $caseToAppealsStatus)
                . '
            from appeals
            where  appeals."createDate" between :from and :until and appeals.source_type_id=:MIO
            union all
            select \'Потребности полученные от субъектов через портал\' as header,2 as ordr,
            count(appeals.id) as "all",
            ' .
                implode(',', $caseToAppealsStatus)
                . '
            from appeals
            where  appeals."createDate" between :from and :until and appeals.source_type_id=:Portal
            union all
            select \'Потребности полученные от субъектов через колл-центр\' as header,3 as ordr,
            count(appeals.id) as "all",
            ' .
                implode(',', $caseToAppealsStatus)
                . '
            from appeals
            where  appeals."createDate" between :from and :until and appeals.source_type_id=:CALL_CENTER
            union all
            select \'Общее количество потребностей\' as header,4 as ordr,
            count(appeals.id) as "all",
            ' .
                implode(',', $caseToAppealsStatus)
                . '
            from appeals
            where  appeals."createDate" between :from and :until) t order by t.ordr
            
            ',
            [
                'from' => $dateFrom->format('Y-m-d H:i:s'),
                'until' => $dateUntil->format('Y-m-d H:i:s'),
                'MIO' => SourceTypeEnum::MIO,
                'Portal' => SourceTypeEnum::Portal,
                'CALL_CENTER' => SourceTypeEnum::CALL_CENTER
            ]
        );

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }


    public function getAppelsByCatResult(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 7';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealResultTypes;

        foreach ($dict_list as $dict) {
            $caseToAppealsResult[] = 'SUM (CASE
                WHEN appeals.appeal_result_type_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  service_groups.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsResult)
            . '
            from appeals
            inner join   service_groups  ON service_groups.id=appeals.category_id
            where  appeals."createDate" between :from and :until
            group by service_groups.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByDistrStatus(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $header[] = 'Таблица 8';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealStatuses;

        foreach ($dict_list as $dict) {
            $caseToAppealsStatus[] = 'SUM (CASE
                WHEN appeals.appeal_status_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsStatus)
            . '
            from appeals
            inner join   users  ON users.id=appeals.distributor_id
            where  appeals."createDate" between :from and :until
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByDistrResult(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $header[] = 'Таблица 9';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealResultTypes;

        foreach ($dict_list as $dict) {
            $caseToAppealsResult[] = 'SUM (CASE
                WHEN appeals.appeal_result_type_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select(
            'select  users.name,
            count(appeals.id) as "all",
            ' .
                implode(',', $caseToAppealsResult)
                . "
            from appeals
            inner join   users  ON users.id=appeals.distributor_id
            where  appeals.\"createDate\" between :from and :until
            and appeals.appeal_status_id in ('21cbcd3d-b6b4-48f4-abbf-4929dde31706','f9840d9f-d405-4c17-9789-8d34b082ad06')
            group by users.name",
            [
                'from' => $dateFrom->format('Y-m-d H:i:s'),
                'until' => $dateUntil->format('Y-m-d H:i:s'),
            ]
        );

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByExecutorStatus(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $header[] = 'Таблица 12';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealStatuses;

        foreach ($dict_list as $dict) {
            $caseToAppealsStatus[] = 'SUM (CASE
                WHEN appeals.appeal_status_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsStatus)
            . '
            from appeals
            inner join   users  ON users.id=appeals.last_executor_id
            where  appeals."createDate" between :from and :until
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByExecutorResult(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $header[] = 'Таблица 13';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealResultTypes;

        foreach ($dict_list as $dict) {
            $caseToAppealsResult[] = 'SUM (CASE
                WHEN appeals.appeal_result_type_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsResult)
            . '
            from appeals
            inner join   users  ON users.id=appeals.last_executor_id
            where  appeals."createDate" between :from and :until
            and appeals.appeal_status_id in (\'21cbcd3d-b6b4-48f4-abbf-4929dde31706\',\'f9840d9f-d405-4c17-9789-8d34b082ad06\')
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByCuratorStatus(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 10';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealStatuses;

        foreach ($dict_list as $dict) {
            $caseToAppealsStatus[] = 'SUM (CASE
                WHEN appeals.appeal_status_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsStatus)
            . '
            from appeals
            inner join   users  ON users.id=appeals.last_curator_upi_id
            where  appeals."createDate" between :from and :until
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByCuratorResult(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';


        $header[] = 'Таблица 11';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealResultTypes;

        foreach ($dict_list as $dict) {
            $caseToAppealsResult[] = 'SUM (CASE
                WHEN appeals.appeal_result_type_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsResult)
            . '
            from appeals
            inner join   users  ON users.id=appeals.last_curator_upi_id
            where  appeals."createDate" between :from and :until
            and appeals.appeal_status_id in (\'21cbcd3d-b6b4-48f4-abbf-4929dde31706\',\'f9840d9f-d405-4c17-9789-8d34b082ad06\')
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByCoExecStatus(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';
        $header[] = 'Таблица 14';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealStatuses;

        foreach ($dict_list as $dict) {
            $caseToAppealsStatus[] = 'SUM (CASE
                WHEN appeals.appeal_status_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsStatus)
            . '
            from appeals
            inner join   users  ON users.id=appeals.last_coexecutor_id
            where  appeals."createDate" between :from and :until
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getByCoExecResult(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';
        $header[] = 'Таблица 15';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealResultTypes;

        foreach ($dict_list as $dict) {
            $caseToAppealsResult[] = 'SUM (CASE
                WHEN appeals.appeal_result_type_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select('select  users.name,
            count(appeals.id) as "all",
            ' .
            implode(',', $caseToAppealsResult)
            . '
            from appeals
            inner join   users  ON users.id=appeals.last_coexecutor_id
            where  appeals."createDate" between :from and :until
            and appeals.appeal_status_id in (\'21cbcd3d-b6b4-48f4-abbf-4929dde31706\',\'f9840d9f-d405-4c17-9789-8d34b082ad06\')
            group by users.name', ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]);

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getMioBusiness(array $attributes): SupportCollation
    {
        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';
        $header[] = 'Таблица 16';
        $header[] = 'Всего';

        $dict_list = Dictionaries::Districts;

        foreach ($dict_list as $dict) {
            $caseToDistrict[] = 'SUM (CASE
                WHEN businesses.district_id = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }

        $all = DB::select(
            'select  \'Количество созданных бизнесов консультантами Колдау\' as header,
            count(businesses.id) as "all",
               ' .
                implode(',', $caseToDistrict)
                . '
            from businesses
                where EXISTS
                (SELECT 1
                FROM appeals
                WHERE appeals.business_id = businesses.id
                and appeals."createDate" between :from and :until
                and appeals.source_type_id=:source_type)',
            [
                'from' => $dateFrom->format('Y-m-d H:i:s'),
                'until' => $dateUntil->format('Y-m-d H:i:s'),
                'source_type' => SourceTypeEnum::MIO
            ]
        );

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getMioBusinessIndustry(array $attributes): SupportCollation
    {
        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 17';
        $header[] = 'Всего';

        $dict_list = Dictionaries::ActivityTypes;

        foreach ($dict_list as $dict) {
            $caseToActivity[] = 'SUM (CASE
                WHEN businesses.root = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }
        $caseToActivity[] = 'SUM (CASE
                WHEN businesses.root is null THEN 1
                       ELSE 0
                      END
                ) AS "Другое"';
        $header[] = 'Другое';

        $all = DB::select(
            'with activity_dict as(
                WITH RECURSIVE r AS (
                  SELECT id, parent_id, name, 1 AS level, id as root
                  FROM activity_types
                  WHERE parent_id is null
                  UNION ALL
                  SELECT activity_types.id, activity_types.parent_id, activity_types.name, r.level + 1 AS level, r.root
                  FROM activity_types
                    JOIN r ON activity_types.parent_id = r.id
                )

                SELECT id, parent_id, name, level,
                        root
                FROM r
                ),
                allBusinesses as (
                            select DISTINCT ON (businesses.id)
                            businesses.id,
                            activity_dict.root
            from businesses
            left join business_activity_types  on businesses.id = business_activity_types.business_id
            left join  activity_dict  ON activity_dict.id=business_activity_types.activity_type_id
                )
            select   \'Количество созданных бизнесов консультантами Колдау\' as header,
            count(businesses.id) as "all",
           ' .
                implode(',', $caseToActivity)
                . '
            from allBusinesses as businesses
            where EXISTS
                (SELECT 1
                FROM appeals
                WHERE appeals.business_id = businesses.id
                and appeals."createDate" between :from and :until
                and appeals.source_type_id=:source_type)',
            [
                'from' => $dateFrom->format('Y-m-d H:i:s'),
                'until' => $dateUntil->format('Y-m-d H:i:s'),
                'source_type' => SourceTypeEnum::MIO
            ]
        );

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getBusinessByCategory(array $attributes): SupportCollation
    {

        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';

        $header[] = 'Таблица 3';
        $header[] = 'Всего';

        $dict_list = Dictionaries::AppealResultCategory;

        foreach ($dict_list as $dict) {
            $caseToActivity[] = 'SUM (CASE
                WHEN businesses.root = \'' . $dict['id'] . '\' THEN 1
                       ELSE 0
                      END
                ) AS "' . $dict['name'] . '"';
            $header[] = $dict['name'];
        }
        $caseToActivity[] = 'SUM (CASE
                WHEN businesses.root is null THEN 1
                       ELSE 0
                      END
                ) AS "Другое"';
        $header[] = 'Другое';

        $all = DB::select(
            'with activity_dict as(
                WITH RECURSIVE r AS (
                  SELECT id, parent_id, name, 1 AS level, id as root
                  FROM activity_types
                  WHERE parent_id is null
                  UNION ALL
                  SELECT activity_types.id, activity_types.parent_id, activity_types.name, r.level + 1 AS level, r.root
                  FROM activity_types
                    JOIN r ON activity_types.parent_id = r.id
                )

                SELECT id, parent_id, name, level,
                        root
                FROM r
                ),
                allBusinesses as (
                            select DISTINCT ON (businesses.id)
                            businesses.id,
                            activity_dict.root
            from businesses
            left join business_activity_types  on businesses.id = business_activity_types.business_id
            left join  activity_dict  ON activity_dict.id=business_activity_types.activity_type_id
                )

            select \'Количество бизнесов с обращениями\' as header,
                count(businesses.id) as "all",
                    ' .
                implode(',', $caseToActivity)
                . '
            from allBusinesses as businesses
            where EXISTS
                (SELECT 1
                FROM appeals a
                WHERE a.business_id = businesses.id
                and a."createDate" between :from and :until)
            union all
            select \'Количество бизнесов без обращений\' as header,
                count(businesses.id) as "all",
                    ' .
                implode(',', $caseToActivity)
                . '
            from allBusinesses as businesses
            where not EXISTS
                (SELECT 1
                FROM appeals a
                WHERE a.business_id = businesses.id
                and a."createDate" between :from and :until)',
            ['from' => $dateFrom->format('Y-m-d H:i:s'), 'until' => $dateUntil->format('Y-m-d H:i:s')]
        );

        $all = array_map(function ($value) {
            return (array)$value;
        }, $all);

        return collect($all)->prepend($header);
    }

    public function getAppealsReport(array $attributes): SupportCollation
    {
        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';
        $allBusinesses =  DB::table('businesses')
            ->select(DB::raw('DISTINCT ON (businesses.id) businesses.id'), 'working_type_maps.working_type_id')
            ->leftJoin('business_activity_types', 'businesses.id', '=', 'business_activity_types.business_id')
            ->leftJoin('working_type_maps', 'working_type_maps.activity_type_id', '=', 'business_activity_types.activity_type_id');
        $data1 = DB::table('appeals')
            ->leftJoinSub($allBusinesses, 'allBusinesses', function ($join) {
                $join->on('appeals.business_id', '=', 'allBusinesses.id');
            })
            ->leftJoin('districts', 'appeals.district_id', '=', 'districts.id')
            ->leftJoin('service_groups', 'appeals.category_id', '=', 'service_groups.id')
            ->leftJoin('source_types', 'appeals.source_type_id', '=', 'source_types.id')
            ->leftJoin('flow_types', 'appeals.flow_type_id', '=', 'flow_types.id')
            ->select(
                'allBusinesses.working_type_id as industry',
                'districts.name as district',
                'service_groups.name as category',
                'source_types.name as appeal_type',
                DB::raw('coalesce(flow_types.name,\'Qoldau\') as type'),
                DB::raw('1 as business_name')
            )
            ->whereBetween('appeals.createDate', [$dateFrom, $dateUntil])
            ->get();
        return $data1;

        /* $data =  Appeal::query()

            ->leftJoin('districts', 'appeals.district_id', '=', 'districts.id')
            ->leftJoin('service_groups', 'appeals.category_id', '=', 'service_groups.id')
            ->leftJoin('source_types', 'appeals.source_type_id', '=', 'source_types.id')
            ->leftJoin('flow_types', 'appeals.flow_type_id', '=', 'flow_types.id')
            ->select(
                'districts.name as district',
                'service_groups.name as category',
                'source_types.name as appeal_type',
                DB::raw('coalesce(flow_types.name,\'Qoldau\') as type'),
                DB::raw('1 as business_name'),
                DB::raw('\'Другое\' as industry')
            )
            ->whereBetween('createDate', [$dateFrom, $dateUntil])
            ->get();*/
    }

    public function getTotalStatisticsByDistricts(array $attributes): SupportCollation
    {
        $dateFrom = isset($attributes['startDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['startDate'] . ' 00:00:00')
            : '';
        $dateUntil = isset($attributes['endDate'])
            ? Carbon::createFromFormat('Y-m-d H:i:s', $attributes['endDate'] . ' 23:59:59')
            : '';
        $first = DB::table('businesses')
            ->select(
                'districts.name as district_name',
                DB::raw('count(businesses.id) AS value'),
                DB::raw('count(businesses.id) AS value_with_needs'),
                DB::raw('0 AS value_without_needs'),
                DB::raw('\'Количество субъектов с потребностями\' as name')
            )
            ->leftJoin('districts', 'businesses.district_id', '=', 'districts.id')
            ->whereExists(function ($query) use ($dateFrom, $dateUntil) {
                $query->select(DB::raw(1))
                    ->from('appeals')
                    ->whereColumn('appeals.business_id', 'businesses.id')
                    ->whereBetween('appeals.createDate', [$dateFrom, $dateUntil]);
            })
            ->groupBy('districts.name');
        $total_statistics_by_districts = DB::table('businesses')
            ->select(
                'districts.name as district_name',
                DB::raw('count(businesses.id) AS value'),
                DB::raw('0 AS value_with_needs'),
                DB::raw('count(businesses.id) AS value_without_needs'),
                DB::raw('\'Количество субъектов без потребностями\' as name')
            )
            ->leftJoin('districts', 'businesses.district_id', '=', 'districts.id')
            ->whereNotExists(function ($query) use ($dateFrom, $dateUntil) {
                $query->select(DB::raw(1))
                    ->from('appeals')
                    ->whereColumn('appeals.business_id', 'businesses.id')
                    ->whereBetween('appeals.createDate', [$dateFrom, $dateUntil]);
            })
            ->groupBy('districts.name')
            ->union($first)
            ->get();
        return $total_statistics_by_districts;
        // print "<pre>";
        // die(var_dump($total_statistics_by_districts));
    }
}
