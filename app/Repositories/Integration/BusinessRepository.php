<?php

namespace App\Repositories\Integration;

use App\Helpers\Helper;
use App\Models\Business;
use App\Models\City;
use App\Models\District;
use App\Repositories\BaseRepository;
use App\Repositories\ICityRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IRegionRepository;
use App\Repositories\MioBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BusinessRepository extends MioBaseRepository implements IBusinessRepository
{
    private ICityRepository $cityRepository;
    private IDistrictRepository $districtRepository;
    private IRegionRepository $regionRepository;

    public function __construct(
        Business            $model,
        ICityRepository     $cityRepository,
        IDistrictRepository $districtRepository,
        IRegionRepository   $regionRepository
    )
    {
        parent::__construct($model);
        $this->cityRepository = $cityRepository;
        $this->districtRepository = $districtRepository;
        $this->regionRepository = $regionRepository;
    }

    public function create(array $attributes): Model
    {
        $city = $this->cityRepository->all()[0];
        $district = $this->findDistrict($attributes['district'], $city);
        $region = $this->findRegion($attributes['region'], $district);

        $entity = parent::create([
            'id' => Uuid::uuid4(),
            'organization_id' => array_key_exists('organization_id', $attributes) ? $attributes[ 'organization_id' ] : null,
            'name' => $attributes['name'],
            'display_name' => $attributes['display_name'],
            'address_line' => $attributes['address_line'],
            'address_line_stat' => $attributes['address_line_stat'],
            'source' => $attributes['source'],
            'employee_count' => array_key_exists('employee_count', $attributes) ? $attributes[ 'employee_count' ] : null,
            'has_cash_register' => array_key_exists('has_cash_register', $attributes) ? $attributes[ 'has_cash_register' ] : null,
            'cash_register_count' => array_key_exists('cash_register_count', $attributes) ? $attributes[ 'cash_register_count' ] : null,
            'has_payment_terminal' => array_key_exists('has_payment_terminal', $attributes) ? $attributes[ 'has_payment_terminal' ] : null,
            'need_to_contact' => array_key_exists('need_to_contact', $attributes) ? $attributes[ 'need_to_contact' ] : null,
            'refused_to_provide_identification_number' => array_key_exists('refused_to_provide_identification_number', $attributes) ? $attributes[ 'refused_to_provide_identification_number' ] : null,
            'identification_number_not_found_in_stat' => array_key_exists('identification_number_not_found_in_stat', $attributes) ? $attributes[ 'identification_number_not_found_in_stat' ] : null,
            'status' => $attributes['status'],
            'status_changed' => array_key_exists('status_changed', $attributes) ? Helper::dateToUtcMIO($attributes['status_changed']) : null,
            'created' => Helper::dateToUtcMIO($attributes['created']),
            'modified' => Helper::dateToUtcMIO($attributes['modified']),
            'location_long' => $attributes['location_long'],
            'location_lat' => $attributes['location_lat'],
            'mio_id' => $attributes['id'],
            'district_id' => optional($district)->id,
            'region_id' => optional($region)->id,
            'city_id' => $region ? $city->id : null,
            'source_type_id' => $attributes['source_type']

        ]);
        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $city = $this->cityRepository->all()[0];
        $district = $this->findDistrict($attributes['district'], $city);
        $region = $this->findRegion($attributes['region'], $district);

        $entity = parent::update($id, [
            'organization_id' => array_key_exists('organization_id', $attributes) ? $attributes[ 'organization_id' ] : null,
            'name' => $attributes['name'],
            'display_name' => $attributes['display_name'],
            'address_line' => $attributes['address_line'],
            'address_line_stat' => $attributes['address_line_stat'],
            'source' => $attributes['source'],
            'employee_count' => array_key_exists('employee_count', $attributes) ? $attributes[ 'employee_count' ] : null,
            'has_cash_register' => array_key_exists('has_cash_register', $attributes) ? $attributes[ 'has_cash_register' ] : null,
            'cash_register_count' => array_key_exists('cash_register_count', $attributes) ? $attributes[ 'cash_register_count' ] : null,
            'has_payment_terminal' => array_key_exists('has_payment_terminal', $attributes) ? $attributes[ 'has_payment_terminal' ] : null,
            'need_to_contact' => array_key_exists('need_to_contact', $attributes) ? $attributes[ 'need_to_contact' ] : null,
            'refused_to_provide_identification_number' => array_key_exists('refused_to_provide_identification_number', $attributes) ? $attributes[ 'refused_to_provide_identification_number' ] : null,
            'identification_number_not_found_in_stat' => array_key_exists('identification_number_not_found_in_stat', $attributes) ? $attributes[ 'identification_number_not_found_in_stat' ] : null,
            'status' => $attributes['status'],
            'status_changed' => array_key_exists('status_changed', $attributes) ? Helper::dateToUtcMIO($attributes['status_changed']) : null,
            'created' => Helper::dateToUtcMIO($attributes['created']),
            'modified' => Helper::dateToUtcMIO($attributes['modified']),
            'location_long' => $attributes['location_long'],
            'location_lat' => $attributes['location_lat'],
            'mio_id' => $attributes['id'],
            'district_id' => optional($district)->id,
            'region_id' => optional($region)->id,
            'city_id' => $region ? $city->id : null,
            'source_type_id' => $attributes['source_type']
        ]);
        return $entity;
    }

    private function findDistrict(array $attributes, City $city): ?Model
    {
        if($attributes) {
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
        if($district && $attributes) {
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
