<?php

namespace App\Integration;

use App\Helpers\Helper;
use App\Imports\BusunessEntityImport;
use App\Imports\UpdateBusCon;
use App\Integration\Model\Business;
use App\Models\ActivityType;
use App\Models\AppealQoldayProduct;
use App\Models\AppealSourceType;
use App\Models\BusinessEntity;
use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\RequirementType;
use App\Models\ServiceGroup;
use App\Models\User;
use App\Models\Appeal;
use App\Models\AppealHistory;
use App\Models\CategoryMap;
use App\Notifications\MioIntegrationError;
use App\Repositories\Enums\ActivityNodeTypeEnum;
use App\Repositories\Enums\AppealResultTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\RoleIntEnum;
use App\Repositories\Enums\SourceTypeEnum;
use App\Repositories\IActivityTypeRepository;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealHistoryRepository;
use App\Repositories\IAppealRepository;
use App\Repositories\IBusinessActivityTypeRepository;
use App\Repositories\IBusinessContactRepository;
use App\Repositories\IBusinessPhotoRepository;
use App\Repositories\IBusinessRepository;
use App\Repositories\IBusinessWorkingIndustriesRepository;
use App\Repositories\ICategoryMapRepository;
use App\Repositories\ICityRepository;
use App\Repositories\IDistrictRepository;
use App\Repositories\IExternalCategoryRepository;
use App\Repositories\IMioIntegrationLogRepository;
use App\Repositories\IOrganizationRepository;
use App\Repositories\IRegionRepository;
use App\Repositories\IRequirementTypeRepository;
use App\Repositories\IServiceGroupRepository;
use App\Repositories\IWorkingIndustryRepository;
use App\Repositories\IWorkingIndustryTypeRepository;
use App\Repositories\IWorkingTypeMapRepository;
use App\Repositories\IWorkingTypeRepository;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EntityBusImport;
use PHPUnit\Exception;
use Ramsey\Uuid\Uuid;
use App\Imports\MioID;

class MioIntegrationService implements IMioIntegrationService
{
    private IMIORestClient $restClient;
    private IMioIntegrationLogRepository $mioIntegrationLogRepository;
    private IBusinessRepository $businessRepository;
    private IOrganizationRepository $organizationRepository;
    private IBusinessContactRepository $businessContactRepository;
    private IBusinessPhotoRepository $businessPhotoRepository;
    private IDistrictRepository $districtRepository;
    private IRegionRepository $regionRepository;
    private ICityRepository $cityRepository;
    private IServiceGroupRepository $serviceGroupRepository;
    private IRequirementTypeRepository $requirementTypeRepository;
    private IAppealRepository $appealRepository;
    private IAppealForDistributorRepository $appealForDistributorRepository;
    private IActivityTypeRepository $activityTypeRepository;
    private IBusinessActivityTypeRepository $businessActivityTypeRepository;
    private ICategoryMapRepository $categoryMapRepository;
    private IExternalCategoryRepository $externalCategoryRepository;
    private IWorkingTypeMapRepository $workingTypeMapRepository;
    private IBusinessWorkingIndustriesRepository $businessWorkingIndustriesRepository;
    private IWorkingIndustryRepository $workingIndustryRepository;
    private IWorkingIndustryTypeRepository $workingIndustryTypeRepository;
    private IWorkingTypeRepository $workingTypeRepository;
    private IAppealHistoryRepository $appealHistoryRepository;


    public function __construct(
        IMIORestClient                       $restClient,
        IMioIntegrationLogRepository         $mioIntegrationLogRepository,
        IBusinessRepository                  $businessRepository,
        IOrganizationRepository              $organizationRepository,
        IBusinessContactRepository           $businessContactRepository,
        IBusinessPhotoRepository             $businessPhotoRepository,
        IDistrictRepository                  $districtRepository,
        IRegionRepository                    $regionRepository,
        ICityRepository                      $cityRepository,
        IServiceGroupRepository              $serviceGroupRepository,
        IRequirementTypeRepository           $requirementTypeRepository,
        IAppealRepository                    $appealRepository,
        IAppealForDistributorRepository      $appealForDistributorRepository,
        IActivityTypeRepository              $activityTypeRepository,
        IBusinessActivityTypeRepository      $businessActivityTypeRepository,
        ICategoryMapRepository               $categoryMapRepository,
        IExternalCategoryRepository          $externalCategoryRepository,
        IBusinessWorkingIndustriesRepository $businessWorkingIndustriesRepository,
        IWorkingIndustryRepository           $workingIndustryRepository,
        IWorkingIndustryTypeRepository       $workingIndustryTypeRepository,
        IWorkingTypeRepository               $workingTypeRepository,
        IAppealHistoryRepository                 $appealHistoryRepository
    )
    {
        $this->restClient = $restClient;
        $this->mioIntegrationLogRepository = $mioIntegrationLogRepository;
        $this->businessRepository = $businessRepository;
        $this->organizationRepository = $organizationRepository;
        $this->businessContactRepository = $businessContactRepository;
        $this->businessPhotoRepository = $businessPhotoRepository;
        $this->districtRepository = $districtRepository;
        $this->regionRepository = $regionRepository;
        $this->cityRepository = $cityRepository;

        $this->serviceGroupRepository = $serviceGroupRepository;
        $this->requirementTypeRepository = $requirementTypeRepository;
        $this->appealRepository = $appealRepository;
        $this->appealForDistributorRepository = $appealForDistributorRepository;
        $this->activityTypeRepository = $activityTypeRepository;
        $this->businessActivityTypeRepository = $businessActivityTypeRepository;
        $this->categoryMapRepository = $categoryMapRepository;
        $this->externalCategoryRepository = $externalCategoryRepository;
//        $this->workingTypeMapRepository = $workingTypeMapRepository;
        $this->businessWorkingIndustriesRepository = $businessWorkingIndustriesRepository;
        $this->workingIndustryRepository = $workingIndustryRepository;
        $this->workingIndustryTypeRepository = $workingIndustryTypeRepository;
        $this->workingTypeRepository = $workingTypeRepository;
        $this->appealHistoryRepository = $appealHistoryRepository;
    }

    public function checkDuplicate(){
        //update history
        ini_set('memory_limit', '-1');
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $path = public_path().'/files/integration/requests_20221014_T202138.xlsx';
        $excel = Excel::toArray(new MioID, $path);
        $data = $excel[0];
        $i = 0;
        foreach ($data as $row) {
            if($row[1] == 'UID запроса'){
                continue;
            }else{
                echo($i . ' ' . $row[1] . '<br>');
                $appeals = Appeal::where('mio_id','=', $row[1])->first();
                
                if($appeals){
                    $categoryMaps = CategoryMap::where('external_category_id','=',$row[10])->first();
                    $serviceGroups = ServiceGroup::where('id','=',$categoryMaps->service_group_id)->first();
                    if($serviceGroups){
                        $appeals->update([
                            'category_id' => $serviceGroups->id, 
                        ]);
                        $i++;
                    }
                }
            }
        }
        


        //dd($data);
        // foreach ($data as $row) {
        //     if($row[0] == 'id'){
        //         continue;
        //     }else{
        //         echo($row[0] . '<br>');
        //         $appeals = Appeal::where('id','=', $row[0])->first();
        //         if($appeals){
        //             $appeals->update([
        //                 'updated_at' => $row[1] 
        //             ]);
        //         }
        //         // echo('done');
        //         // dd($appeals);
                
        //     }
        // }
        echo('Done');


        // $path = public_path().'/files/integration/mioID.xlsx';
        // $excel = Excel::toArray(new MioID, $path);
        // $data = $excel[0];
        // //dd($data);
        // foreach ($data as $row) {
        //     if($row[0] == 'id'){
        //         continue;
        //     }else{
                
        //         $appeals = Appeal::where('mio_id','=', $row[0])->first();
        //         if($appeals){
        //             $appeals->update([
        //                 'in_camunda' => true 
        //             ]);
        //         }
        //     }
        // }
        // echo('Done');
    }

    public function uploadFile($file, $count)
    {
        // 0 => "business_uid"
        //  1 => "requests_uid"
        //  2 => "requirement_uid"
        //  3 => "district_uid"
        //  4 => "description"
        //  5 => "source"
        //  6 => "created"
        //  7 => "modified"
        //  8 => "requirement_type_uid"
        //  9 => "request_status_uid"
        //        $handle = fopen(public_path().'/files/integration/requests_24-06-2022.csv', "r");
        ini_set('memory_limit', '-1');
        $excel = Excel::toArray(new EntityBusImport, public_path().'/files/integration/'.$file.'.xlsx');
        $data = $excel[0];
        $i = 0;
        foreach ($data as $row) {
            if($row[0] == $file) {
                continue;
            } else if($row[0] == "business_uid") {
                continue;
            } else {
                // dd($row[2]);
                if($i>=$count){
                    echo $i.'/ ';
                    $requirementStatus = ['08992438-a890-4a12-8850-d536f326bd9f', '107ad887-047c-405d-916e-3d2e3517a17d', '23dcd77e-6a53-4562-a175-9f35f7696906'];
                    if(!$this->appealRepository->findByMioId($row[1])){
                        // $categoryMap = $this->checkAndCreateExternalCategory1($row[2]);
                        // $externalCategory = $this->externalCategoryRepository->find($row[2]);
                        // $serviceGroup = $this->serviceGroupRepository->find($categoryMap->service_group_id);
                        $categoryMaps = CategoryMap::where('external_category_id','=',$row[2])->first();
                        $serviceGroup = ServiceGroup::where('id','=',$categoryMaps->service_group_id)->first();
                        $bus = $this->businessRepository->findByMioId($row[0]);
                        $district = null;
                        if($row[3]){
                            $district = $this->districtRepository->findByMioId($row[3]);
                        }
                        $category = ['f349b899-6ea3-431b-97f1-b39ec3050cd4', '51bf6f5a-2e90-4c02-8d14-c91976034d8e', '57d7c107-b678-4f4b-910e-350cf6791837', '5f86cb50-e62d-460c-977b-1a4bc2c09a8f'];
                        $appeal = $this->appealRepository->create([
                            'id' => Uuid::uuid4(),
                            'category_id' => $serviceGroup->id ?? '' ,
                            'type_id' => null,
                            'content' => $serviceGroup->name ?? '',
        //                        'content' => $externalCategory->name . ')' . $csvLine[4],
                            'createDate' => Helper::dateToUtcMIO($row[6]),
                            'updateDate' => Helper::dateToUtcMIO($row[7]),
                            'user_id' => null,
                            'appeal_status_id' => AppealStatusEnum::Pending,
                            'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
                            'district_id' => $district ? $district->id : null,
                            'last_executor_id' => null,
                            'last_coexecutor_id' => null,
                            'appeal_result_type_id' => null,
                            'mio_id' => $row[1],
                            'business_id' => $bus != null || $bus != '' ? $bus->id : null,
                            'source_type_id' => $row[5] === 'FIELD_WORK' ? SourceTypeEnum::MIO : SourceTypeEnum::CALL_CENTER,
                            'external_category_id' => $row[2]
                        ]);
                        if (env('CAMUNDA_SEND') != true) {
                            $this->appealForDistributorRepository->autoAssignDistributor($appeal->id);
                        }
                        //dd($appeal);
                    }
                    $i=$i+1;
                } else {
                    $i=$i+1;
                    continue;
                }
            }
        }
        // unlink(public_path('app/public/files/integration/'.$file.'.xlsx'));
        echo 'Все данные успешно загружены!';
        // $handle = fopen(storage_path().'/app/public/files/integration/'.$file.'.csv', "r");
        // $header = true;
        // $i=0;
        // while ($csvLine = fgetcsv($handle, 12000, ";")) {
        //     if ($header) {
        //         $header = false;
        //     } else {
        //         if($i>=$count){
        //             echo $i.'/ ';
        //             $requirementStatus = ['08992438-a890-4a12-8850-d536f326bd9f', '107ad887-047c-405d-916e-3d2e3517a17d', '23dcd77e-6a53-4562-a175-9f35f7696906'];
        //             if(!$this->appealRepository->findByMioId($csvLine[1])){
        //                 $categoryMap = $this->checkAndCreateExternalCategory1($csvLine[2]);
        //                 $externalCategory = $this->externalCategoryRepository->find($csvLine[2]);
        //                 $serviceGroup = $this->serviceGroupRepository->find($categoryMap->service_group_id);
        //                 $bus = $this->businessRepository->findByMioId($csvLine[0]);
        //                 if($csvLine[3]){
        //                     $district = $this->districtRepository->findByMioId($csvLine[3]);
        //                 }
        //                 $category = ['f349b899-6ea3-431b-97f1-b39ec3050cd4', '51bf6f5a-2e90-4c02-8d14-c91976034d8e', '57d7c107-b678-4f4b-910e-350cf6791837', '5f86cb50-e62d-460c-977b-1a4bc2c09a8f'];
        //                 $appeal = $this->appealRepository->create([
        //                     'id' => Uuid::uuid4(),
        //                     'category_id' => $categoryMap->service_group_id ?? '' ,
        //                     'type_id' => null,
        //                     'content' => $serviceGroup->name == 'Финансирование' || $serviceGroup->name == 'Бесплатное обучение' || $serviceGroup->name == 'Потребность в кадрах' ? $serviceGroup->name : '',
        // //                        'content' => $externalCategory->name . ')' . $csvLine[4],
        //                     'createDate' => Helper::dateToUtcMIO($csvLine[6]),
        //                     'updateDate' => Helper::dateToUtcMIO($csvLine[7]),
        //                     'user_id' => null,
        //                     'appeal_status_id' => AppealStatusEnum::Pending,
        //                     'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
        //                     'district_id' => $district ? $district->id : null,
        //                     'last_executor_id' => null,
        //                     'last_coexecutor_id' => null,
        //                     'appeal_result_type_id' => null,
        //                     'mio_id' => $csvLine[1],
        //                     'business_id' => $bus != null || $bus != '' ? $bus->id : null,
        //                     'source_type_id' => $csvLine[5] === 'FIELD_WORK' ? SourceTypeEnum::MIO : SourceTypeEnum::CALL_CENTER,
        //                     'external_category_id' => $externalCategory->id
        //                 ]);
        //                 if (env('CAMUNDA_SEND') != true) {
        //                     $this->appealForDistributorRepository->autoAssignDistributor($appeal->id);
        //                 }
        //             }
        //             $i=$i+1;
        //         } else {
        //             $i=$i+1;
        //             continue;
        //         }
        //     }
        // }
        // unlink(storage_path('app/public/files/integration/'.$file.'.csv'));
        // echo 'Все данные успешно загружены!';
        //9820
    }
 
    public function checkAndCreateExternalCategory1($remoteRequirementId)
    {
        //проверить CategoryMap
        $categoryMap = $this->categoryMapRepository->findByExternalId($remoteRequirementId);
        //dd($categoryMap);
        if ($categoryMap) {
            return $categoryMap;
        } else {
            //если нет то создать external_categories и добавить в CategoryMap с нашей категорией Другое

            $externalCategory = $this->externalCategoryRepository->find($remoteRequirementId);
            if (!$externalCategory) {
        //                $remoteRequirement = $this->restClient->getRequirement($remoteRequirementId);
                $this->externalCategoryRepository->create([
                    'id' => $remoteRequirementId,
                    'name' => 'Другое' . $remoteRequirementId
                ]);
            }

            $this->categoryMapRepository->create([
                'id' => Uuid::uuid4(),
                'service_group_id' => '17fca7d8-47ce-4c98-abb6-ee3bb405a9db', //Другое
                'external_category_id' => $externalCategory->id
            ]);

        }
    }

    public function uploadFileUpdate($file, $count)
    {
        ini_set('memory_limit', '-1');
        $path = storage_path().'/app/public/files/integration/'.$file.'.xlsx';
        $excel = Excel::toArray(new UpdateBusCon, $path);
        foreach ($excel as $exc) {
            if (count($exc) == $count) {
                $data = $exc;
            }
        }
        foreach ($data as $row) {
            if($row[0] == 'uid') {
                continue;
            } else {
                if ($row[0] == null) {
                    echo 'В таблице не указан uid'. $row[1];
                    continue;
                }
                $appeal = $this->appealRepository->findByMioId($row[0]);
                $today = date("Y-m-d"); //use format whatever you are using
                if($appeal){
                    if($today != $appeal->updated_at->format("Y-m-d")){
                        if($row[5] === 'Консультация оказана по продукту Qolday') {
                            $appeal->appeal_status_id = '08992438-a890-4a12-8850-d536f326bd9f';
                            $appeal->appeal_result_type_id = AppealResultTypeEnum::ByQolday;
                        } elseif ($row[5] === 'Требует уточнения') {
                            $appeal->appeal_status_id = '107ad887-047c-405d-916e-3d2e3517a17d';
                            $appeal->appeal_result_type_id = AppealResultTypeEnum::RequiresClarification;
                        } elseif ($row[5] === 'Консультация оказана не по продукту Qolday') {
                            $appeal->appeal_status_id = '23dcd77e-6a53-4562-a175-9f35f7696906';
                            $appeal->appeal_result_type_id = AppealResultTypeEnum::NotByQolday;
                        }
                        $appeal->client_appeal_status_id = 'f9840d9f-d405-4c17-9789-8d34b082ad06';
                        $appeal->content = $row[3];
                        $appeal->comment = $row[9] != null ? $row[9] : $row[4];
                        $appeal->createDate = Helper::dateToUtcMIO2($row[7]);
                        $appeal->created_at = Helper::dateToUtcMIO2($row[7]);
                        $appeal->updateTimestamps();
                        $appeal->save();
                        $this->appealHistoryRepository->createByAppeal($appeal);
                        $qolday = AppealQoldayProduct::query()->where('appeal_id', $appeal->id)->first();
                        if($qolday) {
                            $qolday->comment = $row[9] != null ? $row[9] : $row[4];
                        } else {
                            $qolday = new AppealQoldayProduct;
                            $qolday->appeal_id = $appeal->id;
                            $qolday->comment = $row[9] != null ? $row[9] : $row[4];
                            $qolday->category_id = $appeal->category_id;
                            $qolday->save();
                        }
                    }
                } else {
                   echo $row[0] . "<br/>";
                }
            }
        }
        unlink(storage_path().'/app/public/files/integration/'.$file.'.xlsx');
        echo 'Все данные успешно загружены!';
    }

    public function uploadFileUpdateCreate($file, $count)
    {
        ini_set('memory_limit', '-1');
        $path = storage_path().'/app/public/files/integration/'.$file.'.xlsx';
        $excel = Excel::toArray(new UpdateBusCon, $path);
        foreach ($excel as $exc) {
            if (count($exc) == $count) {
                $data = $exc;
            }
        }
        foreach ($data as $row) {
            if($row[0] == 'uid') {
                continue;
            } else {
                if ($row[0] == null) {
                    echo 'В таблице не указан uid'. $row[1];
                    continue;
                }
                $appeal = $this->appealRepository->findByMioId($row[0]);
                if($appeal){
                    $appeal->createDate = Helper::dateToUtcMIO2($row[7]);
                    $appeal->created_at = Helper::dateToUtcMIO2($row[7]);
                    $appeal->save();
        //                    $history = $this->appealHistoryRepository->firstByAppeal($appeal->id);
        //                    dd($history);
        //                    if($history) {
        //                        $history->created_at = Helper::dateToUtcMIO2($row[7]);
        //                        $history->save();
        //                    }
                } else {
                    echo $row[0] . "<br/>";
                }
            }
        }
        unlink(storage_path().'/app/public/files/integration/'.$file.'.xlsx');
        echo 'Все данные успешно загружены!';
    }

    /**
     * Загрузка бизнес в базу
     */
    public function uploadFileBusEn($file, $count)
    {
        //        Storage::delete('/app/public/files/integration'.$file.'xlsx')
        $excel = Excel::toArray(new EntityBusImport, public_path().'/files/integration/'.$file.'.xlsx');
        $data = $excel[0];
        $i = 0;
        foreach ($data as $row) {
            if($row[0] == $file) {
                continue;
            } else if($row[0] == "business_uid") {
                continue;
            }
            else {
                if($i>=$count) {
                    $organization = null;
                    $organization = $this->organizationRepository->findByMioId($row[21]);

                    if (isset($row[21]) && !$organization) {
                        $organization = $this->organizationRepository->create([
                            'id' => Uuid::uuid4(),
                            'position' => null,
                            'name' => $row[22] ?? null,
                            'full_name' => $row[23] ?? null,
                            'iin' => $row[24] ?? null,
                            'description' => null,
                            'is_individual' => !($row[26] != True),
                            'mio_id' => $row[21] != '' ? $row[21] : null
                        ]);
                    }

                    $localDistrict = null;
                    $district = null;
                    $business = $this->businessRepository->findByMioId($row[0]);

                    $isNewBusiness = false;

                    if (!$business) {
                        $isNewBusiness = true;
                        $city = null;
                        if ($row[7]) {
                            $localDistrict = $this->checkAndCreateLocalDistrict($row[7]);
                            $district = $localDistrict->district;
                            $city = $district->city;
                        }
                        if ($row[6]) {
                            $district = $this->checkAndCreateDistrict($row[6]);
                            $city = $district->city;
                        }
                        $lat = 0;
                        $long = 0;
                        if(isset($row[3]) && $row[3] != '') {
                            $location = explode(' ', $row[3]);
                            $lat = explode('(', $location[1]);
                            $long = explode(')', $location[2]);
                            $lat = $lat[1];
                            $long = $long[0];
                        }

                        $business = $this->businessRepository->create([
                            'id' => Uuid::uuid4(),
                            'organization_id' => optional($organization)->id ? optional($organization)->id : null,
                            'name' => $row[1],
                            'display_name' => $row[2],
                            'address_line' => $row[4],
                            'address_line_stat' => $row[5],
                            'source' => $row[8],
                            'employee_count' => $row[10],
                            'has_cash_register' => $row[11],
                            'cash_register_count' => $row[12],
                            'has_payment_terminal' => false,
                            'need_to_contact' => $row[13],
                            'refused_to_provide_identification_number' => $row[14],
                            'identification_number_not_found_in_stat' => $row[15],
                            'status' => $row[16],
                            'status_changed' => Helper::dateToUtcMIO($row[17]),
                            'created' => Helper::dateToUtcMIO($row[18]),
                            'modified' => Helper::dateToUtcMIO($row[19]),
                            'location_long' => $long,
                            'location_lat' => $lat,
                            'mio_id' => $row[0],
                            'district_id' => optional($district)->id ? optional($district)->id : null,
                            'region_id' => $localDistrict != null && $localDistrict->id ? optional($localDistrict)->id : null,
                            'city_id' => optional($city)->id ? optional($city)->id : null,
                            'source_type_id' => $row[8] === 'FIELD_WORK' ? SourceTypeEnum::MIO : SourceTypeEnum::CALL_CENTER
                        ]);
                        $business = $this->businessRepository->autoAssignDistributor($row[0]);

                        //contact
                        if ($row[31] && $row[31] != null) {

                            $contacts = explode(', ', $row[31]);
                            $contactFio = explode(', ', $row[29]);
                            $contactPhone = explode(', ', $row[30]);
                            if (count($contacts) == count($contactPhone)) {
                                for ($i=0; $i<count($contacts); $i++) {
                                    if (!$this->businessContactRepository->findByMioId($contacts[$i])) {

                                        if ($business == null) {
                                            $business = $this->businessRepository->findByMioId($row[0]);
                                        }
                                        $this->businessContactRepository->create([
                                            'id' => Uuid::uuid4(),
                                            'full_name' => $contactFio[$i],
                                            'phone_number' => $contactPhone[$i],
                                            'business_id' => $business->id,
                                            'mio_id' => $contacts[$i]
                                        ]);

                                    }
                                }
                            }

                        }
                        if(isset($row[9]) && $row[9] != null) {
                            $activity_subclasses = explode(', ', $row[9]);
                            foreach ($activity_subclasses as $businessActivitySubclass) {
                                $activitySubclass = $this->checkAndCreateActivitySubclass1($businessActivitySubclass);
                                if ($activitySubclass == null) {
                                    continue;
                                }
                                if ($business == null) {
                                    $business = $this->businessRepository->findByMioId($row[0]);
                                }
                                $this->businessActivityTypeRepository->create([
                                    'id' => Uuid::uuid4(),
                                    'business_id' => $business->id,
                                    'activity_type_id' => $activitySubclass->id
                                ]);
                            }
                        }
                    }
                    $i=$i+1;
                    echo $i.'/ ';
                } else {
                    $i=$i+1;
                }
                
            }
            //business_uid=0,name=1,display_name=2,location=3,address_line=4,address_line_stat=5,region_uid=6,
            //district_uid=7,source=8,activity_subclasses=9,employee_count=10,has_cash_register=11,cash_register_count=12,
            //need_to_contact=13,refused_to_provide_identification_number=14,identification_number_not_found_in_stat=15,
            //status=16,status_changed=17,created=18,modified=19,industries=20,entities=21,entity_name=22,
            //entity_full_name=23,entity_identification_number=24,entity_activity_codes=25,entity_is_individual=26,
            //activity_comment=27,last_request_date=28
        }
        // unlink(public_path('/files/integration/'.$file.'.xlsx'));
        echo 'Все данные успешно загружены!';
    }

    public function upload()
    {
        $this->restClient->auth();

        $chunkCount = 1000;
        $offset = 0;
        $processedBusiness = 0;
        $mioIntegrationLog = $this->mioIntegrationLogRepository->start([]);
        $lastSuccessedMioIntegration = $this->mioIntegrationLogRepository->lastSuccessed();
        $lastSuccessedMioIntegrationDate = Carbon::create($lastSuccessedMioIntegration->completed_at)->format('Y-m-d');
        //        $lastSuccessedMioIntegrationDate = '2021-11-25';
       $lastSuccessedMioIntegrationDate = '2022-06-24';
        try {
            $businessCount = $this->restClient->getBusinessCount('ACCEPTED', $lastSuccessedMioIntegrationDate);
            if (env('APP_ENV') != 'local') {
                $this->sendNotification('Integration start. Need to process business: ' . $businessCount);
            }
            while ($offset < $businessCount) {
                $businessList = $this->restClient->getBusinesses($chunkCount, $offset, 'ACCEPTED', "2022-06-16");

                foreach ($businessList as $businessRemote) {
        //                    if($businessRemote->id = '9877c4de-c219-4c60-bd6b-67a74212646e') {

                        $this->parseBusiness($businessRemote);
        //                    }
                }
                $processedBusiness += sizeof($businessList);

                $offset += $chunkCount;
            }
            $this->mioIntegrationLogRepository->success($mioIntegrationLog->id, $processedBusiness);
            if (env('APP_ENV') != 'local') {
                $this->sendNotification('Integration complete. Processed business: ' . $processedBusiness);
            }
        } catch (\Exception $e) {
            report($e);
            $this->mioIntegrationLogRepository->fail($mioIntegrationLog->id, $e->getMessage());
            if (env('APP_ENV') != 'local') {
                $this->sendNotification($e->getMessage());
            }
        }
    }

    public function updateBusinessByIds()
    {
        $businessIdList = [
//            'fce61f31-8ae2-4a2d-a84d-48cbbb9fb3de',
//            '4ebeb5f0-f88f-4bec-b374-5cf61609ee21',
//            'af91b977-5dd0-4bc2-b962-e280530cd80e',
//            'cf802ade-44d3-4272-8846-437e17b2b71d',
//            'de0b3eb7-b4a3-4edd-86c7-637bf918106f',
//            '16b9dae3-7ebb-4102-abe2-3b38c974fb59',
//            '768e24f5-3b64-4323-a191-10fcca5decb1',
//            'b1b4d007-75d1-4587-9ccf-0b5a0d2ca279',
//            'fb42e39b-dc88-4cde-924b-59ea3a938bd2',
//            '128c1bcf-a505-40c2-85e8-50484b767f0b',
//            'df7bd397-9e0f-4c90-9d4b-5bab8b93be06',
//            '19e05f63-0deb-41d5-92d6-70e3d510befc',
//            '5417a26c-e2f4-48b6-b716-a1df090d55ff',
//            'a499419e-df03-41a0-9019-e57c25396de7',
//            '8a5dd804-0f90-453d-837d-98633f6973b5',
//            '22bc25a8-9515-467f-8857-0ec8bfd2a5b0',
//            'c69249dc-523d-4c70-8420-90032ac7be7f',
//            '1574a209-eecb-4781-85f3-bc753c6f2f01',
//            'fb58deff-5379-4941-be31-eac9c8bde163',
//            '5458a69b-68e2-4c75-b2dc-fddb0241224c',
//            '271ec934-1379-4e0a-ad17-8d7e05a1db8c',
//            '06492ffe-4f9e-46bd-bc66-13db6dd1ef32',
//            '58307552-0bbb-4587-9dc3-ed5b3df9a3bd',
//            '7b1001c4-0f41-47d0-a1a1-10e508d7804b',
//            '02052cf8-1c45-4862-a9d0-e08f443c4647',
//            '4c8ced9a-cfa8-445f-84fe-c7ef5686b382',
//            '2c87ea6d-55d8-41b8-a8a8-69dbbdfb42f4',
//            '3e7097e2-b5ac-4e52-92b6-02854706cd6e',
//            'c099aebd-8798-4292-a0f0-7d268ac0bb23',
//            'bd8735e0-f504-4fa1-bb31-35dd0ffd7317'
            '29833df5-8a59-40b9-a53c-4dca7b2a5066'
        ];

        $this->restClient->auth();

        foreach ($businessIdList as $businessId) {
            $businessRemote = $this->restClient->getBusiness($businessId);
            $this->parseBusiness($businessRemote[0]);
        }
    }

    public function updateBusinessWorkingType()
    {
        $businessList = \App\Models\Business::query()
            ->whereNotNull('mio_id')
            ->where(function ($query) {
                $query->whereNull('working_type_id')//                    ->orWhere('working_type_id', 'd00cbf0e-8604-4f08-8de0-7d6a791f7cfe')
                ;
            })
//            ->limit(20)
            ->get();

        $this->restClient->auth();

        foreach ($businessList as $business) {
            $businessRemote = $this->restClient->getBusiness($business->mio_id);
            $this->parseIndustry($businessRemote[0], $business);
            usleep(200000);
        }
    }

    public function parseBusiness($businessRemote)
    {
        $businessEntityList = $this->restClient->getBusinessEntities($businessRemote->id);
        $organization = null;
        if (sizeof($businessEntityList) > 0) {
            $businessEntity = $businessEntityList[0];
            $organization = $this->organizationRepository->findByMioId($businessEntity->id);
            if (!$organization) {
                $organization = $this->organizationRepository->create([
                    'id' => Uuid::uuid4(),
                    'position' => null,
                    'name' => $businessEntity->name,
                    'full_name' => $businessEntity->full_name,
                    'iin' => $businessEntity->identification_number,
                    'description' => null,
                    'is_individual' => $businessEntity->is_individual,
                    'mio_id' => $businessEntity->id
                ]);
            }
        }

        $localDistrict = null;
        $district = null;
        $business = $this->businessRepository->findByMioId($businessRemote->id);
        $isNewBusiness = false;
        if (!$business) {
            $isNewBusiness = true;
            $city = null;
            if ($businessRemote->district) {
                $localDistrict = $this->checkAndCreateLocalDistrict($businessRemote->district);
                $district = $localDistrict->district;
                $city = $district->city;
            }
            if ($businessRemote->region) {
                $district = $this->checkAndCreateDistrict($businessRemote->region);
                $city = $district->city;
            }
            $lat = 0;
            $long = 0;

            if ($businessRemote->location instanceof \stdClass) {
                $long = $businessRemote->location->coordinates[1];
                $lat = $businessRemote->location->coordinates[0];
            } else {
                $long = $businessRemote->location['coordinates'][1];
                $lat = $businessRemote->location['coordinates'][0];
            }

            $business = $this->businessRepository->create([
                'id' => Uuid::uuid4(),
                'organization_id' => optional($organization)->id,
                'name' => $businessRemote->name,
                'display_name' => $businessRemote->display_name,
                'address_line' => $businessRemote->address_line,
                'address_line_stat' => $businessRemote->address_line_stat,
                'source' => $businessRemote->source,
                'employee_count' => $businessRemote->employee_count,
                'has_cash_register' => $businessRemote->has_cash_register,
                'cash_register_count' => $businessRemote->cash_register_count,
                'has_payment_terminal' => $businessRemote->has_payment_terminal,
                'need_to_contact' => $businessRemote->need_to_contact,
                'refused_to_provide_identification_number' => $businessRemote->refused_to_provide_identification_number,
                'identification_number_not_found_in_stat' => $businessRemote->identification_number_not_found_in_stat,
                'status' => $businessRemote->status,
                'status_changed' => Helper::dateToUtcMIO($businessRemote->status_changed),
                'created' => Helper::dateToUtcMIO($businessRemote->created),
                'modified' => Helper::dateToUtcMIO($businessRemote->modified),
                'location_long' => $long,
                'location_lat' => $lat,
                'mio_id' => $businessRemote->id,
                'district_id' => optional($district)->id,
                'region_id' => optional($localDistrict)->id,
                'city_id' => optional($city)->id,
                'source_type_id' => $businessRemote->status === 'ACCEPTED_BY_CALL_CENTER' ? SourceTypeEnum::CALL_CENTER : SourceTypeEnum::MIO
            ]);

            $business = $this->businessRepository->autoAssignDistributor($business->id);
            foreach ($businessRemote->activity_subclasses as $businessActivitySubclass) {
                $activitySubclass = $this->checkAndCreateActivitySubclass($businessActivitySubclass);
                $this->businessActivityTypeRepository->create([
                    'id' => Uuid::uuid4(),
                    'business_id' => $business->id,
                    'activity_type_id' => $activitySubclass->id
                ]);
            }

            $business = $this->parseIndustry($businessRemote, $business);

//            $i = 0;
//            foreach ($businessRemote->industries as $businessIndustry) {
//                $workingIndustry = $this->checkAndCreateWorkingIndustry($businessIndustry);
//                $this->businessWorkingIndustriesRepository->create([
//                    'id' => Uuid::uuid4(),
//                    'business_id' => $business->id,
//                    'working_industry_id' => $workingIndustry->id
//                ]);
//
//                if($i == 0){
//                    $business = $this->businessRepository->setWorkingType(
//                        $business->id,
//                        $workingIndustry->workingIndustryType->workingType->id
//                    );
//                }
//
//                $i++;
//            }
//            if($i == 0){
//                $business = $this->businessRepository->setWorkingType(
//                    $business->id,
//                    'd00cbf0e-8604-4f08-8de0-7d6a791f7cfe'
//                );
//            }
        }

        $businessRequestList = $this->restClient->getBusinessRequests($businessRemote->id);
//        dd($businessRequestList);
        // Те категории потребностей которых не нужно записывать
        $banRequests = ["9753ea34-ceaa-4d77-96d3-a9769be87c82",
            "6c8cf2ed-765f-4624-abea-7de12aeb6f83",
            "f49ea204-4321-40ad-90e7-2d2bc9ca88eb",
            "ce899c1c-931d-4aac-a3aa-0e55a3d9a9cc",
            "20d47f1e-1b63-4e2b-8b83-a714644043b1",];
        foreach ($businessRequestList as $businessRequest) {
            $requestArray = (array)$businessRequest;
//            dd(!in_array($requestArray["requirement"], $banRequests));
            if (!$this->appealRepository->findByMioId($businessRequest->id)
                && strtotime($businessRemote->modified) <= strtotime($businessRequest->modified)
                && !in_array($requestArray["requirement"], $banRequests)) {
                $categoryMap = $this->checkAndCreateExternalCategory($businessRequest->requirement);
                if(isset($categoryMap)) {
                    $serviceGroup = $this->serviceGroupRepository->find($categoryMap->service_group_id);
                }
                $externalCategory = $this->externalCategoryRepository->find($businessRequest->requirement);

                $appeal = $this->appealRepository->create([
                    'id' => Uuid::uuid4(),
                    'category_id' => $categoryMap->service_group_id ?? null,
                    'type_id' => null,
                    'content' => isset($serviceGroup) && $serviceGroup->name == 'Финансирование' || $serviceGroup->name == 'Бесплатное обучение' || $serviceGroup->name == 'Потребность в кадрах' ? $serviceGroup->name : '',
                    'createDate' => Helper::dateToUtcMIO($businessRequest->created),
                    'updateDate' => Helper::dateToUtcMIO($businessRequest->modified),
                    'user_id' => null,
                    'appeal_status_id' => AppealStatusEnum::Pending,
                    'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
                    'district_id' => optional($district)->id,
                    'last_executor_id' => null,
                    'last_coexecutor_id' => null,
                    'appeal_result_type_id' => null,
                    'mio_id' => $businessRequest->id,
                    'business_id' => $business->id,
                    'source_type_id' => $business->source_type_id,
                    'external_category_id' => $categoryMap->external_category_id
                ]);

                if (env('CAMUNDA_SEND') != true) {
                    $this->appealForDistributorRepository->autoAssignDistributor($appeal->id);
                }
            }
        }
        try {
            if ($isNewBusiness && sizeof($businessRequestList) === 0 && $business->status === 'ACCEPTED_BY_CALL_CENTER') {
                $this->businessRepository->update(
                    $business->id,
                    [
                        'last_call_date' => Carbon::now(),
                    ]
                );
            }
        } catch (\Exception $e) {
            Log::error($business->id);
            report($e);

            throw $e;
        }

//        $businessPhotoList = $this->restClient->getBusinessPhotos($businessRemote->id);
//        foreach ($businessPhotoList as $businessPhoto) {
//            if (!$this->businessPhotoRepository->findByMioId($businessPhoto->id)) {
//                try {
//
//                    if ($businessPhoto->photo_url) {
//                        $name = '';
//                        $fileName = null;
//                        $fileName = Str::random(40) . '.' . substr($businessPhoto->photo_url, strrpos($businessPhoto->photo_url, '.') + 1);
//                        $name = 'appeals/' . $fileName;
//                        $contents = file_get_contents($businessPhoto->photo_url);
//                        Storage::put($name, $contents);
//
//
//                        $this->businessPhotoRepository->create([
//                            'id' => Uuid::uuid4(),
//                            'description' => $businessPhoto->description,
//                            'photo_url' => $businessPhoto->photo_url,
//                            'business_id' => $business->id,
//                            'mio_id' => $businessPhoto->id,
//                            'photo' => new File(Storage::path($name)),
//                            'file_name' => $fileName
//                        ]);
//                        Storage::delete($name);
//                    }
//                } catch (\Exception $e) {
//                    report($e);
//                }
//            }
//        }
        $businessContactList = $this->restClient->getBusinessContacts($businessRemote->id);
        foreach ($businessContactList as $businessContact) {
            if (!$this->businessContactRepository->findByMioId($businessContact->id)) {
                $this->businessContactRepository->create([
                    'id' => Uuid::uuid4(),
                    'full_name' => $businessContact->full_name,
                    'phone_number' => $businessContact->phone_number,
                    'business_id' => $business->id,
                    'mio_id' => $businessContact->id
                ]);
            }
        }
//       usleep(500000);
    }

    public function updateBusinessLocation()
    {
        $this->restClient->auth();

        $chunkCount = 500;
        $offset = 0;
        $lastSuccessedMioIntegrationDate = '2021-09-09';
        try {
            $businessCount = $this->restClient->getBusinessCount('ACCEPTED', $lastSuccessedMioIntegrationDate);
            while ($offset < $businessCount) {
                $businessList = $this->restClient->getBusiness($chunkCount, $offset, 'ACCEPTED', $lastSuccessedMioIntegrationDate);
                foreach ($businessList as $businessRemote) {
                    $business = $this->businessRepository->findByMioId($businessRemote->id);
                    if ($business) {
                        $city = null;
                        if ($businessRemote->district) {
                            $localDistrict = $this->checkAndCreateLocalDistrict($businessRemote->district);
                            $district = $localDistrict->district;
                            $city = $district->city;
                        }
                        if ($businessRemote->region) {
                            $district = $this->checkAndCreateDistrict($businessRemote->region);
                            $city = $district->city;
                        }
                        $this->businessRepository->update($business->id, [
                            'district_id' => optional($district)->id,
                            'region_id' => optional($localDistrict)->id,
                            'city_id' => optional($city)->id
                        ]);
                    }
                }
                $offset += $chunkCount;
            }
        } catch (\Exception $e) {
            report($e);

            $this->sendNotification($e->getMessage());
        }
    }

    private function sendNotification($message)
    {
        try {
            $role = RoleIntEnum::Administrator;
            $users = User::whereHas('roles', function ($q) use ($role) {
                $q->where('role_id', $role);
            })->get();

            Notification::send($users, new MioIntegrationError($message));
        } catch (\Exception $e) {
            report($e);
        }
    }

    private function parseIndustry($businessRemote, $business)
    {
        $i = 0;
        try {
            foreach ($businessRemote->industries as $businessIndustry) {
                $workingIndustry = $this->checkAndCreateWorkingIndustry($businessIndustry);
                $this->businessWorkingIndustriesRepository->create([
                    'id' => Uuid::uuid4(),
                    'business_id' => $business->id,
                    'working_industry_id' => $workingIndustry->id
                ]);

                if ($i == 0) {
                    $business = $this->businessRepository->setWorkingType(
                        $business->id,
                        $workingIndustry->workingIndustryType->workingType->id
                    );
                }

                $i++;
            }
            if ($i == 0) {
                $business = $this->businessRepository->setWorkingType(
                    $business->id,
                    'd00cbf0e-8604-4f08-8de0-7d6a791f7cfe'
                );
            }

            return $business;
        } catch (\Exception $e) {
            Log::error($businessRemote->id);
            report($e);
        }
    }

    private function checkAndCreateLocalDistrict($remoteDistrictId): Region
    {
        $localDistrict = $this->regionRepository->findByMioId($remoteDistrictId);
        if (!$localDistrict) {
            $remoteDistrict = $this->restClient->getDistrict($remoteDistrictId);
            $district = $this->checkAndCreateDistrict($remoteDistrict->region);
            $localDistrict = $this->regionRepository->create([
                'id' => Uuid::uuid4(),
                'name' => $remoteDistrict->name ?? 'Другое',
                'district_id' => $district->id,
                'mio_id' => $remoteDistrictId
            ]);
        }
        return $localDistrict;
    }

    private function checkAndCreateDistrict($remoteRegionId): District
    {
        $district = $this->districtRepository->findByMioId($remoteRegionId);
        if (!$district) {
            $remoteDistrict = $this->restClient->getRegion($remoteRegionId);
            $city = $this->checkAndCreateCity($remoteDistrict->city);
            $district = $this->districtRepository->create([
                'id' => Uuid::uuid4(),
                'name' => $remoteDistrict->name,
                'city_id' => $city->id,
                'mio_id' => $remoteDistrict->id
            ]);
        }
        return $district;
    }

    private function checkAndCreateCity($remoteCityId): City
    {
        $city = $this->cityRepository->findByMioId($remoteCityId);
        if (!$city) {
            $remoteCity = $this->restClient->getCity($remoteCityId);
            $city = $this->cityRepository->create([
                'id' => Uuid::uuid4(),
                'name' => $remoteCity->name,
                'mio_id' => $remoteCity->id
            ]);
        }
        return $city;
    }

    public function checkAndCreateExternalCategory($remoteRequirementId)
    {
        //проверить CategoryMap
        $categoryMap = $this->categoryMapRepository->findByExternalId($remoteRequirementId);
        if ($categoryMap) {
            return $categoryMap;
        } else {
            //если нет то создать external_categories и добавить в CategoryMap с нашей категорией Другое

            $externalCategory = $this->externalCategoryRepository->find($remoteRequirementId);
            if (!$externalCategory) {
                $remoteRequirement = $this->restClient->getRequirement($remoteRequirementId);
                $this->externalCategoryRepository->create([
                    'id' => $remoteRequirementId,
                    'name' => $remoteRequirement->name
                ]);
            }

            $this->categoryMapRepository->create([
                'id' => Uuid::uuid4(),
                'service_group_id' => '17fca7d8-47ce-4c98-abb6-ee3bb405a9db', //Другое
                'external_category_id' => $externalCategory->id
            ]);
        }
    }

    public function checkAndCreateServiceGroup($remoteRequirementId): ServiceGroup
    {
        $serviceGroup = $this->serviceGroupRepository->findByMioId($remoteRequirementId);
        if (!$serviceGroup) {
            $remoteRequirement = $this->restClient->getRequirement($remoteRequirementId);
            $requirementType = null;
            if ($remoteRequirement->requirement_type) {
                $requirementType = $this->checkAndCreatRequirementType($remoteRequirement->requirement_type);
            }
            if ($remoteRequirement->name) {
                $serviceGroup = $this->serviceGroupRepository->create([
                    'id' => Uuid::uuid4(),
                    'name' => $remoteRequirement->name,
                    'description' => $remoteRequirement->description,
                    'requirement_type_id' => optional($requirementType)->id,
                    'order_no' => 0,
                    'mio_id' => $remoteRequirementId
                ]);
            } else {
                $serviceGroup = $this->serviceGroupRepository->find('17fca7d8-47ce-4c98-abb6-ee3bb405a9db');
            }
        }

        return $serviceGroup;
    }

    private function checkAndCreatRequirementType($remoteRequirementTypeId): RequirementType
    {
        $requirementType = $this->requirementTypeRepository->findByMioId($remoteRequirementTypeId);

        if (!$requirementType) {
            $remoteRequirementType = $this->restClient->getRequirementType($remoteRequirementTypeId);
            $requirementType = $this->requirementTypeRepository->create([
                'id' => Uuid::uuid4(),
                'name' => $remoteRequirementType->name,
                'description' => $remoteRequirementType->description,
                'mio_id' => $remoteRequirementType->id
            ]);
        }

        return $requirementType;
    }

    private function checkAndCreateActivitySubclass1($remoteBusinessActivitySubclassId): ?ActivityType
    {
        if(!$this->activityTypeRepository->findByMioId($remoteBusinessActivitySubclassId)) {
            return null;
        }
        return $this->activityTypeRepository->findByMioId($remoteBusinessActivitySubclassId);
    }

    private function checkAndCreateActivitySubclass($remoteBusinessActivitySubclassId): ActivityType
    {
        $activitySubclass = $this->activityTypeRepository->findByMioId($remoteBusinessActivitySubclassId);

        if (!$activitySubclass) {
            $remoteBusinessActivitySubclass = $this->restClient->getActivitySubClass($remoteBusinessActivitySubclassId);
//            Log::info('checkAndCreateActivitySubclass ' . $remoteBusinessActivitySubclassId . ' | ' . json_encode($remoteBusinessActivitySubclass));
            usleep(500000);
//            Log::info('checkAndCreateActivitySubclass sleep');
            $activityClass = $this->checkAndCreateActivityClass($remoteBusinessActivitySubclass->activity_class);
            $activitySubclass = $this->activityTypeRepository->createByParams(
                $remoteBusinessActivitySubclass->code,
                $remoteBusinessActivitySubclass->name,
                $remoteBusinessActivitySubclass->tags,
                $activityClass->id,
                ActivityNodeTypeEnum::ActivitySubClass,
                $remoteBusinessActivitySubclass->id
            );
        }

        return $activitySubclass;
    }

    private function checkAndCreateActivityClass($remoteBusinessActivityClassId): ActivityType
    {
        $activityClass = $this->activityTypeRepository->findByMioId($remoteBusinessActivityClassId);

        if (!$activityClass) {
            $remoteBusinessActivityClass = $this->restClient->getActivityClass($remoteBusinessActivityClassId);
//            Log::info('checkAndCreateActivityClass ' . $remoteBusinessActivityClassId . ' | ' . json_encode($remoteBusinessActivityClass));
            usleep(500000);
//            Log::info('checkAndCreateActivityClass sleep');
            $activityGroup = $this->checkAndCreateActivityGroup($remoteBusinessActivityClass->activity_group);
            $activityClass = $this->activityTypeRepository->createByParams(
                $remoteBusinessActivityClass->code,
                $remoteBusinessActivityClass->name,
                $remoteBusinessActivityClass->tags,
                $activityGroup->id,
                ActivityNodeTypeEnum::ActivityClass,
                $remoteBusinessActivityClass->id
            );
        }

        return $activityClass;
    }

    private function checkAndCreateActivityGroup($remoteBusinessActivityGroupId): ActivityType
    {
        $activityGroup = $this->activityTypeRepository->findByMioId($remoteBusinessActivityGroupId);
        if (!$activityGroup) {
//            Log::info('checkAndCreateActivityGroup ' . $remoteBusinessActivityGroupId);
            $remoteBusinessActivityGroup = $this->restClient->getActivityGroup($remoteBusinessActivityGroupId);
//            Log::info('checkAndCreateActivityGroup ' . $remoteBusinessActivityGroupId . ' | ' . json_encode($remoteBusinessActivityGroup));
            usleep(500000);
//            Log::info('checkAndCreateActivityGroup sleep');
            $activitySection = $this->checkAndCreateActivitySection($remoteBusinessActivityGroup->activity_section);

            $activityGroup = $this->activityTypeRepository->createByParams(
                $remoteBusinessActivityGroup->code,
                $remoteBusinessActivityGroup->name,
                null,
                $activitySection->id,
                ActivityNodeTypeEnum::ActivityGroup,
                $remoteBusinessActivityGroup->id
            );
        }
        return $activityGroup;
    }

    private function checkAndCreateActivitySection($remoteBusinessActivitySectionId): ActivityType
    {
        $activityGroup = $this->activityTypeRepository->findByMioId($remoteBusinessActivitySectionId);
        if (!$activityGroup) {
//            Log::info('checkAndCreateActivitySection ' . $remoteBusinessActivitySectionId);
//            Log::info('1 - ' . $remoteBusinessActivitySection);
            $remoteBusinessActivitySection = $this->restClient->getActivitySection($remoteBusinessActivitySectionId);
//            Log::info('checkAndCreateActivitySection ' . $remoteBusinessActivitySectionId . ' | ' . json_encode($remoteBusinessActivitySection));
            usleep(500000);
//            Log::info('checkAndCreateActivitySection sleep');
//            Log::info('2 - ' . $remoteBusinessActivitySection->id . ' / ' . $remoteBusinessActivitySection->activity_type);
            $activityType = $this->checkAndCreateActivityType($remoteBusinessActivitySection->activity_type);
            $activityGroup = $this->activityTypeRepository->createByParams(
                $remoteBusinessActivitySection->code,
                $remoteBusinessActivitySection->name,
                null,
                $activityType->id,
                ActivityNodeTypeEnum::ActivitySection,
                $remoteBusinessActivitySection->id
            );
        }
        return $activityGroup;
    }

    private function checkAndCreateActivityType($remoteBusinessActivityTypeId): ActivityType
    {
        $activityType = $this->activityTypeRepository->findByMioId($remoteBusinessActivityTypeId);
        if (!$activityType) {
            $remoteBusinessActivityType = $this->restClient->getActivityType($remoteBusinessActivityTypeId);

            $activityType = $this->activityTypeRepository->createByParams(
                $remoteBusinessActivityType->code,
                $remoteBusinessActivityType->name,
                null,
                null,
                ActivityNodeTypeEnum::ActivityType,
                $remoteBusinessActivityType->id
            );
        }
        return $activityType;
    }

    private function checkAndCreateWorkingIndustry($remoteBusinessIndustryId): ?\Illuminate\Database\Eloquent\Model
    {
        $workingIndustry = $this->workingIndustryRepository->findByMioId($remoteBusinessIndustryId);
        if (!$workingIndustry) {
            $remoteIndustry = $this->restClient->getIndustry($remoteBusinessIndustryId);
            $workingIndustryType = $this->checkAndCreateWorkingIndustryType($remoteIndustry->industry_type);
            $activitySubclass = $remoteIndustry->activity_subclass ? $this->checkAndCreateActivitySubclass($remoteIndustry->activity_subclass) : null;

            $workingIndustry = $this->workingIndustryRepository->create([
                'name' => $remoteIndustry->name ? $remoteIndustry->name : '',
                'working_industry_type_id' => $workingIndustryType->id,
                'activity_type_id' => optional($activitySubclass)->id,
                'mio_id' => $remoteIndustry->id
            ]);
        }
        return $workingIndustry;
    }

    private function checkAndCreateWorkingIndustryType($remoteBusinessIndustryTypeId): ?\Illuminate\Database\Eloquent\Model
    {
        $workingIndustryType = $this->workingIndustryTypeRepository->findByMioId($remoteBusinessIndustryTypeId);

        if (!$workingIndustryType) {
            $remoteIndustryType = $this->restClient->getIndustryType($remoteBusinessIndustryTypeId);
            $workingType = $this->workingTypeRepository->findByMioId($remoteIndustryType->industry_category);

            $workingIndustryType = $this->workingIndustryTypeRepository->create([
                'name' => $remoteIndustryType->name,
                'working_type_id' => $workingType->id,
                'mio_id' => $remoteIndustryType->id
            ]);
        }

        return $workingIndustryType;
    }

    public function createForm(){
        return view('file-upload');
    }
    public function fileUploadBus($request){
//        $excel = Excel::toArray(new EntityBusImport, public_path().'/files/integration/business_entities_25-06-2022.xlsx');
        $fileModel = new FileUpload();
        if($request->file()) {
            $fileName = $request->file->getClientOriginalName();
//            $filePath = $req->file('file')->storeAs( . $fileName);
            $filePath = $request->file('file')->storeAs('\files\integration', $fileName, 'public');
            $this->uploadFileBusEn($filePath);
//            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
//            dd(fopen($req->file('file'), "r"));
//            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
//            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
//            $fileModel->file_path = '/storage/' . $filePath;
//            $fileModel->save();
            return back()
                ->with('success','Данные успешно загружены')
                ->with('file', $fileName, $filePath);
        }
    }
}
