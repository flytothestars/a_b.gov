<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Integration\OrganizationRequest;
use App\Repositories\Integration\IOrganizationRepository;


class OrganizationController extends Controller
{
    private IOrganizationRepository $organizationRepository;

    public function __construct(IOrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function store(OrganizationRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->organizationRepository->create($attributes);
        return response(['id' => $entity->id], 201);
    }

    public function update($id, OrganizationRequest $request)
    {
        $attributes = $request->validated();
        $entity = $this->organizationRepository->findByMioId($id);
        $entity = $this->organizationRepository->update($entity->id, $attributes);
        return response(['id' => $entity->id], 200);
    }
}
