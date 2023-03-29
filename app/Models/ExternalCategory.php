<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalCategory extends Model
{
    use UsesUuid;

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}
