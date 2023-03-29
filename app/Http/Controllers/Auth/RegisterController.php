<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Repositories\Enums\RoleEnum;
use App\Repositories\IProfileRepository;
use App\Repositories\IUserRepository;
use App\Services\IFirebaseTokenValidation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $profileRepository;

    protected $userRepository;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @param IProfileRepository $profileRepository
     */
    public function __construct(
        IProfileRepository $profileRepository,
        IUserRepository $userRepository
    )
    {
        $this->middleware('guest');
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'register-phone' => [
                'required',
                'string',
                'max:255',
                'unique:users,phone',
                static function ($attribute, $value, $fail) use ($data) {

                    $isValid = app(IFirebaseTokenValidation::class)
                        ->validateFirebaseToken($data['register-token'] ?? '', $value);
                    if(!$isValid) {
                        $fail(trans('messages.pages.auth.invalidPhoneNumber'));
                    }
                }
            ],
            'register-password' => ['required', 'string', 'min:8'],
            'register-confirm-password' => ['required', 'string', 'min:8', 'same:register-password'],
        ]);
    }


    public function register(Request $request)
    {

        $sign_register = $request->input('sign_register');
        if(empty($sign_register)){
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
        }else{
            event(new Registered($user = $this->createViaEDS($request->all())));
        }


        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }


    protected function createViaEDS(array $data)
    {
        $certificate="";
        $name = "";
        $key = $this->getXmlKey($data['sign_register']);
        $certificated = $this->getXmlCertificate($data['sign_register']);
        $certificate = explode(chr(10), trim($certificated));
        $certificate = implode("\n", array_merge(array('-----BEGIN CERTIFICATE-----'), $certificate, array('-----END CERTIFICATE-----')));
        $userdata = openssl_x509_parse($certificate);
        if(isset($userdata['subject']['CN']) && !empty($userdata['subject']['CN'])){
            $name = $userdata['subject']['CN'];
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $name,
                'phone' => '',
                'password' => $certificated
            ]);
            $user->assignRole('Client');
            $this->profileRepository->create(
                [
                    'id' => Uuid::uuid4(),
                    'user_id' => $user->id
                ]
            );
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }

        return $user;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {

        $request = app(RegisterUserRequest::class);
        $requestData =  $request->validated();

        $fields = [
            'name' => $requestData['register-phone'],
            'email' => '',
            'phone' => $requestData['register-phone'] ?? '',
            'password' => $requestData['register-password'],
            'roles' => [
                RoleEnum::Client,
            ]
        ];

        return $this->userRepository->create($fields);
    }


    /**
     * getXmlKey function
     *
     * Get key from signed XML
     *
     * @param $sign
     * @return string|null
     */
    private function getXmlKey($sign)
    {
        $key = null;

        $parser = xml_parser_create();

        xml_parse_into_struct($parser, $sign, $values, $index);
        xml_parser_free($parser);

        if(isset($values[1]) && isset($values[1]['value']))
        {
            $key = $values[1]['value'];
        }

        return $key;
    }

    /**
     * getXmlCertificate function
     *
     * Get key from signed XML
     *
     * @param $sign
     * @return string|null
     */
    private function getXmlCertificate($sign)
    {
        $key = null;

        $parser = xml_parser_create();

        xml_parse_into_struct($parser, $sign, $values, $index);
        xml_parser_free($parser);

        if(isset($values[28]) && isset($values[28]['value']))
        {
            $key = $values[28]['value'];
        }

        return $key;
    }
}


