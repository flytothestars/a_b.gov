<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Imports\EntityBusImport;
use App\Repositories\Enums\SourceTypeEnum;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Kreait\Firebase\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;

class FileUploadController extends Controller
{
    public function createForm(){
        return view('file-upload');
    }
    public function fileUploadBus(Request $req){
        $req->validate([
            'file' => 'required|mimes:xlx,xlsx,csv,txt|max:3072'
        ]);
//        $excel = Excel::toArray(new EntityBusImport, public_path().'/files/integration/business_entities_25-06-2022.xlsx');
//        $fileModel = new FileUpload();
        if($req->file()) {
            $fileName = $req->file->getClientOriginalName();
//            $filePath = $req->file('file')->storeAs( . $fileName);
            $filePath = $req->file('file')->storeAs('\files\integration', $fileName, 'public');
//            dd($filePath);
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

    public function uploadFileDelete($file) {
        if(unlink(storage_path('app\public\files\integration/'.$file))) {
            echo 'Успешно удалено!';
        }
    }

//    public function uploadFileBusEn()
//    {
//        $excel = Excel::toArray(new EntityBusImport, public_path().'/files/integration/business_entities_25-06-2022.xlsx');
//        $data = $excel[0];
//        foreach ($data as $row) {
//            if($row[0] == 'business_entities_25-06-2022') {
//                continue;
//            } else {
//                //dd($row);
//                $organization = null;
//                $organization = $this->organizationRepository->findByMioId($row[21]);
//
//                if (isset($row[21]) && !$organization) {
//                    $organization = $this->organizationRepository->create([
//                        'id' => Uuid::uuid4(),
//                        'position' => null,
//                        'name' => $row[22] ?? null,
//                        'full_name' => $row[23] ?? null,
//                        'iin' => $row[24] ?? null,
//                        'description' => null,
//                        'is_individual' => !($row[26] != True),
//                        'mio_id' => $row[21] != '' ? $row[21] : null
//                    ]);
//                }
//
//                $localDistrict = null;
//                $district = null;
//                $business = $this->businessRepository->findByMioId($row[0]);
//
//                $isNewBusiness = false;
//                if (!$business) {
//                    $isNewBusiness = true;
//                    $city = null;
//                    if ($row[7]) {
//                        $localDistrict = $this->checkAndCreateLocalDistrict($row[7]);
//                        $district = $localDistrict->district;
//                        $city = $district->city;
//                    }
//                    if ($row[6]) {
//                        $district = $this->checkAndCreateDistrict($row[6]);
//                        $city = $district->city;
//                    }
//                    $lat = 0;
//                    $long = 0;
//                    if(isset($row[3]) && $row[3] != '') {
//                        $location = explode(' ', $row[3]);
//                        $lat = explode('(', $location[2]);
//                        $long = explode(')', $location[3]);
//                        $lat = $lat[1];
//                        $long = $long[0];
//                    }
//
//                    $business = $this->businessRepository->create([
//                        'id' => Uuid::uuid4(),
//                        'organization_id' => optional($organization)->id ? optional($organization)->id : null,
//                        'name' => $row[1],
//                        'display_name' => $row[2],
//                        'address_line' => $row[4],
//                        'address_line_stat' => $row[5],
//                        'source' => $row[8],
//                        'employee_count' => $row[10],
//                        'has_cash_register' => $row[11],
//                        'cash_register_count' => $row[12],
//                        'has_payment_terminal' => false,
//                        'need_to_contact' => $row[13],
//                        'refused_to_provide_identification_number' => $row[14],
//                        'identification_number_not_found_in_stat' => $row[15],
//                        'status' => $row[16],
//                        'status_changed' => Helper::dateToUtcMIO($row[17]),
//                        'created' => Helper::dateToUtcMIO($row[18]),
//                        'modified' => Helper::dateToUtcMIO($row[19]),
//                        'location_long' => $long,
//                        'location_lat' => $lat,
//                        'mio_id' => $row[0],
//                        'district_id' => optional($district)->id ? optional($district)->id : null,
//                        'region_id' => $localDistrict != null && $localDistrict->id ? optional($localDistrict)->id : null,
//                        'city_id' => optional($city)->id ? optional($city)->id : null,
//                        'source_type_id' => $row[8] === 'FIELD_WORK' ? SourceTypeEnum::MIO : SourceTypeEnum::CALL_CENTER
//                    ]);
//                    $business = $this->businessRepository->autoAssignDistributor($row[0]);
//
//                    //contact
//                    if ($row[31] && $row[31] != null) {
//                        $contacts = explode(', ', $row[31]);
//                        foreach ($contacts as $contact) {
//                            if (!$this->businessContactRepository->findByMioId($contact)) {
//
//                                if ($business == null) {
//                                    $business = $this->businessRepository->findByMioId($row[0]);
//                                }
//                                $this->businessContactRepository->create([
//                                    'id' => Uuid::uuid4(),
//                                    'full_name' => $row[29],
//                                    'phone_number' => $row[30],
//                                    'business_id' => $business->id,
//                                    'mio_id' => $contact
//                                ]);
//                            }
//                        }
//
//                    }
//
////                    if (isset($row[20]) && $row != null) {
////                        $industry = explode(', ', $row[20]);
////                        if (count($industry) == 1) {
////                            continue;
////                        } else {
////                        }
////                        foreach ($industry as $ind) {
////                            $workingIndustry = $this->checkAndCreateWorkingIndustry($ind);
////                            $this->businessWorkingIndustriesRepository->create([
////                                'id' => Uuid::uuid4(),
////                                'business_id' => $business->id,
////                                'working_industry_id' => $workingIndustry->id
////                            ]);
////                        }
////                    }
//                    if(isset($row[9]) && $row[9] != null) {
//                        $activity_subclasses = explode(', ', $row[9]);
//                        foreach ($activity_subclasses as $businessActivitySubclass) {
//                            $activitySubclass = $this->checkAndCreateActivitySubclass1($businessActivitySubclass);
//                            if ($activitySubclass == null) {
//                                continue;
//                            }
//                            if ($business == null) {
//                                $business = $this->businessRepository->findByMioId($row[0]);
//                            }
//                            $this->businessActivityTypeRepository->create([
//                                'id' => Uuid::uuid4(),
//                                'business_id' => $business->id,
//                                'activity_type_id' => $activitySubclass->id
//                            ]);
//                        }
//                    }
//                    //dd($business);
//                }
//            }
//            //business_uid=0,name=1,display_name=2,location=3,address_line=4,address_line_stat=5,region_uid=6,
//            //district_uid=7,source=8,activity_subclasses=9,employee_count=10,has_cash_register=11,cash_register_count=12,
//            //need_to_contact=13,refused_to_provide_identification_number=14,identification_number_not_found_in_stat=15,
//            //status=16,status_changed=17,created=18,modified=19,industries=20,entities=21,entity_name=22,
//            //entity_full_name=23,entity_identification_number=24,entity_activity_codes=25,entity_is_individual=26,
//            //activity_comment=27,last_request_date=28
////        $handle = fopen('C:\1.xlsx', "r");
////        $header = true;
////        $data = Excel::import((object)BusunessEntityImport::class, 'C:\Users\admin\Downloads\business_requests_01_04_2022-06-06-2022 (1).xlsx');
////        $data = Excel::load()->get();
////        $content = file_get_contents('C:\Users\admin\Downloads\business_requests_01_04_2022-06-06-2022 (1).xlsx');
//
////        while ($csvLine = fgetcsv($handle, 1000, ",")) {
////            if ($header) {
////                $header = false;
////            } else {
////            }
////        }
//        }
//
//    }
}
