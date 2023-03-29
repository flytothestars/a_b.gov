<?php

namespace App\Models\Report;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportRatio extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps =false;

    protected $fillable = [
        'report_type_id',
        'name',
        'group',
        'order',
    ];


    final public function cityRatios (): HasMany
    {
        return $this->hasMany(ReportCityRatio::class, 'ratio_id', 'id');
    }

    final public function districtRatios (): HasMany
    {
        return $this->hasMany(ReportDistrictRatio::class, 'ratio_id', 'id');
    }
}
