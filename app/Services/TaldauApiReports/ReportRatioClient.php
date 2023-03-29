<?php

namespace App\Services\TaldauApiReports;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

class ReportRatioClient implements IReportRatioClient
{

    private Client $client;

    /**
     * ReportRatioClient constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @throws GuzzleException
     * @throws Exception
     */
    final public function fetchReportRatio(string $url): array
    {
        $response = $this->client->get($url);

        $status = $response->getStatusCode();

        if ($status !== Response::HTTP_OK) {
            throw new Exception('invalid response');
        }

        $body = $response->getBody()
                         ->getContents()
        ;

        return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }

}
