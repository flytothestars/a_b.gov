<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IMioIntegrationLogRepository
{
    public function start(array $attributes): Model;
    public function success($id, $rowCount): Model;
    public function fail($id, $description): Model;
    public function lastSuccessed(): Model;
}
