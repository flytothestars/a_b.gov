<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPhoto extends Model
{
    use HasFactory;
    use UsesUuid;
    use Storable;

    protected $fillable = [
        'id',
        'description',
        'photo_url',
        'business_id',
        'mio_id'
    ];

    public $timestamps = false;
}
