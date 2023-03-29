<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MioIntegrationLog extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = [
        'id',
        'started_at',
        'completed_at',
        'rows_processed',
        'is_success',
        'error_description',
    ];

    public $timestamps = false;
}
