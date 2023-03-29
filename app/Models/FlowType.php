<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowType extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];
}
