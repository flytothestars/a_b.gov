<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppealResource;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DictResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForCoExecutorRepository;
use App\Repositories\IAppealForExecutorRepository;
use App\Repositories\IDepartmentRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IRoleRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentController extends Controller
{
    private $repository;

    public function __construct(IDepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResource
    {
        return DepartmentResource::collection($this->repository
            ->all());
    }
}
