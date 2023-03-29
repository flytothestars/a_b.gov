<?php

namespace App\Repositories\Integration;

use App\Helpers\Helper;
use App\Models\Business;
use App\Models\BusinessContact;
use App\Models\BusinessPhoto;
use App\Repositories\BaseRepository;
use App\Repositories\ICityRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IRegionRepository;
use App\Repositories\MioBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\File;

class BusinessPhotoRepository extends MioBaseRepository implements IBusinessPhotoRepository
{

    private \App\Repositories\IBusinessRepository $businessRepository;

    public function __construct(
        BusinessPhoto                         $model,
        \App\Repositories\IBusinessRepository $businessRepository
    )
    {
        parent::__construct($model);
        $this->businessRepository = $businessRepository;
    }

    public function create(array $attributes): Model
    {
        $tmpFile = $this->createTmpFile($attributes['photo_url']);

        $entity = parent::create([
            'id' => Uuid::uuid4(),
            'description' => $attributes['description'],
            'photo_url' => $attributes['photo_url'],
            'mio_id' => $attributes['id'],
            'business_id' => $this->businessRepository->findByMioId($attributes['business_id'])->id
        ]);

        $this->storePhoto(new File(Storage::path($tmpFile['name'])), $entity, $tmpFile['fileName']);

        Storage::delete($tmpFile['name']);
        return $entity;
    }

    public function update($id, array $attributes): Model
    {

        $tmpFile = $this->createTmpFile($attributes['photo_url']);

        $entity = parent::update($id, [
            'description' => $attributes['description'],
            'photo_url' => $attributes['photo_url'],
            'mio_id' => $attributes['id'],
            'business_id' => $this->businessRepository->findByMioId($attributes['business_id'])->id
        ]);

        $this->storePhoto(new File(Storage::path($tmpFile['name'])), $entity, $tmpFile['fileName']);

        return $entity;
    }

    protected function createTmpFile($photoUrl): array
    {
        $name = '';
        $fileName = null;
        if ($photoUrl) {
            $fileName = Str::random(40) . '.' . substr($photoUrl, strrpos($photoUrl, '.') + 1);
            $name = 'appeals/' . $fileName;
            $contents = file_get_contents($photoUrl);
            Storage::put($name, $contents);
        }

        return ['name' => $name, 'fileName' => $fileName];
    }

    protected function storePhoto(File $file, Model $entity, string $fileName): void
    {
        $this->persistImageFile($entity->id, $file, 'media/images', "", $fileName);
    }
}
