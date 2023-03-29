<?php

namespace App\Http\Controllers\API\Camunda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Camunda\ClientSettingRequest;
use App\Http\Requests\Camunda\TaskRequest;
use App\Http\Resources\AppealHistoryResource;
use App\Repositories\IAppealHistoryRepository;
use App\Repositories\IAppealRepository;
use App\Services\Camunda\ICamundaService;
use App\Services\Camunda\ICamundaTaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class CamundaController extends Controller
{
    private ICamundaService $camundaService;
    private ICamundaTaskService $camundaTaskService;

    public function __construct(
        ICamundaService $camundaService,
        ICamundaTaskService $camundaTaskService
    )
    {
        $this->camundaService = $camundaService;
        $this->camundaTaskService = $camundaTaskService;
    }

    public function getClientSettings(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->camundaService->getClientSettings());
    }

    public function setClientSettings(ClientSettingRequest $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->validated();
        return response()->json($this->camundaService->setClientSettings($params));
    }

    public function getBpmnDiagramXml()
    {
        return response()->json($this->camundaService->getBpmnDiagramXml());
    }

    public function getBpmnHistory($id)
    {
        return response()->json($this->camundaService->getBpmnHistory($id));
    }

    public function testStart($id)
    {
        Log::info('0000');
        $this->camundaService->startProcess($id);
    }

    public function webHook($secretKey, Request $request)
    {

        if($secretKey != config('app.service.camunda.secret_key')){
            //Log::info('Camunda web hook response' . $secretKey);
            abort(404);
        }
//        Log::info('Camunda web hook response - ' . json_encode($request->get('externalTask')));
        $result = $this->camundaTaskService->externalTask($request->get('externalTask'));

        return response()->json($result,200);
    }

    public function getAvailableTask(TaskRequest $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->validated();
        return response()->json($this->camundaService->getAvailableTask($params));
    }
}
//{
//    "externalTask":{
//    "errorMessage":null,
//    "retries":null,
//    "businessKey":"ab4b0637-66fa-436a-83ba-36d07f883753",
//    "processInstanceId":"19312924-776f-11ec-8b8e-0242ac110002",
//    "processDefinitionKey":"Process_Upi_Qolday_Client_Request",
//    "processDefinitionId":"fa8640de-4d1f-11ec-8b8e-0242ac110002",
//    "errorDetails":null,
//    "tenantId":null,
//    "activityId":"Activity_Auto_Assign_ToWork",
//    "executionId":"19315038-776f-11ec-8b8e-0242ac110002",
//    "priority":0,
//    "topicName":"Topic_Client_Worker",
//    "workerId":"camunda-worker",
//    "id":"1931774a-776f-11ec-8b8e-0242ac110002",
//    "activityInstanceId":"Activity_Auto_Assign_ToWork:19315039-776f-11ec-8b8e-0242ac110002",
//    "variables":
//        {
//            "status":{"type":7, "value":"Pending"}
//        }
//    }
//}
