<?php
namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceGroup extends UuidModel
{
    use HasFactory;
    use Translatable, Storable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'requirement_type_id',
        'order_no',
        'mio_id',
    ];

    public function requirementType()
    {
        return $this->belongsTo(RequirementType::class, 'requirement_type_id');
    }

    public function categoryAppeal()
    {
        return $this->hasMany(CategoryAppeal::class);
    }
}
