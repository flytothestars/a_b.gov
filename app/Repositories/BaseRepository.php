<?php

namespace App\Repositories;

use App\Helpers\Helper;
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

class BaseRepository implements IRepository
{
    /**
     * @var Model|Builder
     */
    protected $model;
    protected $isTranslatebale = false;
    protected $isStorable = false;
    private $imageConverter;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->isTranslatebale = in_array(Translatable::class, array_keys(class_uses($this->model)));
        $this->isStorable = in_array(Storable::class, array_keys(class_uses($this->model)));
        $this->imageConverter =  App::make(IImageConverter::class);

    }

    protected function query(): Builder
    {
        $query = $this->model->query();

        if($this->isTranslatebale)
            $query = $query->with("translations");

        if($this->isStorable)
            $query = $query->with("files");

        return $query;
    }

    public function find($id): ?Model
    {
        $query = $this->model->query();

        if($this->isTranslatebale)
            $query = $query->with("translations");

        if($this->isStorable)
            $query = $query->with("files");

        return $query->find($id);
    }

    public function all(): Collection
    {
        $model = $this->model;

        if($this->isTranslatebale)
            $model = $model->with("translations");

        if($this->isStorable)
            $model = $model->with("files");
    //TODO
        //per_page=10&page=1&sortBy[]=user.email&sortDesc[]=true
//        if(count($sortBy) > 0){
//            foreach ($sortBy as $key=>$sortItem) {
//                $si = '';
//                switch ($sortItem){
//                    case 'user.email':
//                        $si = 'email';
//                        break;
//                    default:
//                        $si = $sortItem;
//                }
//                if($sortDesc[$key] != 'true') {
//                    $model = $model->orderBy($si);
//                } else {
//                    $model = $model->orderByDesc($si);
//                }
//            }
//        }

        return $model->get();
    }

    public function create(array $attributes): Model
    {
        $modelAttributes = $this->getModelAttributes($attributes);
        $entity = $this->model->query()->create($modelAttributes);

        if ($this->isTranslatebale && array_key_exists("translations", $attributes)) {
            if($attributes["translations"])
                $this->persistTranslation(
                    is_array($attributes["translations"]) ? $attributes["translations"]
                        : json_decode($attributes["translations"], true),
                    $entity
                );
        }

        return $this->find($entity->id);
    }

    public function update($id, array $attributes): Model
    {
        $modelAttributes = $this->getModelAttributes($attributes);
        $entity =  $this->model->query()->find($id);
        $entity->fill($modelAttributes);
        $entity->save();

        if ($this->isTranslatebale && array_key_exists("translations", $attributes)) {
            if($attributes["translations"])
                $this->persistTranslation(
                    is_array($attributes["translations"]) ? $attributes["translations"]
                        : json_decode($attributes["translations"], true),
                    $entity);
        }

        return $this->find($entity->id);
    }

    public function delete($id) : int
    {
        $entity = $this->find($id);

        if(!$entity)
            return 0;

        if($this->isTranslatebale && $entity->translations())
            $entity->translations()->delete();

        if($this->isStorable && $entity->files()){
            foreach ($entity->files()->get() as $storageFile) {
                if ($storageFile->path)
                    Storage::disk('public')->delete($storageFile->path);
            }
            $entity->files()->delete();
        }

        return $entity::destroy($id);
    }

    private function getModelAttributes(array $attributes): array
    {
        $modelColumns = $this->getModelColumns();
        $filteredAttributes = array_filter(
            $attributes,
            function ($key) use ($modelColumns) {
                return in_array($key, $modelColumns);
            },
            ARRAY_FILTER_USE_KEY
        );
        return $filteredAttributes;
    }

    private function getModelColumns(): array
    {
        return Schema::getColumnListing($this->model->getTable());
    }

    protected function persistImageFile($entityId, $file, $directory, $fileType, $fileName = null): void
    {
        $attributes = $this->persistStorageFile($entityId, $file, $directory, $fileType, $fileName);
        $filePath = $attributes['file_path'];
        $currentFilePath = $attributes['current_file_path'];
        $thumbDirectory = Helper::getThumbnailDirectory();

        if ($currentFilePath){
            $currentFileThumbPath = pathinfo($currentFilePath, PATHINFO_DIRNAME)
                . DIRECTORY_SEPARATOR . $thumbDirectory . DIRECTORY_SEPARATOR
                . basename($currentFilePath);

            Storage::disk('public')->delete($currentFileThumbPath);
        }

        $maxImageHeight = 1200;
        $this->imageConverter->processImage($filePath,null, $maxImageHeight);
        $maxThumbHeight = 250;
        $this->imageConverter->makeThumbnail($filePath, $maxThumbHeight, $thumbDirectory);
    }

    protected function persistStorageFile($entityId, $file, $directory, $fileType, $fileName = null): array
    {
        $entity = $this->model->query()->with("files")->find($entityId);

        if(is_null($fileName)) {
            $fileName = Str::random(40) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        }

        $currentFilePath = null;
        if($entity->files()){
            $currentfile = $entity->files()->where('file_type', $fileType)->first();
            if($currentfile)
                $currentFilePath = $currentfile->path;
        }

        if(!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $filePath = Storage::disk('public')->putFileAs(
            $directory, $file, $fileName
        );

        $storageFile = new StorageFile([
            "path" => $filePath,
            "file_type" => $fileType
        ]);

        $entity->files()->updateOrCreate(
            [
                "storable_id" => $entity->id,
                "storable_type" => get_class($entity),
                "file_type" => $fileType
            ],
            $storageFile->toArray()
        );

        if ($currentFilePath)
            Storage::disk('public')->delete($currentFilePath);

        return ['file_path' => $filePath, 'current_file_path' => $currentFilePath];
    }

    private function persistTranslation(array $translations, Model $entity): void
    {
        foreach ($translations as $translationAttribute) {
            $translation = new Translation([
                "content" => $translationAttribute["content"],
                "language" => $translationAttribute["language"]
            ]);
            $entity->translations()->updateOrCreate(
                [
                    "translatable_id" => $entity->id,
                    "translatable_type" => get_class($entity),
                    "language" => $translation->language
                ],
                $translation->toArray()
            );
        }
    }
}
