<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictResource;
use App\Models\AppealStatus;
use App\Repositories\IAppealStatusRepository;
use App\Repositories\ICategoryAppealRepository;
use App\Repositories\IServiceGroupRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceGroupController extends Controller
{
    private $repository;

    public function __construct(IServiceGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResource
    {
        return DictResource::collection($this->repository
            ->all());
    }
}
