<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Integration\AppealRequest;
use App\Http\Requests\Integration\BusinessRequest;
use App\Repositories\Integration\IAppealRepository;

class AppealController extends Controller
{
    private IAppealRepository $appealRepository;

    public function __construct(IAppealRepository $appealRepository)
    {
        $this->appealRepository = $appealRepository;
    }

    public function store(AppealRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->appealRepository->create($attributes);
        return response(['id' => $entity->id], 201);
    }

    public function update($id, AppealRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->appealRepository->findByMioId($id);
        $entity = $this->appealRepository->update($entity->id, $attributes);
        return response(['id' => $entity->id], 200);
    }
}


