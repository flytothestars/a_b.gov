<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Integration\IMioIntegrationService;
use App\Http\Requests\SearchServiceRequest;
use App\Mail\ServiceOrder;
use App\Repositories\IFrontViewServiceGroupRepository;
use App\Repositories\INewsRepository;
use App\Repositories\IPartnerRepository;
use App\Repositories\IServiceGroupRepository;
use App\Services\Camunda\ICamundaService;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CategoryAppeal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File;

class HomeController extends Controller
{
    private $serviceGroupRepository;
    private $newsRepository;
    private $partnerRepository;
    private ICamundaService $camundaService;

    public function __construct(
        IServiceGroupRepository          $serviceGroupRepository,
        IFrontViewServiceGroupRepository $frontViewServiceGroupRepository,
        INewsRepository                  $newsRepository,
        IPartnerRepository               $partnerRepository,
        ICamundaService $camundaService
    )
    {
        $this->serviceGroupRepository = $serviceGroupRepository;
        $this->newsRepository = $newsRepository;
        $this->partnerRepository = $partnerRepository;
        $this->frontViewServiceGroupRepository = $frontViewServiceGroupRepository;
        $this->camundaService = $camundaService;
    }

    public function index()
    {
        $serviceGroupList = $this->frontViewServiceGroupRepository->all();
        $newsList = $this->newsRepository->getTop(4);
        $partnerList = $this->partnerRepository->all();

        $uuid = Str::uuid()->toString();
        //dd($uuid);
        // dd(bcrypt('qwerty12345'));
        return view('client.index')
            ->with('serviceGroupList', $serviceGroupList)
            ->with('newsList', $newsList)
            ->with('partnerList', $partnerList);
    }

    public function about()
    {
        return view('client.about');
    }

    public function docs()
    {
        $files = File::all();
        return view('client.docs')
            ->with('files', $files);
    }

    public function download($type, $file){
        $path = public_path('files/' . $type . '/' . $file);
        return response()->download($path);
    }

    public function permittingDocuments()
    {
        return view('client.services.permittingDocuments');
    }


    public function servicesForm($serviceGroupId)
    {
        $serviceGroup = $this->serviceGroupRepository->find($serviceGroupId);

        return view('client.services.form')
            ->with('serviceGroup', $serviceGroup);
    }

    public function servicesFormSubmit(ServiceFormRequest $request)
    {
        try {
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new ServiceOrder($request->validated()));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return view('client.services.formComplete');
    }

    public function servicesForBeginnerEntrepreneur()
    {
        return view('client.services.servicesForBeginnerEntrepreneur');
    }

    public function servicesInfrastructure()
    {
        return view('client.services.servicesInfrastructure');
    }

    public function servicesForEntrepreneur()
    {
        return view('client.services.servicesForEntrepreneur');
    }

    public function testEmail()
    {
        Mail::to('biewaldroman@gmail.com')->send(new ServiceOrder([
            'serviceName' => 'Подбор финансирования',
            'fio' => 'Бивальд Роман',
            'phone' => '+77072274427',
            'question' => 'Тестовый вопрос'
        ]));
    }

    public function showServiceComplete()
    {
        return view('client.services.formComplete');
    }

    public function underConstruction()
    {
        return view('client.underConstruction');
    }

    public function businessPlanPreparation()
    {
        return view('client.services.businessPlanPreparation');
    }

    public function startBusiness()
    {
        return view('client.services.startBusiness');
    }

    public function searchService(SearchServiceRequest $request)
    {
        $s = $request->searchStr;

        $searchLists = CategoryAppeal::where('name', 'LIKE', '%' . $s . '%')
            ->orWhere('description','LIKE', '%' . $s . '%')
            ->get();
        //dd($searchLists);
        return view('client.search')
            ->with('searchLists', $searchLists);
    }

    public function testCamundaService()
    {
        echo $this->camundaService->getToken();
        echo $this->camundaService->getToken();
    }
}