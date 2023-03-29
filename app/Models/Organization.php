<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Organization extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    protected $fillable = [
        'id',
        'position',
        'name',
        'iin',
        'description',
        'is_individual',
        'mio_id',
        'full_name'
    ];

    public $timestamps = false;

    public function profile() : HasOne
    {
        return $this->hasOne(Profile::class,'organization_id','id');
    }

    public function business()
    {
        return $this->hasOne(Business::class,'organization_id','id');
    }
}
