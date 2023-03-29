<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidies;
use App\Models\District;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentSubsidiesReport extends Model
{
    use HasFactory;
    protected $fillable = IReportDKBSubsidies::FieldList;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportDKBSubsidies::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportDKBSubsidies::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportDKBSubsidies::CompanyUserId)->withTrashed();
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Organization::class, IReportDKBSubsidies::CompanyId);
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, IReportDKBSubsidies::ProgramDistrictId);
    }
}
