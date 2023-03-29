<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealExecutorRepository
{
    public function assign($appeal_id, $executor_id): ?Model;
}
