<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\IUserRepository;
use App\Services\IFirebaseTokenValidation;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Contracts\Validation\Validator as IValidator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * ResetPasswordController constructor.
     *
     * @param $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    final public function validateToken(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->userRepository->findByPhoneNumber($request->get('phone'));

        return response(
            [
                'status' => 'ok',
                'userId' => optional($user)->id,
            ]
        );
    }

    protected function validator(array $data): IValidator
    {
        return Validator::make(
            $data,
            [
                'phone' => [
                    'required',
                    'string',
                    'max:255',
                    'exists:users,phone',
                    static function ($attribute, $value, $fail) use ($data)
                    {
                        $isValid = app(IFirebaseTokenValidation::class)
                            ->validateFirebaseToken($data[ 'reset-token' ] ?? '', $value);
                        if (!$isValid) {
                            $fail(trans('messages.pages.auth.invalidPhoneNumber'));
                        }
                    },
                ],
            ]
        );
    }
}
