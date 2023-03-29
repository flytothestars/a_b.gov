<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppealHistory extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'comment',
        'appeal_id',
        'appeal_status_id',
        'client_appeal_status_id',
        'created_by',
        'appeal_action_type_id',
        'distributor_id',
        'executor_id',
        'coexecutor_id',
        'appeal_result_type_id'
    ];


    public $timestamps = true;

    public function appealResultType()
    {
        return $this->belongsTo(AppealResultType::class, "appeal_result_type_id");
    }

    public function distributor()
    {
        return $this->hasOne(User::class, 'id', 'distributor_id')->withTrashed()->with('profile');
    }

    public function executor()
    {
        return $this->hasOne(User::class, 'id', 'executor_id')->withTrashed()->with('profile');
    }

    public function coExecutor()
    {
        return $this->hasOne(User::class, 'id', 'coexecutor_id')->withTrashed()->with('profile');
    }

    public function appeal()
    {
        return $this->belongsTo(Appeal::class, "appeal_id");
    }

    public function appealActionType()
    {
        return $this->belongsTo(AppealActionType::class, "appeal_action_type_id");
    }

    public function appealStatus()
    {
        return $this->belongsTo(AppealStatus::class, "appeal_status_id");
    }

    public function clientAppealStatus()
    {
        return $this->belongsTo(ClientAppealStatus::class, "client_appeal_status_id");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by")->withTrashed();
    }

    public function historyDocuments(): HasMany
    {
        return $this->hasMany(AppealDocumentHistory::class, 'appeal_history_id','id');
    }
}
