<?php

namespace App\Repositories;

use App\Integration\Import\AppealImportFactory;
use App\Integration\Import\BusinessImportFactory;
use App\Integration\Import\OrganisationImportFactory;
use App\Models\District;
use App\Models\IntegrationJournal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class IntegrationJournalRepository extends BaseRepository implements IIntegrationJournalRepository
{
    public function __construct(
        IntegrationJournal $model
    )
    {
        parent::__construct($model);
    }

    public function getNotProcessedList()
    {
        return parent::query()
            ->whereNull('completed_at')
            ->orderBy('created_at')
            ->get();
    }

    public function import()
    {
        $importClient = new \App\Integration\MIORestClient();
        $importClient->auth();
        $entityList = $this->getNotProcessedList();

        foreach ($entityList as $entity) {
            $content = json_decode($entity->content);
            try {
                (new $content->type($this, $importClient))->import($content->data, $content->mode);

                $this->success($entity->id);
            } catch (\Exception $e) {
                $this->fail($entity->id, $e->getMessage());
            }
        }
    }

    public function fail(string $integrationJournalId, string $errorMessage): Model
    {
        return parent::update($integrationJournalId,
            [
                'error_description' => $errorMessage,
                'is_success' => false,
            ]
        );
    }

    public function success(string $integrationJournalId): Model
    {
        return parent::update($integrationJournalId,
            [
                'error_description' => null,
                'is_success' => true,
                'completed_at' => new \DateTime("now", new \DateTimeZone("UTC")),
            ]
        );
    }
}
