<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FrontViewServiceGroup extends UuidModel
{
    use HasFactory;
    use Translatable, Storable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];
}

