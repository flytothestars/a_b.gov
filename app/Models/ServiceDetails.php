<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Storable;
use App\Traits\Translatable;
use App\Traits\UsesUuid;

class ServiceDetails extends UuidModel
{
    use HasFactory;
    use Translatable, Storable;
    use UsesUuid;

    protected $fillable = [
        'id',
        'service_id',
        'header',
        'content'
    ];

}
