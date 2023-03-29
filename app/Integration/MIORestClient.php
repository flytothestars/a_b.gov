<?php

namespace App\Integration;

use App\Integration\Model\ActivityClass;
use App\Integration\Model\ActivityGroup;
use App\Integration\Model\ActivitySection;
use App\Integration\Model\ActivitySubClass;
use App\Integration\Model\ActivityType;
use App\Integration\Model\Business;
use App\Integration\Model\City;
use App\Integration\Model\Contact;
use App\Integration\Model\District;
use App\Integration\Model\Entity;
use App\Integration\Model\Industry;
use App\Integration\Model\IndustryType;
use App\Integration\Model\Photo;
use App\Integration\Model\Region;
use App\Integration\Model\Request;
use App\Integration\Model\Requirement;
use App\Integration\Model\RequirementType;
use \Illuminate\Support\Facades\Http;

class MIORestClient implements IMIORestClient
{
    private $extendUri;
    private $userName;
    private $password;
    private $token;

    public function __construct()
    {
        $this->extendUri = config('app.import.mio.uri');
        $this->userName = config('app.import.mio.user');
        $this->password = config('app.import.mio.pass');
    }

    public function auth(): void
    {
//      $response =Http::withoutVerifying()->post($this->extendUri . 'auth-token/', [
        $response = Http::post($this->extendUri . 'auth-token/', [
            'username' => $this->userName,
            'password' => $this->password
        ]);

        $this->token = $response['token'];
    }

    public function getBusinessCount($status, $afterDate): int
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/', [
            'limit' => 1,
            'offset' => 0,
            'status' => $status,
            'mod_or_last_req_after' => $afterDate
        ]);

        return $response['count'];
    }

    public function getBusinesses($limit, $offset, $status, $afterDate): array
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/', [
            'limit' => $limit,
            'offset' => $offset,
            'status' => $status,
            'modified_after' => $afterDate
        ]);

        $result = array();
        foreach ($response['results'] as $value) {
            array_push($result, new Business(
                $value
            ));
        }

        return $result;
    }

    public function insertBusiness($params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->post($this->extendUri . 'businesses/', $params);

        return $response;
    }

    public function updateBusiness($id, $params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->put($this->extendUri . 'businesses/' . $id, $params);

        return $response;
    }

    public function getBusinessEntities($businessId): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/' . $businessId . '/entities/');

        $responseData = json_decode($response->getBody()->getContents());
        $result = array();
        foreach ($responseData as $value) {
            array_push($result, new Entity(
                (array)$value
            ));
        }

        return $result;
    }

    public function getBusiness($businessId): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/' . $businessId);

        $responseData = json_decode($response->getBody()->getContents());
        $result = array();

            array_push($result, new Business(
                (array)$responseData
            ));

        return $result;
    }

    public function insertBusinessEntities($params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->post($this->extendUri . 'entities/', $params);

        return $response;
    }

    public function updateBusinessEntities($id, $params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->put($this->extendUri . 'entities/' . $id, $params);

        return $response;
    }

    public function getBusinessRequests($businessId): array
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/' . $businessId . '/requests/');

        $responseData = json_decode($response->getBody()->getContents());
        $result = array();
        foreach ($responseData as $value) {
            array_push($result, new Request(
                (array)$value
            ));
        }

        return $result;
    }

    public function insertBusinessRequests($params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->post($this->extendUri . 'business-requests/', $params);

        return $response;
    }

    public function updateBusinessRequests($id, $params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->put($this->extendUri . 'business-requests/' . $id . '/', $params);

        return $response;
    }

    public function getBusinessPhotos($businessId): array
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/' . $businessId . '/photos/');

        $responseData = json_decode($response->getBody()->getContents());
        $result = array();

        foreach ($responseData as $value) {
            if($value) {
                array_push($result, new Photo(
                    (array)$value
                ));
            }
        }

        return $result;
    }

    public function getBusinessContacts($businessId): array
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'businesses/' . $businessId . '/contacts/');

        $responseData = json_decode($response->getBody()->getContents());
        $result = array();
        foreach ($responseData as $value) {
            array_push($result, new Contact(
                (array)$value
            ));
        }

        return $result;
    }

    public function insertBusinessContacts($params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->post($this->extendUri . 'business-contacts/', $params);

        return $response;
    }

    public function updateBusinessContacts($id, $params)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->put($this->extendUri . 'business-contacts/' . $id, $params);

        return $response;
    }


    public function getRequirement($id): Requirement
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'requirements/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new Requirement((array)$responseData);
    }

    public function getRequirementType($id): RequirementType
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'requirement-types/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new RequirementType((array)$responseData);
    }

    public function getDistrict($id): District
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'districts/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new District((array)$responseData);
    }

    public function getRegion($id): Region
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'regions/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new Region((array)$responseData);
    }

    public function getCity($id): City
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'cities/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new City((array)$responseData);
    }

    public function getActivityClass($id): ActivityClass
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'activity-classes/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new ActivityClass((array)$responseData);
    }

    public function getActivityGroup($id): ActivityGroup
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'activity-groups/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new ActivityGroup((array)$responseData);
    }

    public function getActivitySection($id): ActivitySection
    {
//        $response = Http::withoutVerifying()->withHeaders(
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'activity-sections/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new ActivitySection((array)$responseData);
    }

    public function getActivitySubClass($id): ActivitySubClass
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'activity-subclasses/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new ActivitySubClass((array)$responseData);
    }

    public function getActivityType($id): ActivityType
    {
//        $response = Http::withoutVerifying()->withHeaders([
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'activity-types/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new ActivityType((array)$responseData);
    }

    public function getIndustry($id): Industry
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'industries/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new Industry((array)$responseData);
    }

    public function getIndustryType($id): IndustryType
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $this->token
        ])->get($this->extendUri . 'industry-types/' . $id);

        $responseData = json_decode($response->getBody()->getContents());

        return new IndustryType((array)$responseData);
    }


}
