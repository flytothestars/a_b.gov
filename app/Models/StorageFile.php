<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'storable_id',
        'storable_type',
        'path',
        'file_type',
    ];

    public function storable()
    {
        return $this->morphTo();
    }
}
