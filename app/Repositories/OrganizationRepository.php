<?php


namespace App\Repositories;


use App\Integration\Import\AppealImportFactory;
use App\Integration\Import\IntegrationJournalModeEnum;
use App\Integration\Import\OrganisationImportFactory;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;

class OrganizationRepository extends MioBaseRepository implements IOrganizationRepository
{
    private OrganisationImportFactory $organisationImportFactory;

    public function __construct(
        Organization                  $model,
        IIntegrationJournalRepository $integrationJournalRepository
    )
    {
        parent::__construct($model);
        $this->organisationImportFactory = new OrganisationImportFactory($integrationJournalRepository, new \App\Integration\MIORestClient());
    }

    public function create(array $attributes): Model
    {
        $entity = parent::create($attributes);

        if (is_null($entity->mio_id)) { //todo спросить у Асем
            $collection = collect($entity);
            $businessActivityTypeList = optional($entity->business)->businessActivityTypes;
            if (!is_null($businessActivityTypeList) && sizeof($businessActivityTypeList) > 0) {
                $collection['activity_codes'] = $businessActivityTypeList[0]->activityType->code;
            }
            $this->organisationImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Create);
        }

        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $entity = parent::update($id, $attributes);

        $collection = collect($entity);
        $businessActivityTypeList = optional($entity->business)->businessActivityTypes;
        if (!is_null($businessActivityTypeList) && sizeof($businessActivityTypeList) > 0) {
            $collection['activity_codes'] = $businessActivityTypeList[0]->activityType->code;
        }
        $this->organisationImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Update);

        $entity->save();
        return $entity;
    }
}
