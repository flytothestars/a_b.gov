<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class AppealsCoExecutor extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded = [];

    protected $table = 'appeals_coexecutors';

    protected $fillable = [
        'id',
        'coexecutor_id',
        'appeals_id',
        'is_active',
        'created_at',
        'updated_at'
    ];

    public function coExecutor()
    {
        return $this->hasOne(User::class, 'id', 'coexecutor_id')->withTrashed();
    }
}
