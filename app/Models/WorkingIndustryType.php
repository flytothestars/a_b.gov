<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingIndustryType extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'working_type_id',
        'mio_id'
    ];


    public function workingType()
    {
        return $this->belongsTo(WorkingType::class, 'working_type_id');
    }

}
