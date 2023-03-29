<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

interface IIntegrationJournalRepository extends ICreatable
{
    public function import();

    public function fail(string $integrationJournalId, string $errorMessage): Model;
    public function success(string $integrationJournalId): Model;
}
