<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UuidModel extends Model
{
    public $incrementing = false;

    public function getKeyType()
    {
        return 'string';
    }
}
