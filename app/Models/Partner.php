<?php
namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends UuidModel
{
    use HasFactory;
    use Translatable, Storable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'url',
        'order_no'
    ];
}
