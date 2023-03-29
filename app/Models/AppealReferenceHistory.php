<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppealReferenceHistory extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'id',
        'appeal_id',
        'parent_appeal_id',
        'distributor_id'
    ];

    public function distributor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'distributor_id')->withTrashed()->with('profile');
    }

    public function appeal(): HasOne
    {
        return $this->hasOne(Appeal::class, 'id', 'appeal_id');
    }

    public function parentAppeal(): HasOne
    {
        return $this->hasOne(Appeal::class, 'id', 'parent_appeal_id');
    }

}
