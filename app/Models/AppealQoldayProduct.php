<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppealQoldayProduct extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ServiceGroup::class, 'category_id'); 
    }
    
    public function appeal(): BelongsTo
    {
        return $this->belongsTo(Appeal::class, 'id', 'appeal_id');
    }
}
