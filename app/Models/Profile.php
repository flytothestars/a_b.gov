<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends UuidModel
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'industries_id',
        'first_name',
        'second_name',
        'last_name',
        'position',
        'company_name',
        'iin',
        'description',
        'organization_id',
        'last_assignment_date',
        'department_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industries_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id')
                    ->with('departmentDistrict')
            ;
    }

    public function getFullNameAttribute(): ?string
    {
        $name = "{$this->last_name} {$this->first_name} {$this->second_name}";
        $name = trim($name," ");

        return $name ?? null;
    }

}
