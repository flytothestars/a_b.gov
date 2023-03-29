<?php

namespace App\Traits;

use App\Models\StorageFile;

trait Storable
{
    public function files()
    {
        return $this->morphMany(StorageFile::class, 'storable');
    }

    public function getDefaultFileAttribute()
    {
        return $this->files()->firstWhere('file_type', '');
    }
}
