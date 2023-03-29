<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\IProfileRepository;
use App\Repositories\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    private $repository;
    private IProfileRepository $profileRepository;

    public function __construct(IUserRepository $repository, IProfileRepository $profileRepository)
    {
        $this->repository = $repository;
        $this->profileRepository = $profileRepository;
    }

    public function index(Request $request) : JsonResource
    {
        $users = $this->repository->allWithPagination($request->all());
        return UserResource::collection($users);
    }

    public function store(UserRequest $request) : JsonResource
    {
        $entity = $this->repository->createInternalUser($request->validated());
        return new UserResource($entity);
    }

    public function update($id, UserRequest $request) : JsonResource
    {
        $entity = $this->repository->updateInternalUser($id, $request->validated());
        return new UserResource($entity);
    }

    public function show($id) : JsonResource
    {
        $userToReturn = $this->repository->find($id);
        return new UserResource($userToReturn);
    }

    public function destroy($id) : JsonResponse
    {
        $this->repository->delete($id);
        $this->profileRepository->deleteByUserId($id);
        return response()->json(null, 204);
    }
}
