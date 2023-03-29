<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CategoryAppeal extends UuidModel
{
    use HasFactory;
    use Translatable, Storable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'order_no'
    ];

    public function serviceGroup()
    {
        return $this->belongsTo(ServiceGroup::class);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function appealQoldayProducts()
    {
        return $this->hasMany(AppealQoldayProduct::class);
    }
}
