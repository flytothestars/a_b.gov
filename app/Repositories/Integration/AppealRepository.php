<?php

namespace App\Repositories\Integration;

use App\Helpers\Helper;
use App\Integration\MioIntegrationService;
use App\Models\Appeal;
use App\Models\City;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\ICityRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\MioBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AppealRepository extends MioBaseRepository implements IAppealRepository
{
    private MioIntegrationService $mioIntegrationService;
    private \App\Repositories\IBusinessRepository $businessRepository;
    private ICityRepository $cityRepository;
    private IDistrictRepository $districtRepository;
    private IAppealForDistributorRepository $appealForDistributorRepository;

    public function __construct(
        Appeal                                $model,
        MioIntegrationService                 $mioIntegrationService,
        \App\Repositories\IBusinessRepository $businessRepository,
        ICityRepository                       $cityRepository,
        IDistrictRepository                   $districtRepository,
        IAppealForDistributorRepository $appealForDistributorRepository,
        \App\Repositories\IAppealRepository $appealRepository
    )
    {
        parent::__construct($model);
        $this->mioIntegrationService = $mioIntegrationService;
        $this->businessRepository = $businessRepository;
        $this->cityRepository = $cityRepository;
        $this->districtRepository = $districtRepository;
        $this->appealForDistributorRepository = $appealForDistributorRepository;
    }

    public function create(array $attributes): Model
    {
        $city = $this->cityRepository->all()[0];
        $district = $this->findDistrict($attributes['district'], $city);
        $categoryMap = $this->mioIntegrationService->checkAndCreateExternalCategory($attributes['requirement']);

        $entity = parent::create([
            'id' => Uuid::uuid4(),
            'category_id' => $categoryMap->service_group_id,
            'type_id' => null,
            'content' => array_key_exists('content', $attributes) ? $attributes[ 'content' ] : null,
            'createDate' => Helper::dateToUtcMIO($attributes['createDate']),
            'updateDate' => Helper::dateToUtcMIO($attributes['updateDate']),
            'user_id' => null,
            'appeal_status_id' => AppealStatusEnum::Pending,
            'client_appeal_status_id' => ClientAppealStatusEnum::Pending,
            'district_id' => optional($district)->id,
            'last_executor_id' => null,
            'last_coexecutor_id' => null,
            'appeal_result_type_id' => null,
            'mio_id' => $attributes['id'],
            'business_id' => $this->businessRepository->findByMioId($attributes['business_id'])->id,
            'source_type_id' => $attributes['source_type'],
            'external_category_id' => $categoryMap->external_category_id
        ]);

        $this->appealForDistributorRepository->autoAssignDistributor($entity->id);

        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $city = $this->cityRepository->all()[0];
        $district = $this->findDistrict($attributes['district'], $city);
        $categoryMap = $this->mioIntegrationService->checkAndCreateExternalCategory($attributes['requirement']);


        $entity = parent::update($id, [
            'category_id' => $categoryMap->service_group_id,
            'content' => array_key_exists('content', $attributes) ? $attributes[ 'content' ] : null,
            'createDate' => Helper::dateToUtcMIO($attributes['createDate']),
            'updateDate' => Helper::dateToUtcMIO($attributes['updateDate']),
            'district_id' => optional($district)->id,
            'mio_id' => $attributes['id'],
            'business_id' => $this->businessRepository->findByMioId($attributes['business_id'])->id,
            'source_type_id' => $attributes['source_type'],
            'external_category_id' => $categoryMap->external_category_id
        ]);
        return $entity;
    }

    private function findDistrict($attributes, City $city): ?Model
    {
        if ($attributes) {
            $district = $this->districtRepository->findByMioId($attributes['id']);
            if (!$district) {
                $district = $this->districtRepository->create([
                    'id' => Uuid::uuid4(),
                    'name' => $attributes['name'],
                    'city_id' => $city->id,
                    'mio_id' => $attributes['id']
                ]);
            }

            return $district;
        }

        return null;
    }

    private function findRegion(array $attributes, ?Model $district): ?Model
    {
        if ($district && $attributes) {
            $region = $this->regionRepository->findByMioId($attributes['id']);
            if (!$region) {
                $region = $this->regionRepository->create([
                    'id' => Uuid::uuid4(),
                    'name' => $attributes['name'] ?? 'Другое',
                    'district_id' => $district->id,
                    'mio_id' => $attributes['id']
                ]);
            }
            return $region;
        }
        return null;
    }
}
