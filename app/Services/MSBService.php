<?php

namespace App\Services;

use App\Integration\IMSBRestClient;
use App\Models\MsbApplication;
use App\Services\MSB\IApplicationRequest;
use App\Services\MSB\IProgramByBinIinResponse;
use App\Services\MSB\ProgramByBinIinResponse;
use Illuminate\Http\Client\HttpClientException;

class MSBService implements IMsbService
{

    private IMSBRestClient $client;

    /**
     * MSBService constructor.
     *
     * @param IMSBRestClient $client
     */
    public function __construct(IMSBRestClient $client)
    {
        $this->client = $client;
    }


    final public function getProgramByBinIinRequest(string $binIin): IProgramByBinIinResponse
    {
        return new ProgramByBinIinResponse(
            $this->client->getProgramByBinIinRequest($binIin)
        );
    }

    public function sendApplication(IApplicationRequest $application)
    {
        $msbModel = MsbApplication::create($application->toArray());

        $response = [
            'status' => 'ok',
        ];

        try {
            $this->client->sendMSBApplication($application);
            $msbModel->is_send       = true;
            $msbModel->response_code = 200;
            $msbModel->save();
        } catch (HttpClientException $exception) {
            $msbModel->is_send       = true;
            $msbModel->response_code = $exception->getCode();
            $msbModel->response      = $exception->getMessage();
            $msbModel->save();

            $message = json_decode($exception->getMessage(), true);
            $message = array_shift($message);
            $message = array_shift($message);

            $response['status'] = 'fail';
            $response['message'] = $message;
            return $response;
        }
        return $response;
    }


}
