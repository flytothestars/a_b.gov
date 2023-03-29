<?php

namespace App\Http\Controllers;

use App\Http\Requests\MSB\SendApplicationRequest;
use App\Services\IMsbService;
use App\Services\MSB\ApplicationRequest;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;


class SurveyController extends Controller
{
    private IMsbService $service;

    /**
     * SurveyController constructor.
     *
     * @param IMsbService $service
     */
    public function __construct(IMsbService $service)
    {
        $this->service = $service;
    }

    public function index(): Response
    {
        return response()->view('client.forms.index');
    }

    public function byIin(string $iin): Response
    {   
        $client = new Client();
        try{
            $res = $client->request('GET', 'https://stat.gov.kz/api/juridical/counter/api/?bin=' . $iin . '&lang=ru');
        }catch (HttpClientException $exception) {
                if (
                    $exception->getMessage() === '{"error":"Unable to get data"}'
                ) {
                    return response()->view('client.forms.index', [ 'iin' => $iin ]);
                }
                $message = json_decode($exception->getMessage(), true);
                if (
                    $exception->getCode() === 400
                    && is_array($message)
                    && array_key_exists('bin_iin', $message)
                ) {
                    return response()->view('client.forms.index', [ 'iin' => $iin, 'fail' => $message[ 'bin_iin' ][ 0 ] ]);
                }
    
                throw $exception;
            }

        $responseIIN = json_decode($res->getBody()->getContents());
        //dd($response);
        try {
            $response = $this->service->getProgramByBinIinRequest($iin);
            dd($response);
        } catch (HttpClientException $exception) {
            if (
                $exception->getMessage() === '{"error":"Unable to get data"}'
            ) {
                return response()->view('client.forms.index', [ 'iin' => $iin ]);
            }
            $message = json_decode($exception->getMessage(), true);
            if (
                $exception->getCode() === 400
                && is_array($message)
                && array_key_exists('bin_iin', $message)
            ) {
                return response()->view('client.forms.index', [ 'iin' => $iin, 'fail' => $message[ 'bin_iin' ][ 0 ] ]);
            }

            throw $exception;
        }
        return response()->view('client.forms.index', [ 'response' => $response, 'responseIIN' => $responseIIN, 'iin' => $iin ]);
    }

    public function sendApplication(SendApplicationRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $response = $this->service->sendApplication(new ApplicationRequest($attributes));

        if ($response['status'] === 'ok') {
            return response()->json([ 'status' => $response['status'] ]);
        }

        return response()->json([ 'status' => $response['status'], 'message' => $response['message'] ]);
    }


}
