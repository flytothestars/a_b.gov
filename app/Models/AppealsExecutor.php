<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use App\Models\User;

class AppealsExecutor extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    protected $fillable = [
        'id',
        'executor_id',
        'appeals_id',
        'is_active',
        'created_at',
        'updated_at'
    ];

    public function executor()
    {
        return $this->hasOne(User::class, 'id', 'executor_id')->withTrashed();
    }
}
