<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentDistrict extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'department_id';

    protected $fillable = [
        'department_id',
        'district_id'
    ];

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
