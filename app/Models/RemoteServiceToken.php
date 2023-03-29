<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RemoteServiceToken extends UuidModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'service_name',
        'token',
        'refresh_token',
    ];
}
