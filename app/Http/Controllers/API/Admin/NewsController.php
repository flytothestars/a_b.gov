<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateNewsRequest;
use App\Http\Requests\News\NewsFilterRequest;
use App\Http\Requests\News\StoreFileRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\CategoryResource;
use App\Http\Resources\News\NewsListResource;
use App\Http\Resources\News\NewsResource;
use App\Repositories\INewsCategoryRepository;
use App\Repositories\INewsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    private INewsRepository         $repository;
    private INewsCategoryRepository $categoryRepository;

    /**
     * NewsController constructor.
     *
     * @param INewsRepository         $repository
     * @param INewsCategoryRepository $categoryRepository
     */
    public function __construct(
        INewsRepository $repository,
        INewsCategoryRepository $categoryRepository
    )
    {
        $this->repository         = $repository;
        $this->categoryRepository = $categoryRepository;
    }


    final public function categories(): JsonResource
    {
        return CategoryResource::collection($this->categoryRepository->all());
    }

    /**
     * Display a listing of the resource.
     *
     * @param NewsFilterRequest $request
     *
     * @return JsonResource
     */
    final public function index(NewsFilterRequest $request): JsonResource
    {
        return NewsListResource::collection($this->repository->allByFilter($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewsRequest $request
     *
     * @return NewsResource
     */
    final public function store(CreateNewsRequest $request): NewsResource
    {
        $news = $this->repository->create($request->validated());
        return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return NewsResource
     */
    final public function show(string $id): NewsResource
    {
        $news = $this->repository->find($id);
        if (!$news) {
            throw new ModelNotFoundException('news not found');
        }
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsRequest $request
     * @param string            $id
     *
     * @return NewsResource
     */
    final public function update(UpdateNewsRequest $request, string $id): NewsResource
    {
        $attributes = $request->validated();
        if(!array_key_exists('isPublished', $attributes)){
            $attributes['isPublished'] = false;
        }
        $news       = $this->repository->update($id, $attributes);
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    final public function destroy(string $id): JsonResponse
    {
        $this->repository->delete($id);
        return response()->json([ 'status' => 'ok' ]);
    }

    final public function storeImage(StoreFileRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $file = $attributes[ 'file' ];

        $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();

        $directory = 'news/images';
        if(!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $filePath = Storage::disk('public')->putFileAs(
            $directory, $file, $fileName
        );

        return response()->json(['location' => url("/storage/{$filePath}")]);
    }
}
