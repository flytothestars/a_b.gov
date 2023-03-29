<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Controllers\Controller;

use App\Http\Requests\Integration\BusinessPhotoRequest;
use App\Repositories\Integration\IBusinessPhotoRepository;
use Illuminate\Http\JsonResponse;

class BusinessPhotoController extends Controller
{
    private IBusinessPhotoRepository $businessPhotoRepository;

    public function __construct(IBusinessPhotoRepository $businessPhotoRepository)
    {
        $this->businessPhotoRepository = $businessPhotoRepository;
    }

    public function store(BusinessPhotoRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->businessPhotoRepository->create($attributes);
        return response(['id' => $entity->id], 201);

    }

    public function update($id, BusinessPhotoRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->businessPhotoRepository->findByMioId($id);
        $entity = $this->businessPhotoRepository->update($entity->id, $attributes);
        return response(['id' => $entity->id], 200);
    }

    public function destroy($id)
    {
        $entity = $this->businessPhotoRepository->findByMioId($id);
        $this->businessPhotoRepository->delete($entity->id);
        return response(null, 204);
    }
}
