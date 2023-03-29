<?php

namespace App\Models;

use App\Repositories\Enums\DocumentSourceTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use App\Traits\UsesUuid;
use App\Traits\Storable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Appeal extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid, Storable;

    protected $guarded = [];
    public $timestamps = true;

    protected $fillable = [
        'id',
        'category_id',
        'type_id',
        'content',
        'createDate',
        'updateDate',
        'user_id',
        'distributor_id',
        'appeal_status_id',
        'client_appeal_status_id',
        'district_id',
        'comment',
        'last_action_type_id',
        'last_executor_id',
        'last_coexecutor_id',
        'appeal_result_type_id',
        'mio_id',
        'business_id',
        'source_type_id',
        'flow_type_id',
        'last_curator_upi_id',
        'last_curator_district_id',
        'appeal_no',
        'last_curator_district_id',
        'industry_id',
        'source_type_id',
        'external_category_id',
        'created_at',
        'updated_at',
        'in_camunda',
    ];

    public function upiCurator()
    {
        return $this->hasOne(User::class, 'id', 'last_curator_upi_id')->withTrashed()->with('profile');
    }

    public function districtCurator()
    {
        return $this->hasOne(User::class, 'id', 'last_curator_district_id')->withTrashed()->with('profile');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, "business_id");
    }
    
    public function ieappealDocument()
    {
        return $this->hasOne(IEFiles::class, 'appeal_id', 'id');
    }
    public function appealSourceType()
    {
        return $this->belongsTo(SourceType::class, "source_type_id");
    }

    public function appealResultType()
    {
        return $this->belongsTo(AppealResultType::class, "appeal_result_type_id");
    }

    public function executor()
    {
        return $this->hasOne(User::class, 'id', 'last_executor_id')->withTrashed()->with('profile');
    }

    public function coExecutor()
    {
        return $this->hasOne(User::class, 'id', 'last_coexecutor_id')->withTrashed()->with('profile');
    }

    public function lastAppealActionType()
    {
        return $this->belongsTo(AppealActionType::class, "last_action_type_id");
    }

    public function district()
    {
        return $this->belongsTo(District::class, "district_id");
    }

    public function appealStatus()
    {
        return $this->belongsTo(AppealStatus::class, "appeal_status_id");
    }

    public function clientAppealStatus()
    {
        return $this->belongsTo(ClientAppealStatus::class, "client_appeal_status_id");
    }

    public function appealHistories()
    {
        return $this->hasMany(AppealHistory::class);
    }

    public function appealQoldayProducts()
    {
        return $this->hasMany(AppealQoldayProduct::class);
    }

    public function appealDocuments()
    {
        return $this->hasMany(AppealDocument::class);
    }

    public function appealClientDocuments()
    {
        return $this->hasMany(AppealDocument::class)
            ->where('document_source_type_id', DocumentSourceTypeEnum::ClientDocument);
    }

    public function appealManagerDocuments()
    {
        return $this->hasMany(AppealDocument::class)
            ->where('document_source_type_id', DocumentSourceTypeEnum::ManagerDocument);
    }

    public function category()
    {
        return $this->hasOne(ServiceGroup::class, 'id', 'category_id');
    }

    public function type()
    {
        return $this->hasOne(CategoryAppeal::class, 'id', 'type_id');
    }

//    public function executor()
//    {
//        return $this->belongsTo(AppealsExecutor::class, 'id', 'appeals_id')
//            ->where('is_active', '=', '1')->with('executor.profile');
//    }
//
//    public function coExecutor()
//    {
//        return $this->belongsTo(AppealsCoExecutor::class, 'id', 'appeals_id')
//            ->where('is_active', '=', '1')->with('coExecutor.profile');
//    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed()->with('profile.industry');
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id')->withTrashed()->with('profile');
    }

    public function flowType()
    {
        return $this->hasOne(FlowType::class, 'id', 'flow_type_id');
    }

    public function reference(): BelongsTo
    {
        return $this->belongsTo(AppealReferenceHistory::class, 'id', 'appeal_id');
    }

    public function childrenReferences(): HasMany
    {
        return $this->hasMany(AppealReferenceHistory::class, 'parent_appeal_id', 'id');
    }

    public function parentAppeal(): ?HasOneThrough
    {
        return $this->hasOneThrough(Appeal::class, AppealReferenceHistory::class, 'appeal_id', 'id', 'id', 'parent_appeal_id');
    }

    public function childrenAppeals(): HasManyThrough
    {
        return $this->hasManyThrough(Appeal::class, AppealReferenceHistory::class, 'parent_appeal_id', 'id', 'id', 'appeal_id');
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }

    public function appealDocumentsHistories(): HasMany
    {
        return $this->hasMany(AppealDocumentHistory::class, 'appeal_id', 'id');
    }
}
