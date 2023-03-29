<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Support\Facades\App;

trait Translatable
{
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function getTranslationAttribute()
    {
        return $this->translations()->firstWhere('language', App::getLocale());
    }

    public function getTranslationContent($field)
    {
        return $this->translation->content[$field] ?? $this[$field];
    }
}
