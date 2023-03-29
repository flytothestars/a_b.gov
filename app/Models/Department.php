<?php

namespace App\Models;

use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use Translatable;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'parent_department_id',
        'name'
    ];

    public function children() {
        return $this->hasMany(static::class, 'parent_department_id')->orderBy('name', 'asc');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }


    public function childrenRecursiveId()
    {
        $children = new Collection();

        foreach ($this->children as $child) {
            $children->push($child);
            $children = $children->merge($child->childrenRecursiveId());
        }

        return $children;
    }

    public function parent() {
        return $this->hasOne(static::class, 'id', 'parent_department_id');
    }

    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }

    public function departmentDistrict()
    {
        return $this->hasOne(DepartmentDistrict::class, 'department_id', 'id')->with('district');
    }

    public function getFullNameAttribute()
    {
        return $this->parent ? $this->parent->fullName . ' -> '. $this->name : $this->name;
    }
}
