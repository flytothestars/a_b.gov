<?php

namespace App\Http\Controllers\API\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Telegram\CreateUserAccountRequest;
use App\Http\Requests\API\Telegram\VerifyPhoneRequest;
use App\Http\Requests\API\Telegram\VerifyTelegramIdRequest;
use App\Models\User;
use App\Repositories\Enums\RoleEnum;
use App\Repositories\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected IUserRepository $userRepository;

    /**
     * CreateUserAccountRequest constructor.
     *
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    final public function isUserPhoneExists(VerifyPhoneRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $user = User
            ::with('profile')
            ->where('phone', $attributes[ 'phone' ])
            ->first()
        ;

        return response()->json(
            array_merge([ 'exists' => $user !== null ], $user ? $user->toArray() : [])
        );
    }

    final public function isUserTelegramIdExists(VerifyTelegramIdRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $user = User
            ::with('profile')
            ->where('telegram_user_id', $attributes[ 'telegram-user-id' ])
            ->first()
        ;
        return response()->json(
            array_merge([ 'exists' => $user !== null ], $user ? $user->toArray() : [])
        );
    }

    final public function createUserAccount(CreateUserAccountRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $fields = [
            'name'             => $attributes[ 'phone' ],
            'email'            => '',
            'phone'            => $attributes[ 'phone' ],
            'password'         => $attributes[ 'password' ],
            'telegram_user_id' => $attributes[ 'telegram-user-id' ],
            'roles'            => [
                RoleEnum::Client,
            ],
        ];

        $user = $this->userRepository->create($fields);

        return response()->json([ 'user_id' => $user->id ]);
    }

}
