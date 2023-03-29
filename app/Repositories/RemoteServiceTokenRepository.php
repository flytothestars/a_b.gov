<?php


namespace App\Repositories;


use App\Models\ActivityType;
use App\Models\ActivityTypeTag;
use App\Models\RemoteServiceToken;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RemoteServiceTokenRepository extends BaseRepository implements IRemoteServiceTokenRepository
{
    public function __construct(RemoteServiceToken $model)
    {
        parent::__construct($model);
    }

    public function getByName($serviceName)
    {
        return $this->query()->where('service_name', $serviceName)->first();
    }

    public function setByName($serviceName, $token, $refreshToken)
    {
        $this->query()->updateOrCreate([
            'service_name' => $serviceName
        ], [
            'token' => $token,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function parseToken($token): array
    {
        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        return [
            'jwtHeader' => $jwtHeader,
            'jwtPayload' => $jwtPayload,
        ];
    }
}
