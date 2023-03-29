<?php


namespace App\Repositories;


use App\Models\BusinessPhoto;
use Illuminate\Database\Eloquent\Model;

class BusinessPhotoRepository extends MioBaseRepository implements IBusinessPhotoRepository
{
    public function __construct(BusinessPhoto $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        $entity = parent::create($attributes);
        $this->storePhoto($attributes, $entity);
        return $this->find($entity->id);
    }

    public function update($id, array $attributes): Model
    {
        $entity = parent::update($id, $attributes);
        $this->storePhoto($attributes, $entity);
        return $this->find($entity->id);
    }

    protected function storePhoto(array $attributes, Model $entity): void
    {
        if (array_key_exists("photo", $attributes))
            $this->persistImageFile($entity->id, $attributes["photo"], 'media/images', "", $attributes["file_name"]);
    }
}
