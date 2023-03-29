<?php

namespace App\Repositories\Integration;

use App\Helpers\Helper;
use App\Models\Business;
use App\Models\BusinessContact;
use App\Repositories\BaseRepository;
use App\Repositories\ICityRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IRegionRepository;
use App\Repositories\MioBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BusinessContactRepository extends MioBaseRepository implements IBusinessContactRepository
{

    private \App\Repositories\IBusinessRepository $businessRepository;

    public function __construct(
        BusinessContact $model,
        \App\Repositories\IBusinessRepository $businessRepository
    )
    {
        parent::__construct($model);
        $this->businessRepository = $businessRepository;
    }

    public function create(array $attributes): Model
    {
        $entity = parent::create([
            'id' => Uuid::uuid4(),
            'full_name' => $attributes['full_name'],
            'phone_number' => $attributes['phone_number'],
            'mio_id' => $attributes['id'],
            'business_id' => $this->businessRepository->findByMioId($attributes['business_id'])->id
        ]);
        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $entity = parent::update($id, [
            'full_name' => $attributes['full_name'],
            'phone_number' => $attributes['phone_number'],
            'mio_id' => $attributes['id'],
            'business_id' => $this->businessRepository->findByMioId($attributes['business_id'])->id
        ]);
        return $entity;
    }
}
