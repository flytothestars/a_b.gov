<?php

namespace App\Integration\Import;

use App\Integration\IMIORestClient;
use App\Integration\Model\Business;
use App\Models\Appeal;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\IIntegrationJournalRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class BusinessImportFactory extends MioImportFactory
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
            'display_name' => $jsonEntity->display_name,
            'location' => $jsonEntity->location_lat . ';' . $jsonEntity->location_long,
            'address_line' => $jsonEntity->address_line,
            'address_line_stat' => $jsonEntity->address_line_stat ?? $jsonEntity->address_line,
            'source' => $jsonEntity->source,
            'entities' => $jsonEntity->entities,
            'activity_subclasses' => $jsonEntity->activity_subclasses,
            'employee_count' => $jsonEntity->employee_count,
            'has_cash_register' => $jsonEntity->has_payment_terminal,
            'cash_register_count' => $jsonEntity->cash_register_count,
            'has_payment_terminal' => $jsonEntity->has_payment_terminal,
            'need_to_contact' => $jsonEntity->need_to_contact,
            'refused_to_provide_identification_number' => $jsonEntity->refused_to_provide_identification_number,
            'identification_number_not_found_in_stat' => $jsonEntity->identification_number_not_found_in_stat,
        ];

        $status = 'PENDING';
        $params = Arr::add($params, 'status', $status);
        //todo need check status
        if ($mode == IntegrationJournalModeEnum::Create) {
            $response = $this->restClient->insertBusiness($params);
            if ($response->status() == 200) {
                $entity = Business::find($jsonEntity->id);
                $entity->mio_id = $response;
                $entity->save();
            } else {
                throw new \Exception($response->getBody()->getContents());
            }
        } else {
            $response = $this->restClient->updateBusiness($jsonEntity->mio_id, $params);
            if ($response->status() !== 200) {
                throw new \Exception($response->getBody()->getContents());
            }
        }

        return false;
    }
}
