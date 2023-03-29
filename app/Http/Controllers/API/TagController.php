<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Project;
use App\Models\Tag;
use App\Repositories\ITagRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class TagController extends Controller
{
    private $repository;

    public function __construct(ITagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(TagRequest $request) : JsonResource
    {
        $attributes = $request->validated();

        return TagResource::collection($this->repository->allByProject($attributes));
    }

    public function search($projectId, TagRequest $request) : JsonResource
    {
        $attributes = $request->validated();
        $searchText = array_key_exists('search_text',$attributes) ? $attributes['search_text'] : '';
        return TagResource::collection($this->repository->search($projectId, $searchText));
    }

    public function store(Project $project, TagRequest $request) : JsonResource
    {
        $attributes = $request->validated() + ['project_id' => $project->id];
        return new TagResource($this->repository->create(
            $attributes
        ));
    }

    public function show(Project $project, Tag $tag) : JsonResource
    {
        return new TagResource($this->repository->find($tag->id));
    }

    public function update(Project $project, TagRequest $request, Tag $tag) : JsonResource
    {
        return new TagResource($this->repository->update(
            $tag->id,
            $request->validated()
        ));
    }

    public function destroy(Project $project, Tag $tag) : JsonResponse
    {
        $result = $this->repository->delete($tag->id);
        return response()->json(null, 204);
    }
}
