<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Translatable;

class FreeEducation extends Model
{
    use HasFactory;
    use UsesUuid;
    use Translatable;
    use HasFactory;

    protected $fillable = [
        'id',
        'category_appeals_id',
        'header',
        'lead',
        'description',
        'create_date',
        'remote_url'
    ];
    final public function categoryAppeal(): BelongsTo
    {
        return $this->belongsTo(CategoryAppeal::class, 'category_appeals_id');
    }

    public function lessons()
    {
        return $this->hasMany(FreeEducationLessons::class, 'education_id', 'id');
    }
}
