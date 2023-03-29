<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppealResource;
use App\Http\Resources\DictResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForCoExecutorRepository;
use App\Repositories\IAppealForExecutorRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IRoleRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleController extends Controller
{
    private $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResource
    {
        return DictResource::collection($this->repository
            ->all());
    }
}
