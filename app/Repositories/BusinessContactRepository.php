<?php


namespace App\Repositories;


use App\Integration\Import\BusinessContactImportFactory;
use App\Integration\Import\IntegrationJournalModeEnum;
use App\Models\BusinessContact;
use Illuminate\Database\Eloquent\Model;

class BusinessContactRepository extends MioBaseRepository implements IBusinessContactRepository
{
    private BusinessContactImportFactory $businessContactImportFactory;

    public function __construct(BusinessContact $model, IIntegrationJournalRepository $integrationJournalRepository)
    {
        parent::__construct($model);
        $this->integrationJournalRepository = $integrationJournalRepository;

        $this->businessContactImportFactory = new BusinessContactImportFactory($integrationJournalRepository, new \App\Integration\MIORestClient());
    }

    public function create(array $attributes): Model
    {
        $entity = parent::create($attributes);

        if (is_null($entity->mio_id)) { //todo спросить у Асем
            $collection = collect($entity);
            $this->businessContactImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Create);
        }

        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $entity = parent::update($id, $attributes);

        if (is_null($entity->mio_id)) { //todo спросить у Асем
            $collection = collect($entity);
            $this->businessImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Update);
        }

        return $entity;
    }


}
