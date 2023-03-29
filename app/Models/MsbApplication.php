<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsbApplication extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'bin',
        'name',
        'phone',
        'amount',
        'turnover',
        'program_id',
        'program_type',
        'banks',
        'is_send',
        'response_code',
        'response',
    ];


    protected $casts = [
        'banks' => 'array',
    ];

}
