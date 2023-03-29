<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'code',
        'name',
        'parent_id',
        'activity_node_type_id',
        'mio_id'
    ];

    public function activityNodeType()
    {
        return $this->belongsTo(ActivityNodeType::class, 'activity_node_type_id');
    }

    public function parent()
    {
        return $this->belongsTo(ActivityType::class, 'parent_id');
    }

    public function tags()
    {
        return $this->hasMany(ActivityTypeTag::class);
    }
}
