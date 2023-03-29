<?php

namespace App\Integration;
use App\Services\MSB\IApplicationRequest;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class MSBRestClient implements IMSBRestClient
{
    private string $extendUri;
    private string $secretKey;

    public function __construct()
    {
        $this->extendUri = config('app.import.msb.uri');
        $this->secretKey = config('app.import.msb.key');
    }

    final public function getProgramByBinIinRequest(string $binIin): array
    {
        //$client = new Client();
        //$response = $client->request('GET', 'https://stat.gov.kz/api/juridical/counter/api/?bin=' . $binIin . '&lang=ru');

        $response = Http::withHeaders([])->get($this->extendUri . '/search-bin-kato-section', [
            'key' => $this->secretKey,
            'section' => 'A',
            'bin_iin' => $binIin,
            'kato' => '750000000'
        ]);

        if($response->status() === Response::HTTP_OK)
        {
            // dd($response);
            return $response->json();
        }

        throw new HttpClientException($response->getBody()->getContents(), $response->status());
    }

    final public function sendMSBApplication(IApplicationRequest $application): bool
    {
        $application->setKey($this->secretKey);
        $response =  Http::withHeaders([])->post($this->extendUri . '/send-appeals/', $application->toArray());

        if($response->status() === Response::HTTP_OK)
        {
            return true;
        }

        throw new HttpClientException($response->getBody()->getContents(), $response->status());
    }

}
