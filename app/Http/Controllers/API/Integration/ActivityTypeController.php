<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Requests\Integration\ActivityClassRequest;
use App\Http\Requests\Integration\ActivityGroupRequest;
use App\Http\Requests\Integration\ActivitySectionRequest;
use App\Http\Requests\Integration\ActivitySubClassRequest;
use App\Http\Requests\Integration\ActivityTypeRequest;
use App\Repositories\Enums\ActivityNodeTypeEnum;
use App\Repositories\IActivityTypeRepository;

class ActivityTypeController
{
    private IActivityTypeRepository $activityTypeRepository;

    public function __construct(IActivityTypeRepository $activityTypeRepository)
    {
        $this->activityTypeRepository = $activityTypeRepository;
    }

    public function createActivitySubClass(ActivitySubClassRequest $request)
    {
        $attributes = $request->validated();
        $activityType = $this->activityTypeRepository->findByMioId($attributes['id']);
        if (!$activityType) {
            $_activityType = $this->activityTypeRepository->findByMioId($attributes['activity_class_id']);
            $activityType = $this->activityTypeRepository->createByParams(
                $attributes['code'],
                $attributes['name'],
                null,
                $_activityType->id,
                ActivityNodeTypeEnum::ActivitySubClass,
                $attributes['id']
            );
        }

        return response(['id' => $activityType->id], 201);
    }

    public function createActivityClass(ActivityClassRequest $request)
    {
        $attributes = $request->validated();
        $activityType = $this->activityTypeRepository->findByMioId($attributes['id']);
        if (!$activityType) {
            $_activityType = $this->activityTypeRepository->findByMioId($attributes['activity_group_id']);
            $activityType = $this->activityTypeRepository->createByParams(
                $attributes['code'],
                $attributes['name'],
                null,
                $_activityType->id,
                ActivityNodeTypeEnum::ActivityClass,
                $attributes['id']
            );
        }

        return response(['id' => $activityType->id], 201);
    }

    public function createActivityGroup(ActivityGroupRequest $request)
    {
        $attributes = $request->validated();
        $activityType = $this->activityTypeRepository->findByMioId($attributes['id']);
        if (!$activityType) {
            $_activityType = $this->activityTypeRepository->findByMioId($attributes['activity_section_id']);
            $activityType = $this->activityTypeRepository->createByParams(
                $attributes['code'],
                $attributes['name'],
                null,
                $_activityType->id,
                ActivityNodeTypeEnum::ActivityGroup,
                $attributes['id']
            );
        }

        return response(['id' => $activityType->id], 201);
    }

    public function createActivitySection(ActivitySectionRequest $request)
    {
        $attributes = $request->validated();
        $activityType = $this->activityTypeRepository->findByMioId($attributes['id']);
        if (!$activityType) {
            $_activityType = $this->activityTypeRepository->findByMioId($attributes['activity_type_id']);

            $activityType = $this->activityTypeRepository->createByParams(
                $attributes['code'],
                $attributes['name'],
                null,
                $_activityType->id,
                ActivityNodeTypeEnum::ActivitySection,
                $attributes['id']
            );
        }

        return response(['id' => $activityType->id], 201);
    }

    public function createActivityType(ActivityTypeRequest $request)
    {
        $attributes = $request->validated();
        $activityType = $this->activityTypeRepository->findByMioId($attributes['id']);
        if (!$activityType) {
            $activityType = $this->activityTypeRepository->createByParams(
                $attributes['code'],
                $attributes['name'],
                null,
                null,
                ActivityNodeTypeEnum::ActivityType,
                $attributes['id']
            );
        }

        return response(['id' => $activityType->id], 201);
    }
}
