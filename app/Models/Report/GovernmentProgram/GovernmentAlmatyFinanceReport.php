<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportTypeAlmatyFinance;
use App\Models\District;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentAlmatyFinanceReport extends Model
{
    use HasFactory;
    protected $fillable = IReportTypeAlmatyFinance::FieldList;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportTypeAlmatyFinance::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportTypeAlmatyFinance::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportTypeAlmatyFinance::CompanyUserId)->withTrashed();
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Organization::class, IReportTypeAlmatyFinance::CompanyId);
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, IReportTypeAlmatyFinance::ProgramDistrictId);
    }
}
