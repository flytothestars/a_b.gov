<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends UuidModel
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'mio_id',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
