<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessWorkingIndustries extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'business_id',
        'working_industry_id',
    ];

    public function workingIndustry()
    {
        return $this->belongsTo(WorkingIndustry::class, 'working_industry_id');
    }

}
