<?php

namespace App\Integration\Import;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IMioImportFactory
{
    public function import($jsonEntity, string $mode): bool;

    public function storeToJournal(Collection $entity, string $mode);
}
