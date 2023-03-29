<?php

namespace App\Integration\Import;

use App\Integration\IMIORestClient;
use App\Repositories\IIntegrationJournalRepository;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

abstract class MioImportFactory implements IMioImportFactory
{
    protected IIntegrationJournalRepository $integrationJournalRepository;
    protected IMIORestClient $restClient;

    public function __construct(IIntegrationJournalRepository $integrationJournalRepository, IMIORestClient $restClient)
    {
        $this->integrationJournalRepository = $integrationJournalRepository;
        $this->restClient = $restClient;
    }

    abstract function import($jsonEntity, string $mode): bool;

    public function storeToJournal(Collection $entity, string $mode)
    {
        $this->integrationJournalRepository->create([
            'id' => Uuid::uuid4(),
            'content' => json_encode([
                'type' => get_class($this),
                'mode' => $mode,
                'data' => $entity
            ]),
            'created_at' => new \DateTime("now", new \DateTimeZone("UTC")),
        ]);
    }
}
