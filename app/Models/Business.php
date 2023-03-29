<?php

namespace App\Models;

use App\Integration\IMioBusinessStatuses;
use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    protected $fillable = [
        'id',
        'organization_id',
        'name',
        'display_name',
        'address_line',
        'address_line_stat',
        'source',
        'employee_count',
        'has_cash_register',
        'cash_register_count',
        'has_payment_terminal',
        'need_to_contact',
        'refused_to_provide_identification_number',
        'identification_number_not_found_in_stat',
        'status',
        'status_changed',
        'created',
        'modified',
        'location_long',
        'location_lat',
        'mio_id',
        'last_call_date',
        'distributor_id',
        'district_id',
        'region_id',
        'city_id',
        'source_type_id',
        'working_type_id'
    ];

    public $timestamps = false;


    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function businessContacts()
    {
        return $this->hasMany(BusinessContact::class);
    }

    public function businessPhotos()
    {
        return $this->hasMany(BusinessPhoto::class);
    }

    public function businessActivityTypes()
    {
        return $this->hasMany(BusinessActivityType::class);
    }

    public function businessWorkingIndustries()
    {
        return $this->hasMany(BusinessWorkingIndustries::class);
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id')->withTrashed()->with('profile');
    }

    public function appeals()
    {
        return $this->hasMany(Appeal::class, 'business_id', 'id');
    }

    public function getAppealsCountAttribute()
    {
        return $this->hasMany(Appeal::class, 'business_id', 'id')->count('id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function sourceType()
    {
        return $this->belongsTo(SourceType::class, 'source_type_id');
    }

    public function workingType()
    {
        return $this->belongsTo(WorkingType::class, 'working_type_id');
    }

    public function getStatusNameAttribute(): string
    {
        return trans(IMioBusinessStatuses::StatusListNames[$this->status] ?? '');
    }
}
