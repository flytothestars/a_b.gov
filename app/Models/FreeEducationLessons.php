<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\UsesUuid;

class FreeEducationLessons extends Model
{
    use HasFactory;
    use UsesUuid;
    use Translatable;
    protected $fillable = [
        'education_id ',
        'name',
        'remote_url'
    ];
    public function education()
    {
        return $this->belongsTo(FreeEducation::class);
    }
}
