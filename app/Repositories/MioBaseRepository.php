<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Business;
use App\Models\StorageFile;
use App\Models\Translation;
use App\Services\IImageConverter;
use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MioBaseRepository extends BaseRepository implements IMioIntegration
{
    public function findByMioId($mioId): ?Model
    {
        return parent::query()
            ->where('mio_id', $mioId)
            ->first();
    }

    public function getByBusinessId($id): Collection
    {
        $businessContacts = parent::query()
            ->where('business_id', $id)
            ->get();
        $business = Business::query()->where('id', $id)->first();
        foreach ($businessContacts as $businessContact) {
            if($business->organization && $business->organization->profile && $business->organization->profile->user) {
                $businessContact->client = $business->organization->profile->user->id;
            } else {
                $businessContact->client = '';
            }
        }
        return $businessContacts;
    }

    public function findByBusinessId($id): Collection
    {
        return parent::query()
            ->where('business_id', $id)
            ->get();
    }

    public function setMioId($entityId, $mioId): ?Model
    {
        $entity = parent::find($entityId);
        $entity->mio_id = $mioId;
        $entity->save();

        return $entity;
    }
}
