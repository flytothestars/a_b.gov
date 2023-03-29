<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessZhibekZholy;
use App\Models\City;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentZhibekZholyReport extends Model
{
    use HasFactory;
    protected $fillable = IReportAlmatyBusinessZhibekZholy::FieldList;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportAlmatyBusinessZhibekZholy::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportAlmatyBusinessZhibekZholy::LastEditorId)->withTrashed();
    }

    final public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportAlmatyBusinessZhibekZholy::CompanyUserId)->withTrashed();
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Organization::class, IReportAlmatyBusinessZhibekZholy::CompanyId);
    }

    final public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, IReportAlmatyBusinessZhibekZholy::ProgramCityId);
    }
}
