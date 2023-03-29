<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppealResultMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'from_appeal_status_id',
        'to_appeal_status_id',
        'appeal_result_id',
        'role_id',
    ];

    public $timestamps = false;

    public function fromAppealStatus()
    {
        return $this->belongsTo(AppealStatus::class, "from_appeal_status_id");
    }

    public function toAppealStatus()
    {
        return $this->belongsTo(AppealStatus::class, "to_appeal_status_id");
    }

    public function appealResultType()
    {
        return $this->belongsTo(AppealResultType::class, "appeal_result_type_id");
    }
}
