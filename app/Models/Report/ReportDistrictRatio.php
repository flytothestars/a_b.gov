<?php

namespace App\Models\Report;

use App\Models\City;
use App\Models\District;
use App\Models\Report\ReportRatio;
use App\Models\Report\ReportType;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportDistrictRatio extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'city_id',
        'district_id',
        'report_type_id',
        'ratio_id',
        'value',
        'date',
        'created_art',
        'updated_at',
    ];

    final public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id', 'id');
    }

    final public function district(): BelongsTo
    {
        return $this->belongsTo(District::class,'district_id', 'id');
    }

    final public function type(): BelongsTo
    {
        return $this->belongsTo(ReportType::class,'report_type_id', 'id');
    }

    final public function ratio(): BelongsTo
    {
        return $this->belongsTo(ReportRatio::class,'ratio_id', 'id');
    }
}
