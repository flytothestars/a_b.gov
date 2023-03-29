<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppealResource;
use App\Http\Resources\DictResource;
use App\Http\Resources\ProfileResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForCoExecutorRepository;
use App\Repositories\IAppealForExecutorRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IProfileRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    private $repository;

    public function __construct(IProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function executorList(): JsonResource
    {
        return ProfileResource::collection($this->repository
            ->executorList());
    }

    public function distributorList(): JsonResource
    {
        return ProfileResource::collection($this->repository
            ->distributorList());
    }

    public function executorUPIList(): JsonResource
    {
        return ProfileResource::collection($this->repository
            ->executorUPIList());
    }
    public function coExecutorList($department_id = null): JsonResource
    {
        return ProfileResource::collection($this->repository
            ->coExecutorList($department_id));
    }
    public function upiCuratorList(): JsonResource
    {
        return ProfileResource::collection($this->repository
            ->upiCuratorList());
    }
    public function districtCuratorList(): JsonResource
    {
        return ProfileResource::collection($this->repository
            ->districtCuratorList());
    }
}
