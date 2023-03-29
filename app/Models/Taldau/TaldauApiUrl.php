<?php

namespace App\Models\Taldau;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaldauApiUrl extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ITaldauApiUrlContract::FillableFieldList;
}
