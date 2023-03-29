<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IAppealDocumentRepository
{
    public function createClientDocument($appealId, $file): ?Model;
    public function createManagerDocument($appealId, $file): ?Model;
}
