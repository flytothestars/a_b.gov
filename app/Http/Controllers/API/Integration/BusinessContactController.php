<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Controllers\Controller;

use App\Http\Requests\Integration\BusinessContactRequest;
use App\Repositories\Integration\IBusinessContactRepository;
use Illuminate\Http\JsonResponse;

class BusinessContactController extends Controller
{
    private IBusinessContactRepository $businessContactRepository;

    public function __construct(IBusinessContactRepository $businessContactRepository)
    {
        $this->businessContactRepository = $businessContactRepository;
    }

    public function store(BusinessContactRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->businessContactRepository->create($attributes);
        return response(['id' => $entity->id], 201);
    }

    public function update($id, BusinessContactRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->businessContactRepository->findByMioId($id);
        $entity = $this->businessContactRepository->update($entity->id, $attributes);
        return response(['id' => $entity->id], 200);
    }

    public function destroy($id)
    {
        $entity = $this->businessContactRepository->findByMioId($id);
        if(!$entity){
            abort(404);
        }
        $this->businessContactRepository->delete($entity->id);
        return response(null, 204);
    }
}
