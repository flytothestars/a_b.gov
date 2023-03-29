<?php

namespace App\Integration\Import;

use App\Integration\IMIORestClient;
use App\Models\Appeal;
use App\Models\AppealResultType;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\IIntegrationJournalRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class AppealImportFactory extends MioImportFactory
{
    public function __construct(
        IIntegrationJournalRepository $integrationJournalRepository,
        IMIORestClient                $restClient
    )
    {
        parent::__construct($integrationJournalRepository, $restClient);
    }

    /**
     * @throws \Exception
     */
    public function import($jsonEntity, string $mode): bool
    {
        $appealResultType = AppealResultType::where('id', $jsonEntity->appeal_result_type_id)->first();
        $params = [
            'business' => $jsonEntity->mio_business_id,
            'description' => $jsonEntity->content,
            'requirement' => $jsonEntity->requirement_id,
            'request_status' => [
                'name' => $appealResultType->name,
                'side_system_id' => $appealResultType->id
            ]
        ];
        $status = 'PENDING';
        if ($mode == IntegrationJournalModeEnum::Update) {
            switch ($jsonEntity->appeal_status_id) {
                case AppealStatusEnum::InWork:
                {
                    $status = 'PENDING';
                    break;
                }
                case AppealStatusEnum::Rejected:
                {
                    $status = 'NOT_CONFIRMED';
                    break;
                }
                case AppealStatusEnum::CoExecutorAssigned:
                case AppealStatusEnum::ExecutorAssigned:
                {
                    if ($jsonEntity->flow_type_id == FlowTypeEnum::Upi) {
                        $status = 'DIRECTED_TO_UPP';
                    } else {
                        $status = 'INVITED_TO_QOLDAU';
                    }
                    break;
                }
                case AppealStatusEnum::DistributorAssigned:
                case AppealStatusEnum::Pending:
                case AppealStatusEnum::CuratorAssigned:
                case AppealStatusEnum::Confirmed:
                case AppealStatusEnum::DivisionCuratorConfirm:
                {
                    $status = 'INVITED_TO_QOLDAU';
                    break;
                }
                case AppealStatusEnum::Completed:
                {
                    $status = 'PROVIDED_ASSISTANCE';
                    break;
                }
            }
        }
        $params = Arr::add($params, 'status', $status);
        if ($mode == IntegrationJournalModeEnum::Create) {
            $response = $this->restClient->insertBusinessRequests($params);
            if ($response->status() == 200) {
                $entity = Appeal::find($jsonEntity->id);
                $entity->mio_id = $response;
                $entity->save();
            } else {
                throw new \Exception($response->getBody()->getContents());
            }
        } else {
            $params = Arr::add($params, 'uid', $jsonEntity->mio_id);

            $response = $this->restClient->updateBusinessRequests($jsonEntity->mio_id, $params);
            if ($response->status() !== 200) {
                throw new \Exception($response->getBody()->getContents());
            }
        }

        return true;
    }
}
