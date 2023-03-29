<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportDKBGuarantee;
use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentGuaranteeReport extends Model
{
    use HasFactory;

    protected $fillable = IReportDKBGuarantee::FieldList;


    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportDKBGuarantee::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportDKBGuarantee::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportDKBGuarantee::CompanyUserId)->withTrashed();
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, IReportDKBGuarantee::ProgramDistrictId);
    }

    final public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, IReportDKBGuarantee::ProgramCityId);
    }
}
