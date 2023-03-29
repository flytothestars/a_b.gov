<?php

namespace App\Repositories\Integration;

use App\Helpers\Helper;
use App\Models\Business;
use App\Models\Organization;
use App\Repositories\BaseRepository;

use App\Repositories\ICityRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IRegionRepository;
use App\Repositories\MioBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class OrganizationRepository extends MioBaseRepository implements IOrganizationRepository
{
    public function __construct(
        Organization $model
    )
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        $entity = parent::create([
            'id' => Uuid::uuid4(),
            'full_name' => $attributes['full_name'],
            'name' => $attributes['name'],
            'position' => $attributes['position'],
            'iin' => $attributes['iin'],
            'description' => $attributes['description'],
            'is_individual' => $attributes['is_individual'],
            'mio_id' => $attributes['id'],
        ]);
        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $entity = parent::update($id, [
            'full_name' => $attributes['full_name'],
            'name' => $attributes['name'],
            'position' => $attributes['position'],
            'iin' => $attributes['iin'],
            'description' => $attributes['description'],
            'is_individual' => $attributes['is_individual'],
            'mio_id' => $attributes['id'],
        ]);
        return $entity;
    }
}
