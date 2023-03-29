<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Integration\BusinessRequest;
use App\Repositories\Integration\IBusinessRepository;
use App\Repositories\IOrganizationRepository;
use App\Repositories\IWorkingTypeMapRepository;

class BusinessController extends Controller
{
    private IBusinessRepository $businessRepository;
    private IOrganizationRepository $organizationRepository;
    private IWorkingTypeMapRepository $workingTypeMapRepository;

    public function __construct(
        IBusinessRepository     $businessRepository,
        IOrganizationRepository $organizationRepository,
        IWorkingTypeMapRepository  $workingTypeMapRepository
    )
    {
        $this->businessRepository = $businessRepository;
        $this->organizationRepository = $organizationRepository;
        $this->workingTypeMapRepository = $workingTypeMapRepository;
    }

    public function store(BusinessRequest $request)
    {
        $attributes = $request->validated();
        $attributes = $this->getOrganization($attributes);

        $attributes['working_type_id'] = $this->workingTypeMapRepository->findWorkingType($attributes['activity_type'])->id;

        $entity = $this->businessRepository->create($attributes);

        return response(['id' => $entity->id], 201);
    }

    public function update($id, BusinessRequest $request)
    {
        $attributes = $request->validated();
        $attributes = $this->getOrganization($attributes);

        $entity = $this->businessRepository->findByMioId($id);

        $attributes['working_type_id'] = $this->workingTypeMapRepository->findWorkingType($attributes['activity_type'])->id;

        $entity = $this->businessRepository->update($entity->id, $attributes);
        return response(['id' => $entity->id], 200);
    }

    private function getOrganization($attributes)
    {
        if ($attributes['organization_id']) {
            $organization = $this->organizationRepository->findByMioId($attributes['organization_id']);
            $attributes['organization_id'] = optional($organization)->id;
        }

        return $attributes;
    }
}


