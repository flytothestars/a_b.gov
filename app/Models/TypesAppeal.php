<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesAppeal extends Model
{
    public $timestamps = false;
    public $table = 'types_appeal';
    use HasFactory;
}
