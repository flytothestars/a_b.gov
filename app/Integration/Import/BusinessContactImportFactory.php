<?php

namespace App\Integration\Import;

use App\Integration\IMIORestClient;
use App\Integration\Model\Business;
use App\Models\Appeal;
use App\Models\BusinessContact;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\IIntegrationJournalRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class BusinessContactImportFactory extends MioImportFactory
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
        $params = [
            'business_id' => $jsonEntity->business_id,
            'full_name' => $jsonEntity->full_name,
            'phone_number' => $jsonEntity->phone_number,
        ];

        if ($mode == IntegrationJournalModeEnum::Create) {
            $response = $this->restClient->insertBusinessContacts($params);
            if ($response->status() == 200) {
                $entity = BusinessContact::find($jsonEntity->id);
                $entity->mio_id = $response;
                $entity->save();
            } else {
                throw new \Exception($response->getBody()->getContents());
            }
        } else {
            $params = Arr::add($params, 'uid', $jsonEntity->mio_id);

            $response = $this->restClient->updateBusinessContacts($jsonEntity->mio_id, $params);
            if ($response->status() !== 200) {
                throw new \Exception($response->getBody()->getContents());
            }
        }

        return false;
    }
}
