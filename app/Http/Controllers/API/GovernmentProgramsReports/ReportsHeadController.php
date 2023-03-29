<?php

namespace App\Http\Controllers\API\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportsHeaders;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Contracts\GovernmentProgramsReports\IReportTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\DateFilterRequest;
use App\Http\Requests\GovernmentProgramsReports\CreateRequest;
use App\Http\Requests\GovernmentProgramsReports\ImportRequest;
use App\Http\Requests\GovernmentProgramsReports\ReImportRequest;
use App\Http\Requests\GovernmentProgramsReports\ReportRowsRequest;
use App\Http\Resources\GovernmentProgramsReports\ReportsListResource;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentReportHeader;
use App\Repositories\GovernmentProgramsReports\IReportHeadersRepositoryContract;
use App\Services\GovernmentProgramsReports\IGovernmentProgramsImportService;
use Carbon\Carbon;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ReportsHeadController extends Controller
{

    private IReportHeadersRepositoryContract $headersRepository;
    private IGovernmentProgramsImportService $service;

    /**
     * ReportsHeadController constructor.
     *
     * @param IReportHeadersRepositoryContract $repository
     * @param IGovernmentProgramsImportService $service
     */
    public function __construct(
        IReportHeadersRepositoryContract $repository,
        IGovernmentProgramsImportService $service
    )
    {
        $this->headersRepository = $repository;
        $this->service           = $service;
    }

    final public function getReportsList(DateFilterRequest $request): ReportsListResource
    {
        $attributes = $request->validated();

        $date = $attributes[ 'date' ]
                ??
                Carbon
                    ::now()
                    ->format('Y-m-d')
        ;

        $data = $this->headersRepository->getAllReportsByDate($date);

        return new ReportsListResource($data);
    }

    final public function importReport(ImportRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $date = Carbon::createFromFormat('Y-m-d', $attributes[ 'date' ])
                      ->day(1)
                      ->format('Y-m-d')
        ;

        $model = $this->headersRepository->create(
            [
                IReportsHeaders::ImportUserId       => $request->user()->id,
                IReportsHeaders::ReportType         => $attributes[ 'type' ],
                IReportsHeaders::ReportImportStatus => IReportStatuses::New,
                IReportsHeaders::ImportDate         => $date,
                IReportsHeaders::File               => $attributes[ 'file' ],
            ]
        );

        /** @noinspection PhpParamsInspection */
        $this->service->importReport($model);

        return response()->json([ 'status' => 'ok' ]);
    }

    final public function reImportReport(ReImportRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $model      = $this->headersRepository->storeFile($attributes);
        /** @noinspection PhpParamsInspection */
        $this->service->reimportReport($model);

        return response()->json([ 'status' => 'ok' ]);
    }

    final public function getReportRows(ReportRowsRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        return response()->json(
            $this->service->getReportRecordsAndHeaders(
                $attributes[ 'id' ],
                $attributes[ 'filter' ],
            )
        );
    }

    final public function getReportRow(string $report_id, int $id): JsonResponse
    {
        $data = $this->service->getReportRowFields($report_id, $id);

        return response()->json($data);
    }

    final public function updateReportRow(Request $request): JsonResponse
    {
        $data = $this->service->updateReportRow($request->get('report_id'), $request->get('id'), $request->toArray());

        return response()->json($data);
    }

    final public function getReport(string $report_id): JsonResponse
    {
        $data = $this->service->getReport($report_id);

        return response()->json($data);
    }

    final public function createReport(CreateRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $data       = $this->service->makeReport($attributes[ 'type' ], $attributes[ 'date' ]);

        return response()->json($data);
    }

    final public function getCommonReportRatios(string $id): JsonResponse
    {
        $header         = GovernmentReportHeader::find($id);
        $reportContract = IReportTypes::ReportContractList[ $header->report_type ] ?? null;

        $name = trans(IReportTypes::ReportTypesNames[ $header->report_type ]);

        $ratioList = $reportContract::FixedRatios;

        $ratios = [];
        foreach ($ratioList as $ratio) {
            $ratioData = GovernmentReportCommonRatio
                ::where('report_id', $id)
                ->where('report_ratio', $ratio)
                ->first()
            ;

            $ratios[] = [
                'title' => trans($reportContract::ReportFileFieldsNames[ $ratio ]),
                'type'  => $ratio,
                'value' => $ratioData->value ?? 0,
            ];
        }

        return response()->json([ 'name' => $name, 'ratios' => $ratios ]);
    }

    final public function updateCommonReportRatios(string $id, Request $request): JsonResponse
    {
        $header         = GovernmentReportHeader::find($id);
        $reportContract = IReportTypes::ReportContractList[ $header->report_type ] ?? null;

        $ratios = $request->get('ratios');
        $ratioList = $reportContract::FixedRatios;

        foreach ($ratioList as $ratio) {
            if(isset($ratios[$ratio])){
                $ratioData = GovernmentReportCommonRatio
                    ::where('report_id', $id)
                    ->where('report_ratio', $ratio)
                    ->first()
                ;

                if(!$ratioData)
                {
                    $ratioData = new GovernmentReportCommonRatio();
                    $ratioData->report_id = $id;
                    $ratioData->report_ratio = $ratio;
                    $ratioData->id = Uuid::uuid4();
                }

                $ratioData->value = (float) $ratios[$ratio];
                $ratioData->save();
            }
        }

        return response()->json([ 'status' => 'ok' ]);
    }


}
