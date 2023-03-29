<?php

namespace App\Services\Camunda;

use App\Integration\IMSBRestClient;
use App\Models\MsbApplication;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealRepository;
use App\Repositories\IRemoteServiceTokenRepository;
use App\Services\MSB\IApplicationRequest;
use App\Services\MSB\IProgramByBinIinResponse;
use App\Services\MSB\ProgramByBinIinResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Guid\Guid;

class CamundaTaskService implements ICamundaTaskService
{
    private IAppealForDistributorRepository $appealForDistributorRepository;

    public function __construct(
        IAppealForDistributorRepository $appealForDistributorRepository
    )
    {
        $this->appealForDistributorRepository = $appealForDistributorRepository;
    }

    public function externalTask($externalTask): ?\stdClass
    {
        $result = null;
        switch ($externalTask['activityId']){
            case 'Activity_Auto_Assign_ToWork':{
                $appealId = $externalTask['businessKey'];
                $appeal = $this->appealForDistributorRepository->autoAssignDistributor($appealId);

                $var = new \stdClass();
                $var->variables = [
                        $this->createVariable('status', 'DistributorAssign'),
                        $this->createVariable('distributor_id', $appeal->distributor_id)
                ];

                $result = $var;
            }
        }

        return $result;
    }

    private function createVariable($name, $value): \stdClass
    {
        $var = new \stdClass();
        $var->name = $name;
        $var->value = $value;

        return $var;
    }
}
