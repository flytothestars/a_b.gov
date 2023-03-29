<?php

namespace App\Repositories\Report;

use App\Repositories\IRepository;
use Illuminate\Support\Collection as SupportCollation;

interface IBusinessReportRepository extends IRepository
{

    public function getBusinessCnt(array $attributes): SupportCollation;
    public function getBusinessByDistrict(array $attributes): SupportCollation;
    public function getBusinessByIndustry(array $attributes): SupportCollation;
    public function getBusinessByCatIndustry(array $attributes): SupportCollation;
    public function getBusinessByCategory(array $attributes): SupportCollation;
    public function getBusinessByCatDistrict(array $attributes): SupportCollation;
    public function getAppealsByCatStatus(array $attributes): SupportCollation;
    public function getAppealsByCategory(array $attributes): SupportCollation;
    public function getAppelsByCatResult(array $attributes): SupportCollation;
    public function getByExecutorStatus(array $attributes): SupportCollation;
    public function getByExecutorResult(array $attributes): SupportCollation;
    public function getByCuratorResult(array $attributes): SupportCollation;
    public function getByCoExecStatus(array $attributes): SupportCollation;
    public function getByCoExecResult(array $attributes): SupportCollation;
    public function getByDistrStatus(array $attributes): SupportCollation;
    public function getByDistrResult(array $attributes): SupportCollation;
    public function getMioBusiness(array $attributes): SupportCollation;
    public function getMioBusinessIndustry(array $attributes): SupportCollation;
    public function getBusinessCntExt(array $attributes): SupportCollation;
    public function getAppealsReport(array $attributes): SupportCollation;
    public function getTotalStatisticsByDistricts(array $attributes): SupportCollation;
}
