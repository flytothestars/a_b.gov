<?php

namespace App\Http\Controllers\API\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictResource;
use App\Repositories\IIndustryRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class IndustryController extends Controller
{
    private IIndustryRepository $repository;

    public function __construct(IIndustryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResource
    {
        return DictResource::collection($this->repository->all());
    }
}
