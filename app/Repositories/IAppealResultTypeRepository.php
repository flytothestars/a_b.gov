<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface IAppealResultTypeRepository extends IFindable
{
    public function allByAppealAndToStatus($appealId, $toAppealStatus): ?Collection;
}
