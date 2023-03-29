<?php

namespace App\Integration;

use App\Models\User;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Repositories\IAppealRepository;
use App\Repositories\IUserRepository;
use App\Repositories\IBusinessRepository;

use Illuminate\Support\Facades\Mail;
use App\Mail\DistributorTempl;
use App\Mail\HeadTempl;
use App\Mail\EmailEveryHourTempl;
use App\Mail\HeadAppealEveryEveningTempl;


class SendEmailService implements ISendEmailService
{
    private IAppealRepository $appealRepository;
    private IUserRepository $usersRepository;
    private IBusinessRepository $businessRepository;


    public function __construct(
        IAppealRepository $appealRepository,
        IUserRepository $usersRepository,
        IBusinessRepository $businessRepository
        )
    {
        $this->appealRepository = $appealRepository;
        $this->usersRepository = $usersRepository;
        $this->businessRepository = $businessRepository;
    }


    public function sendEmail()
    {
        $dataForManager = $this->_getDataForManager();
        //get heaed users
        $headusers = $this->usersRepository->getAllHead();

        if(!empty($dataForManager['user_names']) && !empty($dataForManager['final']) ){
                $user_names = $dataForManager['user_names'];
                $final = $dataForManager['final'];
                foreach($user_names as  $email=>$fio){ // loop throught all users
                    $postData = [
                        'appeals' => $final['appeals'][$email] ?? [],
                        'count_appeals' => isset($final['appeals'][$email]) ? count($final['appeals'][$email]) : 0,
                        'businesses' => $final['businesses'][$email] ?? [],
                        'count_businesses' => isset($final['businesses'][$email]) ? count($final['businesses'][$email]) : 0,
                        'fio' => $fio,
                        'date' => date('Y-m-d H:i:s') // get current date
                    ];
                    Mail::to($email)->send(new DistributorTempl($postData));
                }
        }

        if(!empty($headusers) && !empty($dataForManager['final_for_head'])){

            $final = $dataForManager['final_for_head'];
            foreach($headusers as $headuser){
                $postData = [
                    'appeals' => $final['appeals'] ?? [],
                    'count_appeals' => isset($final['appeals']) ? count($final['appeals']) : 0,
                    'businesses' => $final['businesses'] ?? [],
                    'count_businesses' => isset($final['businesses']) ? count($final['businesses']) : 0,
                    'fio' => optional($headuser)->last_name . " " . optional($headuser)->first_name . " " . optional($headuser)->second_name,
                    'date' => date('Y-m-d H:i:s') // get current date
                ];

                Mail::to($headuser->email)->send(new HeadTempl($postData));
            }
        }
    }

    public function sendEmailEveryHour()
    {
        $perioddate = date('Y-m-d H:i:s', strtotime('-1 hour'));

        $dataForManager = $this->_getData($perioddate);

        if (!empty($dataForManager['user_names']) && !empty($dataForManager['final'])) {
            $user_names = $dataForManager['user_names'];
            $final = $dataForManager['final'];
            foreach ($user_names as $email => $fio) { // loop throught all users
                $postData = [
                    'new_appeals' => $final['new_appeals'][$email] ?? [],
                    'count_new_appeals' => isset($final['new_appeals'][$email]) ? count($final['new_appeals'][$email]) : 0,
                    'appeals_for_approve' => $final['appeals_for_approve'][$email] ?? [],
                    'count_appeals_for_approve' => isset($final['appeals_for_approve'][$email]) ? count($final['appeals_for_approve'][$email]) : 0,
                    'fio' => $fio,
                    'date' => date('Y-m-d H:i:s') // get current date
                ];
                Mail::to($email)->send(new EmailEveryHourTempl($postData));
            }
        }
    }

    public function sendEmailEveryEvening(){
        $perioddate = date('Y-m-d 18:01:00', strtotime('-1 day'));
//        $perioddate = '2021-12-31 18:01:00';
        $dataForManager = $this->_getData( $perioddate);
        $headusers = $this->usersRepository->getAllHead();
        if(!empty($headusers) && !empty($dataForManager['final_for_head'])){

            $final = $dataForManager['final_for_head'];
            foreach($headusers as $headuser){
                $postData = [
                    'head_new_appeal' => $final['head_new_appeal'] ?? [],
                    'count_head_new_appeal' => isset($final['head_new_appeal'])? count($final['head_new_appeal']): 0,
                    'head_appeal_approve' => $final['head_appeal_approve'] ?? [],
                    'count_head_appeal_approve' =>isset($final['head_appeal_approve'])? count($final['head_appeal_approve']):0,
                    'fio' => optional($headuser)->last_name." ".optional($headuser)->first_name." ".optional($headuser)->second_name,
                    'date' => date('Y-m-d H:i:s') // get current date
                ];

                Mail::to($headuser->email)->send(new HeadAppealEveryEveningTempl($postData));
            }

//            $headuser = User::query()->where('id', 17)->first();
//                $fio = optional($headuser)->last_name." ".optional($headuser)->first_name." ".optional($headuser)->second_name;
//
//                $postData = [
//                'head_new_appeal' => isset($final['head_new_appeal'])? $final['head_new_appeal']: [],
//                'count_head_new_appeal' => isset($final['head_new_appeal'])? count($final['head_new_appeal']): 0,
//                'head_appeal_approve' => isset($final['head_appeal_approve'])? $final['head_appeal_approve']: [],
//                'count_head_appeal_approve' =>isset($final['head_appeal_approve'])? count($final['head_appeal_approve']):0,
//                'fio' => $fio,
//                'date' => date('Y-m-d H:i:s') // get current date
//                ];
//
//                Mail::to($headuser->email)->send(new HeadAppealEveryEveningTempl($postData));
        }

    }

    private function _getData($period){
        $newAppeals = $this->appealRepository->getNewAppealsForEmail($period);
        $appealsForApprove = $this->appealRepository->getAppealsForApprove($period);

        $user_new_appeals = []; // get appeals via user
        $user_appeals_for_approve = []; // get appeals for approve
        $user_names = []; // gather all emails from appeals
        $head_new_appeal = [];
        $head_appeal_approve = [];
        if(!empty($newAppeals)){
            foreach($newAppeals as $data){
                $user_names[$data->email]= optional($data)->last_name." ".optional($data)->first_name." ".optional($data)->second_name;
                $user_new_appeals[$data->email][optional($data)->iin.'_'.optional($data)->category_name] = $this->getAppealData($data);
                $head_new_appeal[optional($data)->iin.'_'.optional($data)->category_name] = $this->getAppealData($data);
            }
        }

        if (!empty($appealsForApprove)) {
            foreach ($appealsForApprove as $data) {
                $user_names[$data->email] = optional($data)->last_name . " " . optional($data)->first_name . " " . optional($data)->second_name;
                $user_appeals_for_approve[$data->email][optional($data)->iin . '_' . optional($data)->category_name] = $this->getAppealData($data);
                $head_appeal_approve[optional($data)->iin . '_' . optional($data)->category_name] = $this->getAppealData($data);
            }
        }

        $final = []; // finall array holds all data from appeals and businesses
        if (!empty($user_new_appeals)) {
            $final['new_appeals'] = $user_new_appeals;
        }

        if (!empty($user_appeals_for_approve)) {
            $final['appeals_for_approve'] = $user_appeals_for_approve;
        }

        $final_for_head = []; // finall array holds all data from appeals and businesses
        if (!empty($head_new_appeal)) {
            $final_for_head['head_new_appeal'] = $head_new_appeal;
        }

        if (!empty($head_appeal_approve)) {
            $final_for_head['head_appeal_approve'] = $head_appeal_approve;
        }

         return ['final'=>$final, 'user_names'=>$user_names, 'final_for_head'=>$final_for_head];
    }

    private function getAppealData($data){
        return array(
            'iin' => optional($data)->iin,
            'organizations_name' => optional($data)->organizations_name,
            'category_name' => optional($data)->category_name,
            'fio' => optional($data)->last_name . " " . optional($data)->first_name . " " . optional($data)->second_name
        );
    }


    private function _getDataForManager(){
        // sending manager
        $datas = $this->appealRepository->getDataForSendingEmailManager();

        $user_appeals = []; // get appeals via user
        $user_names = []; // gather all emails from appeals and businesses
        $head_appeal = [];
        if(!empty($datas)){
            foreach($datas as $data){
                $user_names[$data->email]= optional($data)->last_name." ".optional($data)->first_name." ".optional($data)->second_name;
                $user_appeals[$data->email][optional($data)->iin] = $this->getAppealData($data);
                $head_appeal[optional($data)->iin] = $this->getAppealData($data);
            }
        }

        $business_data = $this->businessRepository->getDataForSendingEmailBusinessManager();
        $user_business = []; // get businesses via user
        $head_business = [];
        if(!empty($business_data)){
            foreach($business_data as $business){
                $user_names[$business->email]= optional($business)->last_name." ".optional($business)->first_name." ".optional($business)->second_name;
                $user_business[$business->email][optional($business)->iin] = $this->getAppealData($business);

                $head_business[optional($business)->iin] = $this->getAppealData($business);
            }
        }

        $final=[]; // final array holds all data from appeals and businesses
        if(!empty($user_appeals)){
            $final['appeals'] =$user_appeals;
        }

        if(!empty($user_business)){
            $final['businesses'] =$user_business;
        }

        $final_for_head=[]; // finall array holds all data from appeals and businesses
        if(!empty($head_appeal)){
            $final_for_head['appeals'] = $head_appeal;
        }

        if(!empty($head_business)){
            $final_for_head['businesses'] =$head_business;
        }

        return ['final'=>$final, 'user_names'=>$user_names, 'final_for_head'=>$final_for_head];
    }
}
