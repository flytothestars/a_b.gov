<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];

    final public function ratios (): HasMany
    {
        return $this->hasMany(ReportRatio::class, 'report_type_id', 'id');
    }

    final public function cityRatios (): HasMany
    {
        return $this->hasMany(ReportCityRatio::class, 'report_type_id', 'id');
    }

    final public function districtRatios (): HasMany
    {
        return $this->hasMany(ReportDistrictRatio::class, 'report_type_id', 'id');
    }

}
