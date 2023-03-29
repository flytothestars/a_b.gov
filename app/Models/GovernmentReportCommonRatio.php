<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentReportCommonRatio extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'report_id',
        'report_ratio',
        'value',
        'created_at',
        'updated_at',
    ];
}
