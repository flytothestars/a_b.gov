<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessRequest;
use App\Http\Requests\CreateBusinessAccountRequest;
use App\Http\Requests\ReAssignBusinessDistributor;
use App\Http\Resources\ActivityTypeResource;
use App\Http\Resources\BusinessContactsResource;
use App\Http\Resources\DistributorBusinessResource;
use App\Http\Resources\DistributorOrganizationResource;
use App\Http\Resources\BusinessPhotosResource;
use App\Http\Resources\BusinessResource;
use App\Http\Resources\UserResource;
use App\Integration\IMioBusinessStatuses;
use App\Repositories\IActivityTypeRepository;
use App\Repositories\IBusinessActivityTypeRepository;
use App\Repositories\IBusinessContactRepository;
use App\Repositories\IBusinessPhotoRepository;
use App\Repositories\IBusinessRepository;
use App\Repositories\IOrganizationRepository;
use App\Repositories\IUserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

use App\Exports\BusinessExport;
use App\Exports\StaticByDistrict;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Report\IBusinessReportRepository;
use App\Repositories\Report\IAppealsByDistrictReportRepository;
use App\Http\Requests\Report\BusinessReportRequest;
use App\Repositories\Enums\DistrictsEnum;
use Symfony\Component\HttpFoundation\JsonResponse;

class BusinessController extends Controller
{
    private $businessRepository;
    private $businessContactsRepository;
    private $businessPhotoRepository;
    private $userRepository;
    private $businessActivityTypeRepository;


    private $businessReportRepository;
    private $staticByDistrictReportRepository;

    public function __construct(
        IBusinessRepository $businessRepository,
        IBusinessContactRepository $businessContactRepository,
        IBusinessPhotoRepository $businessPhotoRepository,
        IUserRepository $userRepository,
        IBusinessActivityTypeRepository $businessActivityTypeRepository,

        IBusinessReportRepository $businessReportRepository,
        IAppealsByDistrictReportRepository $staticByDistrictReportRepository
    ) {
        $this->businessRepository             = $businessRepository;
        $this->businessContactsRepository     = $businessContactRepository;
        $this->businessPhotoRepository        = $businessPhotoRepository;
        $this->userRepository                 = $userRepository;
        $this->businessActivityTypeRepository = $businessActivityTypeRepository;

        $this->businessReportRepository             = $businessReportRepository;
        $this->staticByDistrictReportRepository             = $staticByDistrictReportRepository;
        $this->businessReportRepository = $businessReportRepository;
    }

    final public function businessStatusList(): JsonResponse
    {
        $statusesName = IMioBusinessStatuses::StatusListNames;

        $statuses = [];

        foreach ($statusesName as $status => $name) {
            $statuses[] =
                [
                    'id'   => $status,
                    'name' => trans($name),
                ];
        }

        return response()->json($statuses);
    }

    public function businessList(BusinessRequest $request): JsonResource
    {
        return BusinessResource::collection($this->businessRepository->allByFilter($request->validated()));
    }

    public function distributorBusinessList(BusinessRequest $request): JsonResource
    {
        return BusinessResource::collection($this->businessRepository->allByFilterDistributor($request->validated()));
    }

    public function business($id): JsonResource
    {
        return new BusinessResource($this->businessRepository->getAppealBusinessById($id));
    }


    public function noAppeal($id): JsonResource
    {
        $this->businessRepository->update(
            $id,
            [
                'last_call_date' => Carbon::now(),
            ]
        );

        return new BusinessResource($this->businessRepository->getAppealBusinessById($id));
    }

    public function sendToCorrection(string $id): JsonResource
    {
        $this->businessRepository->update(
            $id,
            [
                'status' => IMioBusinessStatuses::UPDATE_REQUIRED,
            ]
        );

        return new BusinessResource($this->businessRepository->getAppealBusinessById($id));
    }

    public function distributorBusiness($id): JsonResource
    {
        return new DistributorBusinessResource($this->businessRepository->getAppealBusinessById($id));
    }

    public function businessContacts($id): JsonResource
    {
        return BusinessContactsResource::collection($this->businessContactsRepository->getByBusinessId($id));
    }

    public function businessPhotos($id): JsonResource
    {
        return BusinessPhotosResource::collection($this->businessPhotoRepository->getByBusinessId($id));
    }

    public function businessActivity($id): JsonResource
    {
        return ActivityTypeResource::collection($this->businessActivityTypeRepository->getByBusinessId($id));
    }

    public function deleteAccountAll() {
        return $this->userRepository->deleteAccountAll();
    }

    public function createAccount()
    {
        return $this->userRepository->createBusinessUserForAll();
    }

    public function checkAccountBusiness(int $id)
    {
        return $this->userRepository->checkAccountBusiness($id);
    }

    public function createBusinessAccount(CreateBusinessAccountRequest $request): JsonResource
    {
        $attributes = $request->all();

        $user = $this->userRepository->createBusinessUser($attributes['id'], Arr::except($attributes, ['id']));

        return new UserResource($user);
    }

    public function reassignDistributor($id, ReAssignBusinessDistributor $request): JsonResource
    {
        $attributes = $request->validated();

        $this->businessRepository->update($id, $attributes);
        return new BusinessResource($this->businessRepository->getAppealBusinessById($id));
    }

    public function reportBusiness(BusinessReportRequest $request)
    {

        $attributes    = $request->validated();
        $filter        = collect(
            [
                ["Период от: " . $attributes['startDate']],
                ["Период до: " . $attributes['endDate']],
            ]
        );
        $level_1_array = $this->businessReportRepository->getBusinessCnt($attributes);
        $level_2_array = $this->businessReportRepository->getBusinessByDistrict($attributes);

        $level_3_array = $this->businessReportRepository->getBusinessByIndustry($attributes);
        $level_4_array = $this->businessReportRepository->getBusinessByCatIndustry($attributes);
        $level_5_array = $this->businessReportRepository->getBusinessByCatDistrict($attributes);
        $level_18_array = $this->businessReportRepository->getBusinessByCategory($attributes);
        $level_6_array = $this->businessReportRepository->getAppealsByCatStatus($attributes);
        $level_7_array = $this->businessReportRepository->getAppelsByCatResult($attributes);
        $level_8_array = $this->businessReportRepository->getByDistrStatus($attributes);
        $level_9_array = $this->businessReportRepository->getByDistrResult($attributes);
        $level_10_array = $this->businessReportRepository->getByCuratorStatus($attributes);
        $level_11_array = $this->businessReportRepository->getByCuratorResult($attributes);
        $level_12_array = $this->businessReportRepository->getByExecutorStatus($attributes);
        $level_13_array = $this->businessReportRepository->getByExecutorResult($attributes);
        $level_14_array = $this->businessReportRepository->getByCoExecStatus($attributes);
        $level_15_array = $this->businessReportRepository->getByCoExecResult($attributes);
        $level_16_array = $this->businessReportRepository->getMioBusiness($attributes);
        $level_17_array = $this->businessReportRepository->getMioBusinessIndustry($attributes);
        $level_19_array = $this->businessReportRepository->getAppealsByCategory($attributes);
        $level_20_array = $this->businessReportRepository->getBusinessCntExt($attributes);
        $tables = [
            $filter, $level_1_array,
            $level_2_array, $level_3_array,
            $level_4_array, $level_5_array,
            $level_6_array, $level_7_array,
            $level_8_array, $level_9_array,
            $level_10_array, $level_11_array,
            $level_12_array, $level_13_array,
            $level_14_array, $level_15_array,
            $level_16_array, $level_17_array,
        ];

        if ($request->input('returnDataWithoutExcel') === 'false') {
            return Excel::download(new BusinessExport($tables), 'allAppeals.xlsx');
        } else {
            $arr = [];
            $appealsByWorkingType = $this->businessReportRepository->getAppealsByWorkingType($attributes);
            $arr[0] = collect()->merge($level_20_array->except(0));
            $arr[1] = collect()->merge($level_2_array->except(0));
            $arr[2] = collect()->merge($level_19_array->except(0));
            $arr[3] = collect()->merge($level_5_array->except(0));
            $arr[4] = collect()->merge($appealsByWorkingType->except(0));

            return response()->json($arr);
        }
    }

    final public function appealsReport(BusinessReportRequest $request)
    {
        $attributes = $request->validated();

        $reportAppeal = $this->businessReportRepository->getAppealsReport($attributes);
        $reportBusiness = $this->businessReportRepository->getTotalStatisticsByDistricts($attributes);
        $report = [
            'total_statistics_by_districts' => $reportBusiness,
            'appeal' => $reportAppeal,
        ];
        // print "<pre>";
        // die(var_dump(response()->json($report)));
        return response()->json($report);
    }

    public function reportStatByDistrict(BusinessReportRequest $request)
    {
        $attributes = $request->validated();
        $report = "Статистика обращений по районам за период с " . $attributes['startDate'] . " по " . $attributes['endDate'];
        $filter = collect([
            [$report],
        ]);
        $level1 = $this->staticByDistrictReportRepository->getStaticsByDistricts($attributes);
        $level_2_array = $this->staticByDistrictReportRepository->getAllAppealsByStatus($attributes);
        $district1 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Alatau, 'Алатауский');
        $district2 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Almaly, 'Алмалинский');
        $district3 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Auezov, 'Ауэзовский');
        $district4 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Bostandyk, 'Бостандыкский');
        $district5 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Zhetisu, 'Жетысуский');
        $district6 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Medeu, 'Медеуский');
        $district7 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Nauryz, 'Наурызбайский');
        $district8 = $this->staticByDistrictReportRepository->getDistrictAppealsByStatus($attributes, DistrictsEnum::Turksyb, 'Турксибский');

        $tables = [
            $filter,
            $level1
        ];
        // print"<pre>";die(var_dump($tables));

        $tables2 = [
            $level_2_array,
            $district1,
            $district2,
            $district3,
            $district4,
            $district5,
            $district6,
            $district7,
            $district8
        ];

        return Excel::download(new StaticByDistrict($tables, $tables2), $report . '.xlsx');
    }
}
