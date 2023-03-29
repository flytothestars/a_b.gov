<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportEnbek;
use App\Models\District;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentEnbekReport extends Model
{
    use HasFactory;
    protected $fillable = IReportEnbek::FieldList;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportEnbek::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportEnbek::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportEnbek::CompanyUserId)->withTrashed();
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Organization::class, IReportEnbek::CompanyId);
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, IReportEnbek::ProgramDistrictId);
    }
}
