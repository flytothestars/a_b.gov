<?php
namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Industry extends UuidModel
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];
}
