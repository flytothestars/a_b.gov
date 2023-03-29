<?php

namespace App\Models;

use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;

class News extends UuidModel
{
    use HasFactory;
    use Translatable, Storable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'news_category_id',
        'header',
        'lead',
        'content',
        'create_date',
        'is_published',
        'code',
    ];

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function translate(string $field)
    {
        if (App::getLocale() === 'kk') {
            $trans = $this->translations()
                          ->where('language', 'kk')
                          ->first()
            ;
            if (
                $trans
                && $trans->content
                && array_key_exists($field, $trans->content)
            ) {
                return $trans->content[ $field ];
            }
        }
        return $this->{$field};
    }

}
