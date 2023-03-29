<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\IUserRepository;
use App\Services\IFirebaseTokenValidation;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
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

    public function confirm(Request $request)
    {
        $this->validator($request->all())
             ->validate()
        ;

        $user = $this
            ->userRepository
            ->resetUserPassword(
                $request->get('userId'),
                $request->get('reset-password')
            );

        Auth::login($user);

        return response(
            [
                'status'   => 'ok',
                'redirect' => $this->redirectTo,
            ]
        );

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'userId'                 => [
                    'required',
                    'integer',
                    'exists:users,id',
                ],
                'reset-password'         => [ 'required', 'string', 'min:8' ],
                'reset-confirm-password' => [ 'required', 'string', 'min:8', 'same:reset-password' ],
            ]
        );
    }

}
