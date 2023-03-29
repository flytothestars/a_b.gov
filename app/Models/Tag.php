<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends UuidModel
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'name',
        'id',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
