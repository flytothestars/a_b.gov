<?php

namespace App\Models\Report\GovernmentProgram;

use App\Contracts\GovernmentProgramsReports\IReportQolday;
use App\Contracts\GovernmentProgramsReports\IReportsHeaders;
use App\Models\User;
use App\Traits\Storable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GovernmentReportHeader extends Model
{
    use HasFactory, Storable, UsesUuid;

    protected $fillable = IReportsHeaders::FieldList;


    final public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'import_user_id')->withTrashed();
    }

    final public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_editor_id')->withTrashed();
    }

    final public function qoldayReport(): HasOne
    {
        return $this->hasOne(GovernmentQoldayReport::class, IReportQolday::ReportId, IReportsHeaders::Id);
    }


}
