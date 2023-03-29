<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppealResource;
use App\Http\Resources\DictResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForCoExecutorRepository;
use App\Repositories\IAppealForExecutorRepository;
use App\Repositories\IAppealSourceRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\ISourceRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class SourceController extends Controller
{
    private $repository;

    public function __construct(ISourceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResource
    {
        return DictResource::collection($this->repository
            ->all());
    }
}
