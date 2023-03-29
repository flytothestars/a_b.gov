<?php


namespace App\Repositories;

use App\Models\Appeal;
use App\Models\Business;
use App\Models\BusinessContact;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Enums\RoleEnum;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected IProfileRepository $profileRepository;
    protected IBusinessRepository $businessRepository;
    private IBusinessContactRepository $businessContactRepository;

    public function __construct(
        User $model,
        IProfileRepository $profileRepository,
        IBusinessRepository  $businessRepository,
        IBusinessContactRepository $businessContactRepository
    )
    {
        parent::__construct($model);
        $this->profileRepository = $profileRepository;
        $this->businessRepository = $businessRepository;
        $this->businessContactRepository = $businessContactRepository;
    }

    public function all(): Collection
    {
        return parent::query()->with('roles')
            ->get();
    }

    public function allWithPagination(array $attributes)
    {
        $perPage = null;
        if(array_key_exists('per_page',$attributes))
            $perPage = $attributes['per_page'];

        $model = parent::query()
            ->whereRelation('roles', 'id', '!=', RoleIntEnum::Client)
            ->with('roles');

        return is_null($perPage) ? $model->get() : $model->paginate($perPage);
    }

    public function create(array $attributes): Model
    {
        $user = User::query()->create([
            'name' => $attributes['name'],
            'email' => $attributes['email'] ?? '',
            'phone' => $attributes['phone'] ?? '',
            'password' => Hash::make($attributes['password']),
            'telegram_user_id' => $attributes['telegram_user_id'] ?? null,
        ]);

        $roles = $attributes['roles'];
        if(is_array($roles)){
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }
        $this->profileRepository->create(
            [
                'id' => Uuid::uuid4(),
                'user_id' => $user->id
            ]
        );

        return parent::find($user->id);
    }

    public function update($id, array $attributes): Model
    {
        User::query()->find($id)
            ->update([
                'password'=> Hash::make($attributes['password'],)
            ]);
        return parent::find($id);
    }

    public function findByPhoneNumber(string $phone): ?User
    {
        return User::where('phone', $phone)->first();
    }

    public function resetUserPassword(int $userId, string $password): User
    {
        $user = User::findOrFail($userId);
        $user->password = Hash::make($password);
        $user->save();

        return $user;
    }

    public function createInternalUser(array $attributes): Model
    {
        $user = User::query()->create([
                'name' => $attributes['lastName'] . ' ' . $attributes['firstName'] . ' ' . $attributes['secondName'],
                'password' => Hash::make($attributes['password']),
                'phone' =>  $attributes['phone'],
                'email' => $attributes['email'] ?? ''
            ]
        );

        $role = Role::find($attributes['roleId']);
        $user->assignRole($role->name);

        $this->profileRepository->create(
            [
                'id' => Uuid::uuid4(),
                'user_id' => $user->id,
                'first_name' => $attributes['firstName'] ,
                'last_name' => $attributes['lastName'],
                'second_name' => $attributes['secondName'],
                'position' =>$attributes['position'],
                'department_id' => $attributes['departmentId']
            ]
        );

        return parent::find($user->id);
    }

    public function deleteAccountAll(): string
    {
        $appeals = Appeal::query()->distinct('mio_id')->where('appeal_status_id', '08992438-a890-4a12-8850-d536f326bd9f')->get();
        $appealsCount = Appeal::query()->distinct('mio_id')->where('appeal_status_id', '08992438-a890-4a12-8850-d536f326bd9f')->count();
        for( $i=0; $i< $appealsCount; $i++) {
            if ($appeals[$i]->business_id) {
                $contact = BusinessContact::distinct('business_id')->where('business_id', $appeals[$i]->business_id)->first();
                if ($contact) {
                    $phones = explode(',', $contact->phone_number);
                    $phone = '+7' . $phones[0];
                    $user = User::query()->where('phone', $phone)->first();
                    if ($user) {
                        $profile = Profile::query()->where('user_id', $user->id)->first();
                        $roleList = DB::table('model_has_roles')->where('role_id','=',3)->where('model_id','=',$user->id)->first();
                        if ($profile && $roleList) {
                            continue;
                        }
                        else if (!$profile) {
                            if(!$roleList) {
                                $roleList->delete();
                            }
                        }
                        echo $user->phone.' ';
                        $user->delete();
                    }

                }
            }
        }
        return 'Все контанты успешно удалены!';
    }

    public function checkAccountBusiness($id)
    {
        $appealsCount = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->distinct('organizations.iin')
            ->select(
                'appeals.id',
                'appeals.business_id',
                'businesses.name',
                'organizations.iin as orgIin',
                'organizations.id as orgId',
            )->whereNotNull('organizations.iin')->where('appeal_status_id', '08992438-a890-4a12-8850-d536f326bd9f')->count();
        $appealsCountNew = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->distinct('organizations.iin')
            ->select(
                'appeals.id',
                'appeals.business_id',
                'businesses.name',
                'organizations.iin as orgIin',
                'organizations.id as orgId',
            )->whereNotNull('organizations.iin')->whereIn('appeal_status_id', ['08992438-a890-4a12-8850-d536f326bd9f', '23dcd77e-6a53-4562-a175-9f35f7696906'])->count();

        $appeals = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->distinct('organizations.iin')
            ->select(
                'appeals.id',
                'appeals.business_id',
                'businesses.name',
                'organizations.iin as orgIin',
                'organizations.id as orgId',
            )->whereNotNull('organizations.iin')->whereIn('appeal_status_id', ['08992438-a890-4a12-8850-d536f326bd9f', '23dcd77e-6a53-4562-a175-9f35f7696906'])->get();
        $appealsC = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->distinct('organizations.iin')
            ->select(
                'appeals.id',
                'appeals.business_id',
                'businesses.name',
                'organizations.iin as orgIin',
                'organizations.id as orgId',
            )->whereNotNull('organizations.iin')->whereIn('appeal_status_id', ['08992438-a890-4a12-8850-d536f326bd9f', '23dcd77e-6a53-4562-a175-9f35f7696906'])->count();
        dd($appealsCount, $appeals[$id], $appealsC, $appealsCountNew);
    }

    public function createBusinessUserForAll(): string
    {
//        $contact = BusinessContact::distinct('business_id')->where('business_id', 'a442ea84-1a70-472d-be90-67ed4fdf399c')->first();
//        dd(explode(',', $contact->phone_number));
//        $appeals = Appeal::query()->distinct('id')->where('appeal_status_id', '08992438-a890-4a12-8850-d536f326bd9f')->get();
        $appealsCount = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->distinct('organizations.iin')
            ->select(
                'appeals.id',
                'appeals.business_id',
                'businesses.name',
                'organizations.iin as orgIin',
                'organizations.id as orgId',
            )->whereNotNull('organizations.iin')->whereIn('appeal_status_id', ['08992438-a890-4a12-8850-d536f326bd9f', '23dcd77e-6a53-4562-a175-9f35f7696906'])->count();

        $appeals = Appeal::leftJoin('businesses','businesses.id','=','appeals.business_id')
            ->leftJoin('organizations','organizations.id','=','organization_id')
            ->distinct('organizations.iin')
            ->select(
                'appeals.id',
                'appeals.business_id',
                'businesses.name',
                'organizations.iin as orgIin',
                'organizations.id as orgId',
            )->whereNotNull('organizations.iin')->whereIn('appeal_status_id', ['08992438-a890-4a12-8850-d536f326bd9f', '23dcd77e-6a53-4562-a175-9f35f7696906'])->get();
        for( $i=0; $i< $appealsCount; $i++) {
            $contact = BusinessContact::distinct('business_id')->where('business_id', $appeals[$i]->business_id)->first();
            if ($contact && $contact->phone_number) {
                $phones = explode(',', $contact->phone_number);
                $phone = '+7' . $phones[0];
                $user = User::query()->where('phone', $phone)->first();
            }
            if ($contact && $contact->phone_number && User::query()->where('phone', $phone)->first()) {
                echo $i.'->' . $appeals[$i]->orgIin.'- ';
                $profile = Profile::query()->where('user_id', $user->id)->first();
                if (!$profile) {
                    $roleList = DB::table('model_has_roles')->where('role_id', '=', 3)->where('model_id', '=', $user->id)->first();
                    if (!$roleList) {
                        $role = Role::find(RoleIntEnum::Client);
                        $user->assignRole($role->name);
                    }
                    $this->profileRepository->createBusinessProfile(
                        [
                            'id' => Uuid::uuid4(),
                            'user_id' => $user->id,
                            'organization_id' => $appeals[$i]->orgId,
                        ]
                    );
                }
            } else if ($contact && $contact->phone_number && !User::query()->where('phone', $phone)->first()) {
                $this->createBusinessUserAll($appeals[$i]->business_id, ['phone' => $phone]);
                echo $i.'->' . $appeals[$i]->orgIin.'+ ';
            }
        }
        return 'Все контакты успешно созданы!';
    }

    public function createBusinessUserAll($business_id, array $attributes): Model
    {
        $business = $this->businessRepository->find($business_id);
        $user = User::query()->create([
                'name' => $business->name ?? $attributes['phone'],
                'password' => Hash::make($attributes['phone']),
                'phone' =>  $attributes['phone'],
                'email' => null,
            ]
        );

        $role = Role::find(RoleIntEnum::Client);
        $user->assignRole($role->name);
        $profile = $this->profileRepository->createBusinessProfile(
            [
                'id' => Uuid::uuid4(),
                'user_id' => $user->id,
                'organization_id' => $business->organization_id,
            ]
        );
        if(!$business->organization_id){
            $this->businessRepository->update(
                $business->id,
                [
                    'organization_id' => $profile->organization_id,
                ]
            );
        }

        return parent::find($user->id);
    }


    public function createBusinessUser($business_id, array $attributes): Model
    {
        $business = $this->businessRepository->find($business_id);

        if(!$business)
        {
            throw (new ModelNotFoundException())->setModel(Business::class);
        }

        $user = User::query()->create([
                'name' => $business->name ?? $attributes['phone'],
                'password' => Hash::make($attributes['phone']),
                'phone' =>  $attributes['phone'],
                'email' => null,
            ]
        );

        $role = Role::find(RoleIntEnum::Client);
        $user->assignRole($role->name);

        $profile = $this->profileRepository->createBusinessProfile(
            [
                'id' => Uuid::uuid4(),
                'user_id' => $user->id,
                'organization_id' => $business->organization_id,
            ]
        );

        if(!$business->organization_id){
            $this->businessRepository->update(
                $business->id,
                [
                    'organization_id' => $profile->organization_id,
                ]
            );
        }

        return parent::find($user->id);
    }

    public function updateInternalUser($id, array $attributes): Model
    {
        $user = User::query()->updateOrCreate(
            ['id' => $id], [
                'name' => $attributes['lastName'] . ' ' . $attributes['firstName'] . ' ' . $attributes['secondName'],
                'phone' =>  $attributes['phone'],
                'email' => $attributes['email'] ?? ''
            ]
        );

        $role = Role::find($attributes['roleId']);
        $user->syncRoles($role->name);

        Profile::query()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'id' => Uuid::uuid4(),
                'first_name' => $attributes['firstName'] ,
                'last_name' => $attributes['lastName'],
                'second_name' => $attributes['secondName'],
                'position' =>$attributes['position'],
                'department_id' => $attributes['departmentId']
            ]
        );

        return parent::find($user->id);
    }


	 public function getAllHead(): Collection
    {
        return parent::query()
        ->join('profiles', 'profiles.user_id', '=', 'users.id')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.id', RoleIntEnum::Head)
            ->get(['users.email','profiles.last_name',
            'profiles.first_name', 'profiles.second_name']);
    }



}
