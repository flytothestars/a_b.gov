<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface IUserRepository extends IRepository
{

    public function allWithPagination(array $attributes);
    public function findByPhoneNumber(string $phone): ?User;

    public function resetUserPassword(int $userId, string $password): User;

    public function createInternalUser(array $attributes): Model;
    public function updateInternalUser($id, array $attributes): Model;

    public function createBusinessUser($business_id, array $attributes): Model;
    public function createBusinessUserForAll();
    public function checkAccountBusiness($id);
    public function deleteAccountAll();
}
