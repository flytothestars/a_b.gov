<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Integration\IMioIntegrationService;
use App\Mail\ServiceOrder;
use App\Repositories\IAppealRepository;
use App\Repositories\IBusinessRepository;
use App\Repositories\IFrontViewServiceGroupRepository;
use App\Repositories\INewsRepository;
use App\Repositories\IOrganizationRepository;
use App\Repositories\IPartnerRepository;
use App\Repositories\IServiceGroupRepository;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\ExportMio;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportHistory;

class IntegrationController extends Controller
{

    private $mioIntegrationService;
    private IAppealRepository $appealRepository;
    private IOrganizationRepository $organizationRepository;
    private IBusinessRepository $businessRepository;

    public function __construct(
        IMioIntegrationService  $mioIntegrationService,
        IAppealRepository       $appealRepository,
        IOrganizationRepository $organizationRepository,
        IBusinessRepository $businessRepository
    )
    {
        $this->mioIntegrationService = $mioIntegrationService;
        $this->appealRepository = $appealRepository;
        $this->organizationRepository = $organizationRepository;
        $this->businessRepository = $businessRepository;
    }

    public function testIntegration()
    {
        $this->mioIntegrationService->upload();
    }

    public function getHistory(){
        return Excel::download(new ExportHistory(),'history.xlsx',\Maatwebsite\Excel\Excel::XLSX);
    }

    public function mioGetStatus(){
        return Excel::download(new ExportMio(), 'mio_status.xlsx',\Maatwebsite\Excel\Excel::XLSX);
    }

    public function checkDuplicate(){
        $this->mioIntegrationService->checkDuplicate();
    }

    public function uploadFileBusEn($file, int $count)
    {
        $this->mioIntegrationService->uploadFileBusEn($file, $count);
    }

    public function uploadFileUpdate($file, $count)
    {
        $this->mioIntegrationService->uploadFileUpdate($file, $count);
    }

    public function uploadFileUpdateCreate($file, $count)
    {
        $this->mioIntegrationService->uploadFileUpdateCreate($file, $count);
    }

    public function createForm() {
        $this->mioIntegrationService->createForm();
    }

    public function fileUploadBus(Request $request) {
//        $request->validate([
//            'file' => 'required|mimes:csv,xlx,xlsx|max:2048'
//        ]);
        $this->mioIntegrationService->fileUploadBus($request);
    }

    public function fileUploadReq(Request $request) {
        $request->validate([
            'file' => 'required|mimes:csv,xlx,xlsx|max:2048'
        ]);
        $this->mioIntegrationService->fileUploadReq($request);
    }

    public function uploadFile($file, $count)
    {
        $this->mioIntegrationService->uploadFile($file, $count);
//         $originalFile   = file_get_contents('C:\Users\admin\Downloads\businesses_business_request.csv');
// //        dd($originalFile->getClientOriginalName());
// //        $filename = storage_path('app/' . 'integration' . '/' . 'businesses_business_request.csv');
//         $handle = fopen('C:\Users\admin\Downloads\businesses_business_request.csv', "r");
//         $header = true;

//         while ($csvLine = fgetcsv($handle, 1000, ",")) {

//             if ($header) {
//                 $header = false;
//             } else {
//                 dd($csvLine[0]);
//             }
//         }
//        }, file($csv));
    }

    public function testAppealUpdateIntegration()
    {
        $appeal = $this->appealRepository->find('036c9fa7-476b-4bd8-907d-fefeff3ea579');
        $this->appealRepository->update($appeal->id, [
            'category_id' => $appeal->category_id,
            'type_id' => $appeal->type_id,
            'content' => $appeal->content,
            'user_id' => $appeal->user_id,
            'distributor_id' => $appeal->distributor_id,
            'appeal_status_id' => $appeal->appeal_status_id,
            'client_appeal_status_id' => $appeal->client_appeal_status_id,
            'district_id' => $appeal->district_id,
            'comment' => $appeal->comment,
            'last_action_type_id' => $appeal->last_action_type_id,
            'last_executor_id' => $appeal->last_executor_id,
            'last_coexecutor_id' => $appeal->last_coexecutor_id,
            'appeal_result_type_id' => $appeal->appeal_result_type_id,
            'source_type_id' => $appeal->source_type_id,
            'mio_id' => $appeal->mio_id,
            'business_id' => $appeal->business_id,
            'flow_type_id' => $appeal->flow_type_id,
            'last_curator_upi_id' => $appeal->last_curator_upi_id,
            'last_curator_district_id' => $appeal->last_curator_district_id,
            'appeal_no' => $appeal->appeal_no,
            'industry_id' => $appeal->industry_id,
        ]);

        $appeal = $this->appealRepository->find('0a5815b9-b33b-4c78-8c86-b0199b0eba94');
        $this->appealRepository->update($appeal->id, [
            'category_id' => $appeal->category_id,
            'type_id' => $appeal->type_id,
            'content' => $appeal->content,
            'user_id' => $appeal->user_id,
            'distributor_id' => $appeal->distributor_id,
            'appeal_status_id' => $appeal->appeal_status_id,
            'client_appeal_status_id' => $appeal->client_appeal_status_id,
            'district_id' => $appeal->district_id,
            'comment' => $appeal->comment,
            'last_action_type_id' => $appeal->last_action_type_id,
            'last_executor_id' => $appeal->last_executor_id,
            'last_coexecutor_id' => $appeal->last_coexecutor_id,
            'appeal_result_type_id' => $appeal->appeal_result_type_id,
            'source_type_id' => $appeal->source_type_id,
            'mio_id' => $appeal->mio_id,
            'business_id' => $appeal->business_id,
            'flow_type_id' => $appeal->flow_type_id,
            'last_curator_upi_id' => $appeal->last_curator_upi_id,
            'last_curator_district_id' => $appeal->last_curator_district_id,
            'appeal_no' => $appeal->appeal_no,
            'industry_id' => $appeal->industry_id,
        ]);
    }

    public function testOrganisationIntegration()
    {
        $organization = $this->organizationRepository->find('5de690be-15d6-46d2-b22c-194db817e6d9');
        $this->organizationRepository->update($organization->id, [
            'name' => $organization->name,
            'position' => $organization->position,
            'iin' => $organization->iin,
            'description' => $organization->description,
            'is_individual' => $organization->is_individual,
            'mio_id' => $organization->mio_id,
            'full_name' => $organization->full_name,
        ]);
        $organization = $this->organizationRepository->find('fca5a3b5-21ca-4368-8428-128ddba07061');
        $this->organizationRepository->update($organization->id, [
            'name' => $organization->name,
            'position' => $organization->position,
            'iin' => $organization->iin,
            'description' => $organization->description,
            'is_individual' => $organization->is_individual,
            'mio_id' => $organization->mio_id,
            'full_name' => $organization->full_name,
        ]);
    }

    public function testBusinessIntegration()
    {
        $business = $this->businessRepository->find('6dc1b8e4-98cf-4e01-b8be-b8e68d88f984');
        $this->businessRepository->update($business->id, [
            'name' => $business->name,
            ]);
    }
}
