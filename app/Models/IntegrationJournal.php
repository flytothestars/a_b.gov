<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegrationJournal extends UuidModel
{
    use HasFactory;

    protected $table = 'integration_journal';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'content',
        'is_success',
        'created_at',
        'completed_at',
        'error_description',
    ];
}
