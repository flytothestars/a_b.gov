<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseTokenValidation implements IFirebaseTokenValidation
{
    final public function validateFirebaseToken(string $token, string $phone): bool
    {
        $auth = Firebase::auth();
        try {
            $verifiedIdToken = $auth->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');

            if(!$uid){
                return false;
            }
//            $user = $auth->getUser($uid);

//            return $user->phoneNumber === $phone;
            return true;
        } catch (\Exception $exception) {
            report($exception);
        }

        return false;
    }

}
