<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealCoExecutorRepository
{
    public function assign($appeal_id, $co_executor_id): ?Model;
}
