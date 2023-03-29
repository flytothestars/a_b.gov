<?php

namespace App\Http\Controllers;

use App\Mail\ServiceOrder;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\SourceTypeEnum;
use App\Repositories\IAppealDocumentRepository;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealStatusRepository;
use App\Http\Requests\AppealRequest;
use App\Repositories\IAppealRepository;
use App\Repositories\ICategoryAppealRepository;
use App\Repositories\IUserRepository;
use App\Repositories\IServiceGroupRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\IEFiles;;
use App\Exports\AppealsExport;
use Maatwebsite\Excel\Facades\Excel;
// test push
class AppealController extends Controller
{

    private $appealRepository;
    private $statusAppealRepository;
    private $categoryAppealRepository;
    private $userRepository;
    private $serviceGroupRepository;
    private IAppealForDistributorRepository $appealForDistributorRepository;
    private IAppealDocumentRepository $appealDocumentRepository;

    public function __construct(IAppealRepository               $appealRepository,
                                ICategoryAppealRepository       $categoryAppealRepository,
                                IUserRepository                 $userRepository,
                                IServiceGroupRepository         $serviceGroupRepository,
                                IAppealStatusRepository         $appealStatusRepository,
                                IAppealForDistributorRepository $appealForDistributorRepository,
                                IAppealDocumentRepository       $appealDocumentRepository
    )
    {
        $this->appealRepository = $appealRepository;
        $this->categoryAppealRepository = $categoryAppealRepository;
        $this->userRepository = $userRepository;
        $this->serviceGroupRepository = $serviceGroupRepository;
        $this->statusAppealRepository = $appealStatusRepository;
        $this->appealForDistributorRepository = $appealForDistributorRepository;
        $this->appealDocumentRepository = $appealDocumentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('category') && !empty(request()->get('category'))) {
            $params['category'] = explode(',', request()->get('category'));
            $appeals = $this->appealRepository->getAppealsByFilters($params);
        }

        if(request()->has('status') && !empty(request()->get('status'))) {
            $params['status'] = explode(',', request()->get('status'));
            $appeals = $this->appealRepository->getAppealsByFilters($params);
        }

        if (request()->has('period') && !empty(request()->get('period'))) {
            $params['period'] = explode(',', request()->get('period'));
            $appeals = $this->appealRepository->getAppealsByFilters($params);
        }

        if (!isset($appeals)) {
            $appeals = $this->appealRepository->getAppealsByUserId(Auth::user()->id);
        }

        $statuses = $this->statusAppealRepository->getAppealStatuesForClient();
        $categories = $this->serviceGroupRepository->all();
        $users = $this->userRepository->all();


        return view('client.appeals.index')
            ->with('appeals', $appeals)
            ->with('statuses', $statuses)
            ->with('categories', $categories)
            ->with('users', $users)
            ->with('draft', ClientAppealStatusEnum::Draft)
            ->with('appeal_active', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = $this->categoryAppealRepository->all();
        $service_groups = $this->serviceGroupRepository->getOurListOfCategory();


        return view('client.appeals.create')
            ->with('categories', $service_groups)
            ->with('types', $types)
            ->with('appeal_active', true);
    }

    public function store(AppealRequest $request)
    {
        try {
            DB::beginTransaction();
            $profile = Auth::user()->profile;
            $attributes = $request->validated() +
                [
                    'client_appeal_status_id' => $request->saveAsDraft ? ClientAppealStatusEnum::Draft : ClientAppealStatusEnum::InWork,
                    'appeal_status_id' => $request->saveAsDraft ? null : AppealStatusEnum::Pending,
                    'user_id' => $profile->user_id,
                    'source_type_id' => SourceTypeEnum::Portal
                ];

            $appeal_new = $this->appealRepository->create($attributes);
            
            if (array_key_exists('file', $attributes))
                foreach ($attributes['file'] as $file) {
                    $this->appealDocumentRepository->createClientDocument($appeal_new->id, $file);
                }

            if ($appeal_new->client_appeal_status_id == ClientAppealStatusEnum::InWork)
                $this->appealForDistributorRepository->autoAssignDistributor($appeal_new->id);

            // try {
                //dd($request->file());
                if($request->category_id == '6b82561d-48a3-43ca-9965-86b43491a03d'){
                    if($request->file()) {
                        //Get name 
                        //first
                        $fileName1 = time().'_'.$request->file1->getClientOriginalName();
                        $fileName2 = time().'_'.$request->file2->getClientOriginalName();
                        $fileName3 = time().'_'.$request->file3->getClientOriginalName();
                        $fileName4 = time().'_'.$request->file4->getClientOriginalName();
                        $fileName5 = time().'_'.$request->file5->getClientOriginalName();
                        $fileName6 = time().'_'.$request->file6->getClientOriginalName();
                        $fileName7 = time().'_'.$request->file7->getClientOriginalName();
                        $fileName8 = time().'_'.$request->file8->getClientOriginalName();
                        $fileName9 = time().'_'.$request->file9->getClientOriginalName();
                        $fileName10 = time().'_'.$request->file10->getClientOriginalName();
                        $fileName11 = time().'_'.$request->file11->getClientOriginalName();
                        $fileName12 = time().'_'.$request->file12->getClientOriginalName();
                        $fileName13 = time().'_'.$request->file13->getClientOriginalName();
                        //Save file on storage
                        $filePath1 = $request->file('file1')->storeAs('uploads/file1', $fileName1, 'public');
                        $filePath2 = $request->file('file2')->storeAs('uploads/file2', $fileName2, 'public');
                        $filePath3 = $request->file('file3')->storeAs('uploads/file3', $fileName3, 'public');
                        $filePath4 = $request->file('file4')->storeAs('uploads/file4', $fileName4, 'public');
                        $filePath5 = $request->file('file5')->storeAs('uploads/file5', $fileName5, 'public');
                        $filePath6 = $request->file('file6')->storeAs('uploads/file6', $fileName6, 'public');
                        $filePath7 = $request->file('file7')->storeAs('uploads/file7', $fileName7, 'public');
                        $filePath8 = $request->file('file8')->storeAs('uploads/file8', $fileName8, 'public');
                        $filePath9 = $request->file('file9')->storeAs('uploads/file9', $fileName9, 'public');
                        $filePath10 = $request->file('file10')->storeAs('uploads/file10', $fileName10, 'public');
                        $filePath11 = $request->file('file11')->storeAs('uploads/file11', $fileName11, 'public');
                        $filePath12 = $request->file('file12')->storeAs('uploads/file12', $fileName12, 'public');
                        $filePath13 = $request->file('file13')->storeAs('uploads/file13', $fileName13, 'public');
                        //Save on database
                        $iefiles = new IEFiles();
                        $iefiles->appeal_id = $appeal_new->id;
                        $iefiles->user_id = $profile->user_id;
                        $iefiles->file1 = $filePath1;
                        $iefiles->file2 = $filePath2;
                        $iefiles->file3 = $filePath3;
                        $iefiles->file4 = $filePath4;
                        $iefiles->file5 = $filePath5;
                        $iefiles->file6 = $filePath6;
                        $iefiles->file7 = $filePath7;
                        $iefiles->file8 = $filePath8;
                        $iefiles->file9 = $filePath9;
                        $iefiles->file10 = $filePath10;
                        $iefiles->file11 = $filePath11;
                        $iefiles->file12 = $filePath12;
                        $iefiles->file13 = $filePath13;
                        $iefiles->save();
    
                    }
                }
                else if($request->category_id == 'b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67'){
                    if($request->file()) {
                        //Get name 
                        //second
                        $fileName14 = time().'_'.$request->file1->getClientOriginalName();
                        $fileName15 = time().'_'.$request->file2->getClientOriginalName();
                        $fileName16 = time().'_'.$request->file3->getClientOriginalName();
                        $filePath14 = $request->file('file1')->storeAs('uploads/file14', $fileName14, 'public');
                        $filePath15 = $request->file('file2')->storeAs('uploads/file15', $fileName15, 'public');
                        $filePath16 = $request->file('file3')->storeAs('uploads/file16', $fileName16, 'public');
                        $iefiles = new IEFiles();
                        $iefiles->appeal_id = $appeal_new->id;
                        $iefiles->user_id = $profile->user_id;
                        $iefiles->file1 = $filePath14;
                        $iefiles->file2 = $filePath15;
                        $iefiles->file3 = $filePath16;
                        $iefiles->file4 = '';
                        $iefiles->file5 = '';
                        $iefiles->file6 = '';
                        $iefiles->file7 = '';
                        $iefiles->file8 = '';
                        $iefiles->file9 = '';
                        $iefiles->file10 = '';
                        $iefiles->file11 = '';
                        $iefiles->file12 = '';
                        $iefiles->file13 = '';
                        $iefiles->save();
                    }
                }
                
            // } catch (\Throwable $th) {
            //     //throw $th;
            // }
            
            DB::commit();
            
            $str = "";
            /*  if($request->file()){
                  foreach($request->file('file') as $file)
                  {
                      //print "<pre>";die(var_dump($file));
                      $str .= $file->getClientOriginalName();
                      $fileName = time() . '_' . $file->getClientOriginalName();
                      $filePath = $file->storeAs('public/appeals', $fileName);

                      $data = [
                          'storable_id' => $appeal_new->id,
                          'storable_type' => \App\Models\Appeal::class,
                          'path' => 'appeals/' . $fileName,
                          'file_type' => 'document'
                      ];

                      StorageFile::query()->create($data);

                  }
              }*/

            try {
                if (!$request->saveAsDraft) {
                    Mail::to(env('MAIL_TO_ADDRESS'))->send(new ServiceOrder([
                        'serviceName' => $appeal_new->category->name,
                        'fio' => $profile->last_name . ' ' . $profile->first_name,
                        'phone' => Auth::user()->phone,
                        'question' => $appeal_new->content
                    ]));
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }

        session()->flash('successModal', $appeal_new->appeal_no);

        return redirect()->route('appeals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Appeal $appeal
     * @return \Illuminate\Http\Response
     */
    public function show($appealCode)
    {
        $appeal = $this->appealRepository->getByCode($appealCode);
        $iefile = IEFiles::where('appeal_id', '=', $appealCode)->first();
        //dd($iefile);
        return view('client.appeals.show')
            ->with('appeal', $appeal)
            ->with('iefiles', $iefile)
            ->with('draft', ClientAppealStatusEnum::Draft);
    }

    public function edit($appealCode)
    {
        //
        $appeal = $this->appealRepository->getByCode($appealCode);
        $types = $this->categoryAppealRepository->all();
        $service_groups = $this->serviceGroupRepository->getOurListOfCategory();

        return view('client.appeals.edit')
            ->with('categories', $service_groups)
            ->with('types', $types)
            ->with('appeal', $appeal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Appeal $appeal
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appeal $appeal
     * @return \Illuminate\Http\Response
     */
    public function update(AppealRequest $request, $appealId)
    {
        try {

            DB::beginTransaction();
            $profile = Auth::user()->profile;
            $attributes = $request->validated() +
                [
                    'client_appeal_status_id' => $request->saveAsDraft ? ClientAppealStatusEnum::Draft : ClientAppealStatusEnum::Pending,
                    'appeal_status_id' => $request->saveAsDraft ? null : AppealStatusEnum::Pending,
                    'user_id' => $profile->user_id
                ];

            $appeal_new = $this->appealRepository->update($appealId, $attributes);

            if ($appeal_new->client_appeal_status_id == ClientAppealStatusEnum::Pending)
                $this->appealForDistributorRepository->autoAssignDistributor($appeal_new->id);

            DB::commit();


            /*if($request->file()){
                foreach($request->file('file') as $file)
                {
                    //print "<pre>";die(var_dump($file));
                    $str .= $file->getClientOriginalName();
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('public/appeals', $fileName);

                    $data = [
                        'storable_id' => $appealId,
                        'storable_type' => \App\Models\Appeal::class,
                        'path' => 'appeals/' . $fileName,
                        'file_type' => 'document'
                    ];

                    StorageFile::query()->create($data);

                }
            }*/


            if (!$request->saveAsDraft) {
                try {
                    Mail::to(env('MAIL_TO_ADDRESS'))->send(new ServiceOrder([
                        'serviceName' => $appeal_new->category->name,
                        'fio' => $profile->last_name . ' ' . $profile->first_name,
                        'phone' => Auth::user()->phone,
                        'question' => $appeal_new->content
                    ]));
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }


        return redirect()->route('appeals.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Appeal $appeal
     * @return \Illuminate\Http\Response
     */
    public function delete($appealCode)
    {

        $appeal = $this->appealRepository->deleteByCode($appealCode);

        return redirect()->route('appeals.index');
        //
    }

    public function send($appealCode)
    {
        $appeal = $this->appealRepository->getByCode($appealCode);
        $this->appealRepository->update($appeal->id, ['client_appeal_status_id' => ClientAppealStatusEnum::Pending]);
        $this->appealForDistributorRepository->autoAssignDistributor($appeal->id);
        //print"<pre>";die(var_dump($appeal));
        $profile = Auth::user()->profile;
        try {
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new ServiceOrder([
                'serviceName' => $appeal->category->name,
                'fio' => $profile->last_name . ' ' . $profile->first_name,
                'phone' => Auth::user()->phone,
                'question' => $appeal->content
            ]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->route('appeals.index');
        //
    }

    public function exportToExcel(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new AppealsExport($this->appealRepository->allByFilter($request->validated())), 'allAppeals.xlsx');
    }

    public function exportToExcelByAuthUser(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new AppealsExport($this->appealRepository->findAppealsByAuthUser($request->validated())), 'userAppeals.xlsx');
    }


}
