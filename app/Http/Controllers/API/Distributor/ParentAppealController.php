<?php

namespace App\Http\Controllers\API\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAppealByBusinessRequest;
use App\Http\Requests\CreateAppealByParentRequest;
use App\Http\Resources\AppealCreatedByParentResource;
use App\Repositories\IAppealDocumentRepository;
use App\Repositories\IAppealForDistributorRepository;

class ParentAppealController extends Controller
{
    private IAppealForDistributorRepository $repository;
    private IAppealDocumentRepository       $appealDocumentRepository;

    public function __construct(
        IAppealForDistributorRepository $repository,
        IAppealDocumentRepository $appealDocumentRepository
    )
    {
        $this->repository               = $repository;
        $this->appealDocumentRepository = $appealDocumentRepository;
    }

    public function createByParent(CreateAppealByParentRequest $request)
    {
        $attributes = $request->validated();

        $appeal = $this->repository->createAppealByParent(
            $attributes[ 'parent_appeal_id' ],
            $attributes
        );

        if (array_key_exists('files', $attributes)) {
            foreach ($attributes[ 'files' ] as $file) {
                $this->appealDocumentRepository->createClientDocument($appeal->id, $file);
            }
        }

        return new AppealCreatedByParentResource($appeal);
    }

    public function createByBusiness(CreateAppealByBusinessRequest $request)
    {
        $attributes = $request->validated();

        $appeal = $this->repository->createAppealByBusiness(
            $attributes[ 'business_id' ],
            $attributes
        );

        if (array_key_exists('files', $attributes)) {
            foreach ($attributes[ 'files' ] as $file) {
                $this->appealDocumentRepository->createClientDocument($appeal->id, $file);
            }
        }

        return new AppealCreatedByParentResource($appeal);
    }


}
