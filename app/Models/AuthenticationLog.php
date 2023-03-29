<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuthenticationLog extends Model
{
    use HasFactory;

    protected $table = 'authentication_log';

    public $timestamps = false;

    final public function user(): MorphTo
    {
        return $this->morphTo('authenticatable');
    }
}
