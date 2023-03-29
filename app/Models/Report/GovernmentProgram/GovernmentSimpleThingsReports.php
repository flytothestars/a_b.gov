<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use App\Models\District;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentSimpleThingsReports extends Model
{
    use HasFactory;
    protected $fillable = IReportDKBSubsidiesSimpleThings::FieldList;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportDKBSubsidiesSimpleThings::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportDKBSubsidiesSimpleThings::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportDKBSubsidiesSimpleThings::CompanyUserId)->withTrashed();
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Organization::class, IReportDKBSubsidiesSimpleThings::CompanyId);
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, IReportDKBSubsidiesSimpleThings::ProgramDistrictId);
    }
}
