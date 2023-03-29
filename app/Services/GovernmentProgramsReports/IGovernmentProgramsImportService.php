<?php

namespace App\Services\GovernmentProgramsReports;

use App\Models\Report\GovernmentProgram\GovernmentReportHeader;

interface IGovernmentProgramsImportService
{
    public function importReport(GovernmentReportHeader $entity);

    public function getReportRecordsAndHeaders(string $id, string $filter = 'failed'): array;

    public function getReportRowFields(string $parentId, int $id): array;

    public function updateReportRow(string $parentId, int $id, array $data): array;

    public function getReport(string $parentId): array;

    public function makeReport(int $type, string $date): array;

}
