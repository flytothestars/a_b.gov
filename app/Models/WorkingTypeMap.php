<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingTypeMap extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'id',
        'working_type_id',
        'activity_type_id',
    ];

    public $timestamps = false;
}
