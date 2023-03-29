<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppealDocument extends Model
{
    use HasFactory;
    use UsesUuid, Storable;
    protected $guarded = [];

    protected $fillable = [
        'id',
        'appeal_id',
        'document_source_type_id',
        'created_by',
        'description'
    ];

    public function appeal()
    {
        return $this->belongsTo(Appeal::class, "appeal_id");
    }

    public function documentSourceType()
    {
        return $this->belongsTo(DocumentSourceType::class, "document_source_type_id");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by")->withTrashed()->with('profile');;
    }

    public function getFilePathAttribute()
    {
        $file = $this->files()->firstWhere('file_type', '');
        return ($file) ? $file->path : null;
    }
}
