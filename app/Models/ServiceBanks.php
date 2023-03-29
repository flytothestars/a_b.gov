<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use App\Traits\UsesUuid;
use Illuminate\Support\Facades\App;

class ServiceBanks extends Model
{
    use HasFactory;
    use UsesUuid;
    use Translatable;
    protected $fillable = [
        'id',
        'bank_code',
        'header',
        'account_content',
        'loan_content',
        'application',
        'rate',
        'term',
        'open_account',
        'account_price',
        'account_managment',
        'open_account_url',
        'get_loan_url',
    ];

    public function translate(string $field)
    {
        if (App::getLocale() === 'kk') {
            $trans = $this->translations()
                ->where('language', 'kk')
                ->first();
            if (
                $trans
                && $trans->content
                && array_key_exists($field, $trans->content)
            ) {
                return $trans->content[$field];
            }
        }
        return $this->{$field};
    }
}
