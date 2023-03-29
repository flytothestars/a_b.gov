<?php

namespace App\Integration\Import;

use App\Integration\IMIORestClient;
use App\Models\Appeal;
use App\Models\Organization;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\IIntegrationJournalRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class OrganisationImportFactory extends MioImportFactory
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
            'name' => $jsonEntity->name,
            'full_name' => $jsonEntity->full_name,
            'identification_number' => $jsonEntity->iin,
            'activity_codes' => $jsonEntity->activity_codes ?? '',
            'is_individual' => $jsonEntity->is_individual,
        ];

        if ($mode == IntegrationJournalModeEnum::Create) {
            $response = $this->restClient->insertBusinessEntities($params);
            if ($response->status() == 200) {
                $entity = Organization::find($jsonEntity->id);
                $entity->mio_id = $response;
                $entity->save();
            } else {
                throw new \Exception($response->getBody()->getContents());
            }
        } else {
            $params = Arr::add($params, 'uid', $jsonEntity->mio_id);

            $response = $this->restClient->updateBusinessEntities($jsonEntity->mio_id, $params);
            if ($response->status() !== 200) {
                throw new \Exception($response->getBody()->getContents());
            }
        }

        return true;
    }
}
