<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingType extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'id',
        'name',
        'mio_id'
    ];

    public $timestamps = false;
}
