<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMap extends Model
{
    use UsesUuid;

    protected $fillable = [
        'id',
        'service_group_id',
        'external_category_id',
    ];

    public $timestamps = false;
}
