<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IProfileRepository extends IRepository
{
    public function executorList(): Collection;
    public function distributorList(): Collection;
    public function executorUPIList(): Collection;
    public function coExecutorList($department_id): Collection;
    public function upiCuratorList(): Collection;
    public function districtCuratorList(): Collection;
    public function createBusinessProfile(array $attributes): Model;
    public function deleteByUserId($id);
}
