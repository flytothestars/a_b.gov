<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'bin_iin', 'code_no', 'count_np', 'risk_degree', 'relevance_date'
    ];

    public static function exists($bin_iin)
    {
        $result = Employer::where(['bin_iin' => $bin_iin])->first();
        return ($result) ? true : false;
    }
}
