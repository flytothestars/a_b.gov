<?php

namespace App\Models\Report;

use App\Models\City;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportCityRatio extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'city_id',
        'report_type_id',
        'ratio_id',
        'value',
        'date',
        'created_at',
        'updated_at',
    ];

    final public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id', 'id');
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
