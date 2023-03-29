<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Mail\ServiceOrder;
use App\Models\Employer;
use App\Models\ServiceDetails;
use App\Repositories\Enums\ServiceCategoryEnum;
use App\Repositories\Enums\TypesAppealEnum;
use App\Repositories\ICategoryAppealRepository;
use App\Repositories\INewsRepository;
use App\Repositories\IPartnerRepository;
use App\Repositories\IServiceCategoryRepository;
use App\Repositories\IServiceGroupRepository;
use App\Repositories\ITypesAppealRepository;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\JsonResource;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExcelEmployers;
use App\Repositories\FreeEducationRepositoriy;
use App\Repositories\IServiceBanksRepository;

class ServiceController extends Controller
{
    private $typesAppealRepository;
    private $serviceCategoryRepository;
    private $categoryAppealRepository;
    private $freeEducationRepositoriy;
    private $servicebanks;

    public function __construct(
        ITypesAppealRepository $typesAppealRepository,
        ICategoryAppealRepository $categoryAppealRepository,
        IServiceCategoryRepository $serviceCategoryRepository,
        FreeEducationRepositoriy $freeEducationRepositoriy,
        IServiceBanksRepository $servicebanks
    ) {
        $this->typesAppealRepository = $typesAppealRepository;
        $this->serviceCategoryRepository = $serviceCategoryRepository;
        $this->categoryAppealRepository = $categoryAppealRepository;
        $this->freeEducationRepositoriy = $freeEducationRepositoriy;
        $this->servicebanks = $servicebanks;
    }

    public function index(): JsonResource
    {
        return DictResource::collection($this->serviceCategoryRepository
            ->all());
    }

    public function services($typesAppeal = null, $serviceGroup = null)
    {
        if ($typesAppeal === '-') {
            $typesAppeal = null;
        }
        if ($typesAppeal)
            $serviceGroupList = $this->serviceCategoryRepository->getListExistsInCategoryAppeals($typesAppeal);
        else
            $serviceGroupList = $this->serviceCategoryRepository->getTopList();

        $services = $this->categoryAppealRepository->getByServiceCategoryAndTypeAppeal($typesAppeal, $serviceGroup);
        //dd($services);
        if ($serviceGroup) {
            $currentServiceGroupName = ServiceCategoryEnum::GetServiceName($serviceGroup);
        } else {
            $currentServiceGroupName = "all";
        }
        //dd($services);
        return view('client.services.index')
            ->with([
                'serviceGroupList' => $serviceGroupList,
                'currentTypesAppeal' => $typesAppeal,
                'currentServiceGroup' => $serviceGroup,
                'services' => $services,
                'currentServiceGroupName' => $currentServiceGroupName,
            ]);
    }

    public function servicesDetail($service_type)
    {
        $serviceDetail = ServiceDetails::where('service_id','=',$service_type)->first();
        $service = $this->categoryAppealRepository->getByCategoryGroup('4077e367-e917-4ca5-8917-a65071885ea1')->where('id','=',$service_type)->first();
        $header = json_decode($serviceDetail->header);
        $content = json_decode($serviceDetail->content);
        return view('client.services.serviceDetail')->with(['service' => $service, 'serviceDetail' => $serviceDetail, 'header' => $header, 'content' => $content]);
    }

    public function businessAutomation(){
        $service = $this->categoryAppealRepository->getByCategoryGroup('4077e367-e917-4ca5-8917-a65071885ea1');
        return view('client.services.businessAutomation')->with(['services' => $service]);
    }

    public function financingPrograms($typesAppeal = null)
    {
        $financingPrograms = null;
        $serviceGroupId = ServiceCategoryEnum::FinancialServices;
        if ($typesAppeal != null) {
            $financingPrograms = $this->categoryAppealRepository->getByServiceCategoryAndTypeAppeal($typesAppeal, $serviceGroupId);
        } else {
            $financingPrograms = $this->categoryAppealRepository->getByCategoryGroup($serviceGroupId);
        }
        return view('client.services.financingPrograms')->with([
            'financingPrograms' => $financingPrograms,
            'currentTypesAppeal' => $typesAppeal
        ]);
    }


    public function freeEducation($typesAppeal = null)
    {
        if (is_null($typesAppeal)) {
            $typesAppeal = TypesAppealEnum::ForBeginner;
        }
        $freeEducations = $this->categoryAppealRepository->getByServiceCategoryAndTypeAppeal($typesAppeal, ServiceCategoryEnum::FreeEducation);

        return view('client.services.freeEducation')->with([
            'freeEducations' => $freeEducations,
            'currentTypesAppeal' => $typesAppeal
        ]);
    }
    public function detail($code = null)
    {
        $freeEducations = $this->freeEducationRepositoriy->getByCategory($code);
        $otherEducations = $this->categoryAppealRepository->getByServiceCategoryAndTypeAppeal(null, ServiceCategoryEnum::FreeEducation, $code);

        return view('client.services.freeEducationDeatils')->with([
            'freeEducations' => $freeEducations,
            'otherEducations' => $otherEducations
        ]);
    }

    public function financingProgramsDetail($finance_type)
    {
        $otherPrograms = $this->categoryAppealRepository->getByServiceCategoryAndTypeAppeal(null, ServiceCategoryEnum::FinancialServices);

        return view('client.services.financingProgramDetail')->with([
            'finance_type' => $finance_type,
            'otherPrograms' => $otherPrograms
        ]);
    }

    public function banks($action_type = null)
    {
        if ($action_type == 'openAccount') {
            $banks = $this->servicebanks->getAllToAccount();
        } else {
            $banks = $this->servicebanks->getAllToLoan();
        }
        // print "<pre>";
        // die(var_dump($banks));
        return view('client.services.banks')->with(["action_type" => $action_type, "banks" => $banks]);
    }
    public function bankDetail($action_type, $bankId)
    {
        if ($action_type == 'openAccount') {
            $bankData = $this->servicebanks->getToAccount($bankId);
        } else {
            $bankData = $this->servicebanks->getToLoan($bankId);
        }

        $otherPrograms = $this->categoryAppealRepository->getByServiceCategoryAndTypeAppeal(null, ServiceCategoryEnum::FinancialServices);

        // print "<pre>";
        // die(var_dump($bankData));
        return view('client.services.bankDetail')->with([
            'otherPrograms' => $otherPrograms,
            "bankData" => $bankData,
            'action_type' => $action_type,
        ]);
    }

    public function onlineCheckingBusinessRisk()
    {
        return view('client.forms.taxing');
    }

    public function checkingBusinessRisk($bin_iin)
    {
        // ini_set('memory_limit', '-1');
        // $excel = Excel::toArray(new ImportExcelEmployers, public_path().'/files/integration/employers.xlsx');
        // $data = $excel[1];
        // foreach($data as $row){
        //     $employer = new Employer();
        //     $employer->bin_iin = $row[0];
        //     $employer->count_np = 1;
        //     if($row[1] == 'высокая'){
        //         $employer->risk_degree = 'high';
        //     }else if($row[1] == 'средняя'){
        //         $employer->risk_degree = 'medium';
        //     }else if($row[1] == 'низкая'){
        //         $employer->risk_degree = 'low';
        //     }
        //     $employer->relevance_date = '2021-04-01'; 
        //     $employer->code_no = $row[2];
        //     $employer->save();
            
        // }
        $employer = Employer::where(['bin_iin' => $bin_iin])->first();
        if ($employer) {
            return response()->json(['status' => $employer->risk_degree]);
        } else {
            return response()->json(['message' => 'ИИН/БИН не найден в базе данных'], 404);
        }
    }

    public function industrialEnterprise(){
        return view('client.services.industrialEnterprise.index');
    }

    public function service_finance_ip_too(){
        return view('client.services.new_services.service');
    }   

    public function customsDutyService() {
        return view('client.services.customs.index');
    }
}