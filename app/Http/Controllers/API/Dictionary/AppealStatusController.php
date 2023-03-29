<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictResource;
use App\Models\AppealStatus;
use App\Repositories\IAppealStatusRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class AppealStatusController extends Controller
{
    private $repository;

    public function __construct(IAppealStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResource
    {
        return DictResource::collection($this->repository
            ->all());
    }
}
