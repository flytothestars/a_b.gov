<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class NewsRepository extends BaseRepository implements INewsRepository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function find($id): ?Model
    {
        $query = $this->model->query();

        if ($this->isTranslatebale) {
            $query = $query->with('translations');
        }

        if ($this->isStorable) {
            $query = $query->with('files');
        }

        $query->with('newsCategory');

        return $query->find($id);
    }

    public function allByFilter($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->orderByDesc('create_date');

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function findByCode($code): ?Model
    {
        $model = $this->model->query();
        if ($this->isTranslatebale) {
            $model = $model->with("translations");
        }

        if ($this->isStorable) {
            $model = $model->with("files");
        }

        $model = $model->with("newsCategory");

        return $model->where('code', $code)
                     ->first()
            ;
    }

    public function getTop($count): Collection
    {
        $model = $this->model->query()
                             ->where('is_published', true)
        ;
        if ($this->isTranslatebale) {
            $model = $model->with("translations");
        }

        if ($this->isStorable) {
            $model = $model->with("files");
        }

        $model = $model->with("newsCategory");

        return $model->orderByDesc('create_date')
                     ->take($count)
                     ->get()
            ;
    }

    public function getByCategory($newsCategoryId): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $model = $this->model->query()
                             ->where('is_published', true)
        ;
        if ($this->isTranslatebale) {
            $model = $model->with("translations");
        }

        if ($this->isStorable) {
            $model = $model->with("files");
        }

        if ($newsCategoryId) {
            $model = $model->where("news_category_id", $newsCategoryId);
        }

        $model = $model
            ->with('newsCategory')
            ->with(['translations' => function($query){
                $query->where('language', 'kk');
            }])
        ;

        return $model->orderByDesc('create_date')
                     ->paginate()
            ;
    }

    public function update($id, array $attributes): Model
    {
        $entity = $this->model->find($id);
        if (
            array_key_exists('fileChanged', $attributes)
            && array_key_exists('file', $attributes)
        ) {
            foreach ($entity->files()->get() as $file) {
                if (Storage::disk('public')
                           ->exists($file->path)) {
                    Storage::disk('public')
                           ->delete($file->path)
                    ;
                    $file->delete();
                }
            }
            $this->persistStorageFile(
                $entity->id,
                $attributes[ 'file' ],
                'news/thumbnail',
                'thumbnail'
            );

        }
        $entity->is_published     = $attributes[ 'isPublished' ];
        $entity->create_date      = $attributes[ 'createDate' ];
        $entity->news_category_id = $attributes[ 'categoryId' ];
        $entity->header           = $attributes[ 'headerRu' ] ?? '';
        $entity->lead             = $attributes[ 'leadRu' ] ?? '';
        $entity->content          = $attributes[ 'contentRu' ] ?? '';
        if ($attributes[ 'headerRu' ]) {
            $entity->code = $this->generateSlug($attributes[ 'headerRu' ], $id);
        }

        $translation = $entity->translations()
                              ->where('language', 'kk')
                              ->first()
        ;

        if (!$translation) {
            $translation = new Translation(
                [
                    'language' => 'kk',
                    'content'  => [],
                ]
            );
        }

        $content = $translation->content;

        $content[ 'header' ]  = $attributes[ 'headerKk' ] ?? '';
        $content[ 'lead' ]    = $attributes[ 'leadKk' ] ?? '';
        $content[ 'content' ] = $attributes[ 'contentKk' ] ?? '';

        $translation->content = $content;

        $entity->translations()
               ->save($translation)
        ;
        $entity->update();

        return $this->find($entity->id);
    }

    final public function create(array $attributes): Model
    {
        $id     = Uuid::uuid4();

        $slug = $this->generateSlug($attributes[ 'headerRu' ], $id);

        $entity = $this->model->create(
            [
                'id'               => $id,
                'is_published'     => $attributes[ 'isPublished' ] ?? false,
                'create_date'      => $attributes[ 'createDate' ],
                'news_category_id' => $attributes[ 'categoryId' ],
                'header'           => $attributes[ 'headerRu' ] ?? '',
                'lead'             => $attributes[ 'leadRu' ] ?? '',
                'content'          => $attributes[ 'contentRu' ] ?? '',
                'code'             => $slug,
            ]
        );

        $translation = new Translation(
            [
                'language' => 'kk',
                'content'  => [
                    'header'  => $attributes[ 'headerKk' ] ?? '',
                    'lead'    => $attributes[ 'leadKk' ] ?? '',
                    'content' => $attributes[ 'contentKk' ] ?? '',
                ],
            ]
        );

        foreach ($entity->files as $file) {
            if (Storage::disk('public')
                       ->exists($file->path)) {
                Storage::disk('public')
                       ->delete($file->path)
                ;
                $file->delete();
            }
        }
        $this->persistStorageFile(
            $entity->id,
            $attributes[ 'file' ],
            'news/thumbnail',
            'thumbnail',
        );

        $entity->translations()
               ->save($translation)
        ;

        return $this->find($entity->id);
    }


    public function queryByFilter($attributes): Builder
    {
        $query = parent::query();
        if ($this->isTranslatebale) {
            $query = $query->with("translations");
        }

        if (array_key_exists('start_date', $attributes)) {
            $query = $query->where('create_date', '>=', $attributes[ 'start_date' ]);
        }

        if (array_key_exists('end_date', $attributes)) {
            $query = $query->where('create_date', '<=', $attributes[ 'end_date' ]);
        }

        if (array_key_exists('is_published', $attributes)) {
            $query = $query->where('is_published', $attributes[ 'is_published' ]);
        }

        if (array_key_exists('category_id', $attributes)) {
            $query = $query->where('news_category_id', $attributes[ 'category_id' ]);
        }

        return $query;
    }

    private function generateSlug($headerRu, $id): string{
        $slug = $headerRu
            ? Str::slug($headerRu, '-', 'ru')
            : $id;
        $tmpSlug = $slug;
        $i = 0;
        while ($this->model->where('code', $slug)->exists()){
            $slug = $tmpSlug . '-' . $i++;
        }

        return $slug;
    }
}
