<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealResultTypeRequest;
use App\Http\Resources\DictResource;
use App\Repositories\IAppealResultTypeRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class AppealResultTypeController extends Controller
{
    private $repository;

    public function __construct(IAppealResultTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppealResultTypeRequest $request): JsonResource
    {
        $attributes = $request->validated();
        return DictResource::collection($this->repository
            ->allByAppealAndToStatus($attributes['appeal_id'], $attributes['to_appeal_status_id']));
    }
    public function all(): JsonResource
    {
        return DictResource::collection($this->repository->all());
    }
}
