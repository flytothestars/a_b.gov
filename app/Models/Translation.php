<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'array',
    ];

    protected $fillable = [
        'content',
        'language',
    ];

    public function translatable()
    {
        return $this->morphTo();
    }
}
