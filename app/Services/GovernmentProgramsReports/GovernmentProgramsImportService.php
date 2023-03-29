<?php

namespace App\Services\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportQolday;
use App\Contracts\GovernmentProgramsReports\IReportsHeaders;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Contracts\GovernmentProgramsReports\IReportTypes;
use App\Exceptions\Handler;
use App\Models\Report\GovernmentProgram\GovernmentGuaranteeReport;
use App\Models\Report\GovernmentProgram\GovernmentQoldayReport;
use App\Models\Report\GovernmentProgram\GovernmentReportHeader;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class GovernmentProgramsImportService implements IGovernmentProgramsImportService
{
    final public function importReport(GovernmentReportHeader $entity): GovernmentReportHeader
    {
        $fileModel = $entity->files()
                            ->first()
        ;

        if (!$fileModel) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.load-file');
            $entity->save();
            return $entity;
        }

        $fileExists = Storage
            ::disk('public')
            ->exists($fileModel->path)
        ;

        if (!$fileExists) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.load-file');
            $entity->save();
            return $entity;
        }

        $importClassName = IReportTypes::ReportImportsList[ $entity->report_type ] ?? null;

        $import = new $importClassName($entity->id);
        try {
            Excel::import($import, $fileModel->path, 'public');
        } catch (Exception $exception) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.invalid-file');
            $entity->save();
            app(Handler::class)->report($exception);
            return $entity;
        }

        $data = collect($import->getData());

        if (!$data->count()) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.empty-file');
            $entity->save();
            return $entity;
        }

        $entity->status = IReportStatuses::ImportStarted;
        $entity->save();

        $repositoryContract = IReportTypes::ReportRepositoryList[ $entity->report_type ] ?? null;
        $repository         = app($repositoryContract);

        $response = $repository->validateReportRecords($data);

        if (count($response[ 'invalid' ])) {
            $entity->status            = IReportStatuses::ImportFailed;
            $entity->last_fail_comment = trans('messages.reports.fails.invalid-records');
            $entity->save();
        } else {
            $entity->status            = IReportStatuses::Finished;
            $entity->last_fail_comment = trans('messages.reports.fails.ok-file');
            $entity->save();
        }

        return $entity;
    }

    final public function reImportReport(GovernmentReportHeader $entity): GovernmentReportHeader
    {
        $fileModel = $entity->files()
                            ->first()
        ;

        if (!$fileModel) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.load-file');
            $entity->save();
            return $entity;
        }

        $fileExists = Storage
            ::disk('public')
            ->exists($fileModel->path)
        ;

        if (!$fileExists) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.load-file');
            $entity->save();
            return $entity;
        }

        $repositoryContract = IReportTypes::ReportRepositoryList[ $entity->report_type ] ?? null;
        $repository         = app($repositoryContract);
        $repository->deleteByParent($entity->id);

        $importClassName = IReportTypes::ReportImportsList[ $entity->report_type ] ?? null;

        $import = new $importClassName($entity->id);
        try {
            Excel::import($import, $fileModel->path, 'public');
        } catch (Exception $exception) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.invalid-file');
            $entity->save();
            app(Handler::class)->report($exception);
            return $entity;
        }

        $data = collect($import->getData());

        if (!$data->count()) {
            $entity->status            = IReportStatuses::InvalidFile;
            $entity->last_fail_comment = trans('messages.reports.fails.empty-file');
            $entity->save();
            return $entity;
        }

        $entity->status = IReportStatuses::ImportStarted;
        $entity->save();

        $repositoryContract = IReportTypes::ReportRepositoryList[ $entity->report_type ] ?? null;
        $repository         = app($repositoryContract);

        $response = $repository->validateReportRecords($data);

        if (count($response[ 'invalid' ])) {
            $entity->status            = IReportStatuses::ImportFailed;
            $entity->last_fail_comment = trans('messages.reports.fails.invalid-records');
            $entity->save();
        } else {
            $entity->status            = IReportStatuses::Finished;
            $entity->last_fail_comment = trans('messages.reports.fails.ok-file');
            $entity->save();
        }

        return $entity;
    }


    final public function getReportRecordsAndHeaders(string $id, string $filter = 'failed'): array
    {
        $header = GovernmentReportHeader::find($id);

        $repositoryContract = IReportTypes::ReportRepositoryList[ $header->report_type ] ?? null;

        if ($repositoryContract) {
            $name = trans(IReportTypes::ReportTypesNames[ $header->report_type ]);
            $repository = app($repositoryContract);
            $rows       = $filter === 'failed'
                ? $repository->getReportRecordsFailed($id)
                : $repository->getReportRecordsProcessed($id);
            return [
                'headers' => $repository->getReportHeaders(),
                'name'    => $name,
                'rows'    => $rows,
            ];
        }

        return [
            'headers' => [],
            'rows'    => [],
            'name'    => '',
        ];
    }

    final public function getReportRowFields(string $parentId, int $id): array
    {
        $header             = GovernmentReportHeader::find($parentId);
        $repositoryContract = IReportTypes::ReportRepositoryList[ $header->report_type ] ?? null;

        if ($repositoryContract) {
            $repository = app($repositoryContract);
            $row        = $repository->getReportRowData($id);
            $response   = [
                'fields' => $repository->getReportRowFields(),
                'data'   => $row,
                'fails'  => [],
            ];
            $validator  = $repository->makeReportRecordValidator($row);

            if ($validator->fails()) {
                $response[ 'fails' ] = $validator->errors()
                                                 ->getMessages()
                ;
            }

            return $response;
        }

        return [
            'fields' => [],
            'data'   => [],
            'fails'  => [],
        ];
    }

    final public function updateReportRow(string $parentId, int $id, array $data): array
    {
        $header             = GovernmentReportHeader::find($parentId);
        $repositoryContract = IReportTypes::ReportRepositoryList[ $header->report_type ] ?? null;

        if ($repositoryContract) {
            $repository = app($repositoryContract);
            $entity     = $repository->updateReportRow($data);
            $repository->validateReportRecord($entity);
            if (!$repository->hasFailedRecords($parentId)) {
                $header->status            = IReportStatuses::Finished;
                $header->last_fail_comment = null;
                $header->save();
            }

            return $entity->toArray();
        }

        return [];
    }

    final public function getReport(string $parentId): array
    {
        $header             = GovernmentReportHeader::find($parentId);
        $repositoryContract = IReportTypes::ReportRepositoryList[ $header->report_type ] ?? null;

        if ($repositoryContract) {
            $name = trans(IReportTypes::ReportTypesNames[ $header->report_type ]);
            $repository = app($repositoryContract);
            $data       = $repository->getByParent($parentId);
            $file       = $repository->getFileInfo($data);

            return [
                'reportData'       => $data,
                'reportDataSource' => $file[ 'source' ],
                'reportFile'       => $file[ 'file' ],
                'reportName'       => $name,
            ];

        }

        return [];
    }

    /**
     * @throws ValidationException
     */
    final public function makeReport(int $type, string $date): array
    {
        if ($type !== IReportTypes::TypeQolday) {
            throw ValidationException::withMessages([ 'type' => 'invalid report type' ]);
        }

        $date = Carbon::createFromFormat('Y-m-d', $date)
                      ->day(1)
                      ->format('Y-m-d')
        ;

        $exists = GovernmentReportHeader
            ::where(IReportsHeaders::ReportType, $type)
            ->where(IReportsHeaders::ImportDate, $date)
            ->exists()
        ;

        if ($exists) {
            throw ValidationException::withMessages([ 'date' => 'report exists' ]);
        }

        $report = GovernmentReportHeader::create(
            [
                IReportsHeaders::ImportDate         => $date,
                IReportsHeaders::ReportType         => $type,
                IReportsHeaders::ImportUserId       => Auth::user()->id ?? null,
                IReportsHeaders::LastEditorId       => Auth::user()->id ?? null,
                IReportsHeaders::ReportImportStatus => IReportStatuses::Finished,
            ]
        );

        $row = GovernmentQoldayReport::create(
            [
                IReportQolday::ReportId              => $report->id,
                IReportQolday::Status                => IReportStatuses::Finished,
                IReportQolday::NumberOfConsultations => 0,
                IReportQolday::DevelopedPlans        => 0,
                IReportQolday::AccompaniedProjects   => 0,
                IReportQolday::SumOfProjects         => 0,
                IReportQolday::PermitsReceived       => 0,
                IReportQolday::NumberOfListeners     => 0,
            ]
        );

        return $row->toArray();
    }


}
