<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseReportRepository extends BaseRepository
{
    abstract public function validateReportRecord(
        Model $record
    ): Validator;

    final public function validateReportRecords(Collection $records): array
    {
        $validRecords   = [];
        $invalidRecords = [];

        foreach ($records as $record) {
            if ($this->validateReportRecord($record)
                     ->fails()) {
                $invalidRecords[] = $record;
            } else {
                $validRecords[] = $record;
            }
        }

        return [
            'valid'   => $validRecords,
            'invalid' => $invalidRecords,
        ];
    }

    final public function deleteByParent(string $report_id): void
    {
        $this->query()
             ->where('report_id', $report_id)
             ->delete()
        ;
    }

}
