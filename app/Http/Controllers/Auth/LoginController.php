<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function username()
    {
        return 'phone';
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login (Request $request){

            $sign = $request->input('sign');
            if(!empty($sign)){
                $this->__loginViaAssign($sign);
            }
            
            $this->validateLogin($request);

            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
    
                return $this->sendLockoutResponse($request);
            }
    
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
    
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
    }


    private function __loginViaAssign($sign){
        $key = $this->getXmlKey($sign);
        $certificate = $this->getXmlCertificate($sign);
        $user =  User::where('password', $certificate)->first();
        Auth::login($user);
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
