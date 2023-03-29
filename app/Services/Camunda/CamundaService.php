<?php

namespace App\Services\Camunda;

use App\Repositories\IAppealForCamundaRepository;
use App\Repositories\IRemoteServiceTokenRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CamundaService implements ICamundaService
{
    private IRemoteServiceTokenRepository $remoteServiceTokenRepository;
    private string $serviceName = 'camunda';
    private ?string $token = null;
    private IAppealForCamundaRepository $appealForCamundaRepository;

    public function __construct(
        IRemoteServiceTokenRepository $remoteServiceTokenRepository,
        IAppealForCamundaRepository $appealForCamundaRepository
    )
    {
        $this->remoteServiceTokenRepository = $remoteServiceTokenRepository;
        $this->appealForCamundaRepository = $appealForCamundaRepository;

        if(config('app.service.camunda.send_to_camunda')) {
            $this->_authorize();
        }
    }

    public function getClientSettings()
    {
        if(!$this->token){
            abort(500, 'Camunda config switch off');
        }

        $response = $this->_getRequest()
            ->get('/camunda-api/api/v1/Client');

        return $response->json();
    }

    public function setClientSettings(array $params)
    {
        if(!$this->token){
            abort(500, 'Camunda config switch off');
        }

        $response = $this->_getRequest()
            ->put('/camunda-api/api/v1/Client', $params);

        if($response->successful()){
            $key = 'CAMUNDA_SECRET_KEY';
            file_put_contents(app()->environmentFilePath(), str_replace(
                $key . '=' . env($key),
                $key . '=' . $params['workerWebhookSecret'],
                file_get_contents(app()->environmentFilePath())
            ));
        }

        return $response->json();
    }


    public function getBpmnDiagramXml()
    {
        if(!$this->token){
            abort(500, 'Camunda config switch off');
        }

        $response = $this->_getRequest()
            ->get('/api/v1/ProcessDefinitions/Process_Upi_Qolday_Client_Request/Diagram/Xml');

        return $response->json();
    }

    public function getBpmnHistory(string $appealId)
    {
        if(!$this->token){
            abort(500, 'Camunda config switch off');
        }

        $response = $this->_getRequest()
            ->get('/api/v1/Historic/ActivityInstances/BusinessKeys/' . $appealId);

        return $response->json();
    }

    public function startProcess(string $appealId)
    {
        if(!$this->token){
            return;
        }

        $appeal = $this->appealForCamundaRepository->find($appealId);

        if(!$appeal){
            throw new ModelNotFoundException();
        }

        if($appeal->in_camunda){
            return;
        }

        $params = [
            'businessKey' => $appeal->id,
            'variables' => [$this->createVariable('status', 'Pending')]
        ];

        Log::info(json_encode($params));

        $response = $this->_getRequest()
            ->post('/api/v1/ProcessInstances/Process_Upi_Qolday_Client_Request/Start', $params);

        if($response->successful()){
            $appeal->in_camunda = true;
            $appeal->save();
        } else {
            Log::info($response->body());
        }
    }

    public function completedByDistributor(string $appealId, int $userId, string $userName)
    {
        $this->completeTask('Activity_Completed_By_Distributor', $appealId, $userId, $userName);
    }

    public function completeTask($taskDefinitionKey, $appealId, $userId, $userName)
    {
        if(!$this->token){
            return;
        }

        $appeal = $this->appealForCamundaRepository->find($appealId);

        if(!$appeal){
            throw new ModelNotFoundException();
        }

        if(!$appeal->in_camunda){
            return;
        }

        $params = [
            'taskDefinitionKey' => $taskDefinitionKey,
            'variables' => [$this->createVariable('status', 'Confirmed')],
            'userName' => $userName
        ];
        $response = $this->_getRequest()
            ->post('/api/v1/Tasks/BusinessKeys/'.$appealId.'/Complete', $params);
        Log::info(json_encode($params));

        if(!$response->successful()){
            Log::info($response->body());
        }
    }

    public function getAvailableTask(array $params){
        if(!$this->token){
            abort(500, 'Camunda config switch off');
        }

        $response = $this->_getRequest()
            ->get('/api/v1/Tasks', [
                'processDefinitionKey' => $params['processDefinitionKey'],
                'candidateGroup' => $params['candidateGroup'],
                'user' => $params['user'],
                'businessKey' => $params['businessKey']
            ]);

        return $response->json();
    }


    private function _getRequest(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withToken($this->token)
            ->baseUrl(config('app.service.camunda.api_url'))
            ->acceptJson();
    }

    private function _authorize()
    {
        $serviceTokenModel = $this->remoteServiceTokenRepository->getByName($this->serviceName);

        if ($serviceTokenModel) {
            $this->token = $serviceTokenModel->token;
            $parsedToken = $this->remoteServiceTokenRepository->parseToken($this->token);
            $diffTime = ($parsedToken['jwtPayload']->exp - round(microtime(true))) * 1000;
            if ($diffTime > 0 && $diffTime <= 5 * 60 * 1000) {
                $result = $this->refreshToken($serviceTokenModel->refresh_token);
                $this->_storeRemoteServiceToken($result['token'], $result['refresh_token']);
            } else if ($diffTime <= 0) {
                $result = $this->_login();
                $this->_storeRemoteServiceToken($result['token'], $result['refresh_token']);
            }
        } else {
            $result = $this->_login();
            $this->_storeRemoteServiceToken($result['token'], $result['refresh_token']);
        }
    }

    function refreshToken($refreshToken): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . config('app.service.camunda.cred'),
        ])
            ->baseUrl(config('app.service.camunda.sso_url'))
            ->acceptJson()
            ->asForm()
            ->post('/auth/connect/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ]);

        if ($response->clientError()) {
            return $this->_login();
        } else {
            return $this->_getResponseResult($response);
        }
    }

    private function _login(): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . config('app.service.camunda.cred'),
        ])
            ->baseUrl(config('app.service.camunda.sso_url'))
            ->acceptJson()
            ->asForm()
            ->post('/auth/connect/token', [
                'grant_type' => 'password',
                'scope' => 'openid offline_access camundaapi profile',
                'username' => config('app.service.camunda.user_name'),
                'password' => config('app.service.camunda.user_pwd'),
            ]);

        return $this->_getResponseResult($response);
    }

    private function _getResponseResult($response): array
    {
        $response->throw();
        $result = $response->json();

        return [
            'token' => $result['access_token'],
            'refresh_token' => $result['refresh_token'],
        ];
    }

    private function _storeRemoteServiceToken($token, $refreshToken)
    {
        $this->remoteServiceTokenRepository->setByName($this->serviceName, $token, $refreshToken);
        $this->token = $token;
    }

    private function createVariable($name, $value): \stdClass
    {
        $var = new \stdClass();
        $var->name = $name;
        $var->value = $value;

        return $var;
    }
}
