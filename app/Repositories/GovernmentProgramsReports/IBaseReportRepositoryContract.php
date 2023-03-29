<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Models\Report\GovernmentProgram\GovernmentGuaranteeReport;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseReportRepositoryContract
{
    public function getReportRecords(string $id): Collection;

    public function getReportRecordsFailed(string $id): array;

    public function getReportRecordsProcessed(string $id): array;

    public function getReportHeaders(): array;

    public function getReportRowFields(): array;

    public function getReportRowData(int $id): array;

    public function updateReportRow(array $data): Model;

    public function hasFailedRecords(string $report_id): bool;

    public function getByParent(string $report_id): array;

    public function deleteByParent(string $report_id): void;

    public function getFileInfo(): array;

    public function validateReportRecord(GovernmentGuaranteeReport $record): Validator;

    public function validateReportRecords(\Illuminate\Support\Collection $records): array;
}
