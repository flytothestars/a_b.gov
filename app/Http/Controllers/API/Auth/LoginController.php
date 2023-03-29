<?php


namespace App\Http\Controllers\API\Auth;


use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $phone = Str::replace(['(',')',' ','-'],'', $loginData['phone']);

        $loginData['phone'] = $phone;

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Неверный логин или пароль'], 401);
        }

        $accessToken = auth()->user()->accessToken;

        return response([
            'user' => new UserResource(auth()->user()),
            'access_token' => $accessToken]);
    }
}
