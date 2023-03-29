<?php


namespace App\Repositories;


use App\Helpers\Helper;
use App\Models\Department;
use App\Models\Profile;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class ProfileRepository extends BaseRepository implements IProfileRepository
{

    private IOrganizationRepository $organizationRepository;
    private IDepartmentRepository $departmentRepository;

    public function __construct(
        Profile                 $model,
        IOrganizationRepository $organizationRepository,
        IDepartmentRepository $departmentRepository
    )
    {
        parent::__construct($model);
        $this->organizationRepository = $organizationRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function executorList(): Collection
    {
        return $this->getProfileByRole(RoleIntEnum::Manager, ['3d693e95-d6bb-492a-ad09-a5b26ed04dcc']);
    }

    public function distributorList(): Collection
    {
        return $this->getProfileByRole(RoleIntEnum::Distributor);
    }

    public function executorUPIList(): Collection
    {
        return $this->getProfileByRole(RoleIntEnum::Manager, ['7061f99a-fbec-4803-a5b3-f0cc1755c943']);
    }

    public function coExecutorList($department_id = null): Collection
    {
        $departments = $department_id ? [$department_id] :  ['7f0015ec-303d-4972-a23b-41302a730330', 'b5eebd4b-4d20-4f63-86f5-5c60805f31e2'];
        return $this->getProfileByRole(RoleIntEnum::CoExecutor, $departments);
    }
    public function upiCuratorList(): Collection
    {
        return $this->getProfileByRole(RoleIntEnum::UpiCurator);
    }

    public function districtCuratorList(): Collection
    {
        return $this->getProfileByRole(RoleIntEnum::DistrictCurator);
    }

    private function getProfileByRole($role, $departments = null): Collection
    {
        $profileList = parent::query()->whereHas('user.roles', function ($q) use ($role) {
            $q->where('role_id', $role);
        });

        if (!is_null($departments)) {
            $departments = collect($departments)->merge($this->departmentRepository->childrenListByParentRecursive($departments)->pluck('id'));
            $profileList = $profileList->whereIn('department_id', $departments);
        }

        return $profileList->with('department')->get();
    }

    public function create(array $attributes): Model
    {
        $organization = $this->organizationRepository->create(
            [
                'id' => Uuid::uuid4(),
                'position' => Helper::getAttributeValue('position', $attributes),
                'name' => Helper::getAttributeValue('company_name', $attributes),
                'iin' => Helper::getAttributeValue('iin', $attributes),
                'description' => Helper::getAttributeValue('description', $attributes),
            ]
        );

        $attributes['organization_id'] = $organization->id;

        return parent::create($attributes);
    }

    public function deleteByUserId($id)
    {
        return parent::query()->where('user_id', $id)->delete();
    }

    public function createBusinessProfile(array $attributes): Model
    {
        if(!$attributes['organization_id']){
            $organization = $this->organizationRepository->create(
                [
                    'id' => Uuid::uuid4(),
                    'position' => null,
                    'name' => null,
                    'iin' => null,
                    'description' => null,
                ]
            );
            $attributes['organization_id'] = $organization->id;
        }

        return parent::create($attributes);
    }

    public function update($id, array $attributes): Model
    {
        $profile = parent::find($id);
        $profileData  = $profile->toArray();

        if(!$profile->organization_id) {

            $organization = $this->organizationRepository->create(
                [
                    'id'          => Uuid::uuid4(),
                    'position'    => Helper::getAttributeValue('position', $profileData),
                    'name'        => Helper::getAttributeValue('company_name', $profileData),
                    'iin'         => Helper::getAttributeValue('iin', $profileData),
                    'description' => Helper::getAttributeValue('description', $profileData),
                ]
            );

            $attributes['organization_id'] = $organization->id;

            parent::update($id, $attributes);
        }

        $this->organizationRepository->update(
            $profile->organization_id,
            [
                'position' => Helper::getAttributeValue('position', $attributes),
                'name' => Helper::getAttributeValue('company_name', $attributes),
                'iin' => Helper::getAttributeValue('iin', $attributes),
                'description' => Helper::getAttributeValue('description', $attributes)
                ?? Helper::getAttributeValue('description', $profileData)
                ,
            ]
        );



        return parent::update($id, $attributes);
    }
}
