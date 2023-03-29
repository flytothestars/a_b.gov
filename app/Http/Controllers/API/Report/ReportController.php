<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\BusinessStatReportRequest;
use App\Http\Requests\Report\IndustryReportRequest;
use App\Http\Requests\Report\InvestmentReportRequest;
use App\Http\Requests\Report\PRTReportRequest;
use App\Http\Requests\Report\TradeReportRequest;
use App\Http\Resources\Report\BusinessStatReportResource;
use App\Http\Resources\Report\IndustryReportResource;
use App\Http\Resources\Report\InvestmentReportResource;
use App\Http\Resources\Report\PRTReportResource;
use App\Http\Resources\Report\TradeReportResource;
use App\Repositories\Report\IReportRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportController extends Controller
{
    public IReportRepository $reportRepository;

    /**
     * ReportController constructor.
     *
     * @param IReportRepository $reportRepository
     */
    public function __construct(IReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }


    final public function investmentReport(InvestmentReportRequest $request): JsonResource
    {
        $attributes = $request->validated();

        $report = $this->reportRepository->getInvestmentsReport($attributes);

        return InvestmentReportResource::collection($report);
    }

    final public function industryReport(IndustryReportRequest $request): JsonResource
    {
        $attributes = $request->validated();

        $report = $this->reportRepository->getIndustryReport($attributes);

        return IndustryReportResource::collection($report);
    }

    final public function tradeReport(TradeReportRequest $request): JsonResource
    {
        $attributes = $request->validated();

        $report = $this->reportRepository->getTradeReport($attributes);

        return new TradeReportResource($report);
    }

    final public function prtReport(PRTReportRequest $request): JsonResource
    {
        $attributes = $request->validated();

        $report = $this->reportRepository->getPrtReport($attributes);

        return PRTReportResource::collection($report);
    }

    final public function businessStatReport(BusinessStatReportRequest $request): JsonResource
    {
        $attributes = $request->validated();

        $report = $this->reportRepository->getBusinessStatReport($attributes);

        return new BusinessStatReportResource($report);
    }
}
