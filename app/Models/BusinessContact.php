<?php

namespace App\Models;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessContact extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'id',
        'full_name',
        'phone_number',
        'business_id',
        'mio_id'
    ];

    public $timestamps = false;
}
