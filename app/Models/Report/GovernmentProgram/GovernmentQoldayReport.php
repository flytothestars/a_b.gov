<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportQolday;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GovernmentQoldayReport extends Model
{
    use HasFactory;
    protected $fillable = IReportQolday::ReportRatios;
    final public function header(): BelongsTo
    {
        return $this->belongsTo(GovernmentReportHeader::class, IReportQolday::ReportId);
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, IReportQolday::LastEditorId)->withTrashed();
    }
}
