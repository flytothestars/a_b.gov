<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppealDocumentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'appeal_id',
        'appeal_document_id',
        'appeal_history_id',
    ];

    public function appeal(): BelongsTo
    {
        return $this->belongsTo(Appeal::class, "appeal_id");
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(AppealDocument::class, "appeal_document_id");
    }

    public function appealHistory(): BelongsTo
    {
        return $this->belongsTo(AppealHistory::class, "appeal_history_id");
    }

}
