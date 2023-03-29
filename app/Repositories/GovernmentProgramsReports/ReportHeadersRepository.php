<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportsHeaders;
use App\Models\Report\GovernmentProgram\GovernmentReportHeader;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ReportHeadersRepository extends BaseRepository implements IReportHeadersRepositoryContract
{
    public function __construct(
        GovernmentReportHeader $model
    )
    {
        parent::__construct($model);
    }

    final public function create(array $attributes): Model
    {
        $entity = parent::create($attributes);
        if ($attributes[ 'file' ]) {
            $this->persistStorageFile($entity->id, $attributes[ 'file' ], 'government-reports-files', '');
        }
        return $entity;
    }


    final public function storeFile(array $attributes): Model
    {
        $entity = parent::find($attributes['id']);
        if ($attributes[ 'file' ]) {
            $this->persistStorageFile($entity->id, $attributes[ 'file' ], 'government-reports-files', '');
        }
        return $entity;
    }


    final public function getAllReportsByDate(string $date): Collection
    {
        $dateObject = Carbon::createFromFormat('Y-m-d', $date);
        $dateObject->day(1);

        return $this
            ->query()
            ->where(IReportsHeaders::ImportDate, $dateObject->format('Y-m-d'))
            ->get()
            ;
    }


}
