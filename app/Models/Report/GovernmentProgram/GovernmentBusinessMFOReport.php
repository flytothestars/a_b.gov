<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessMFO;
use App\Models\District;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentBusinessMFOReport extends Model
{
    use HasFactory;
    protected $fillable = IReportAlmatyBusinessMFO::FieldList;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportAlmatyBusinessMFO::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportAlmatyBusinessMFO::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportAlmatyBusinessMFO::CompanyUserId)->withTrashed();
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Organization::class, IReportAlmatyBusinessMFO::CompanyId);
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, IReportAlmatyBusinessMFO::ProgramDistrictId);
    }
}
