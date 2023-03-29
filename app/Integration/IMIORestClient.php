<?php

namespace App\Integration;

use App\Integration\Model\ActivityClass;
use App\Integration\Model\ActivityGroup;
use App\Integration\Model\ActivitySection;
use App\Integration\Model\ActivitySubClass;
use App\Integration\Model\ActivityType;
use App\Integration\Model\City;
use App\Integration\Model\District;
use App\Integration\Model\Region;
use App\Integration\Model\Requirement;
use App\Integration\Model\RequirementType;
use App\Integration\Model\Industry;
use App\Integration\Model\IndustryType;

interface   IMIORestClient
{
    public function auth(): void;

    public function getBusinessCount($status, $afterDate): int;
    public function getBusinesses($limit, $offset, $status, $afterDate): array;
    public function getBusiness($id);
    public function insertBusiness($params);
    public function updateBusiness($id, $params);
    public function getBusinessEntities($businessId): array;
    public function insertBusinessEntities($params);
    public function updateBusinessEntities($id, $params);
    public function getBusinessRequests($businessId): array;
    public function insertBusinessRequests($params);
    public function updateBusinessRequests($id, $params);
    public function getBusinessPhotos($businessId): array;
    public function getBusinessContacts($businessId): array;
    public function insertBusinessContacts($params);
    public function updateBusinessContacts($id, $params);

    public function getRequirement($id): Requirement;
    public function getRequirementType($id): RequirementType;
    public function getDistrict($id): District;
    public function getRegion($id): Region;
    public function getCity($id): City;

    public function getActivityClass($id): ActivityClass;
    public function getActivityGroup($id): ActivityGroup;
    public function getActivitySection($id): ActivitySection;
    public function getActivitySubClass($id): ActivitySubClass;
    public function getActivityType($id): ActivityType;
    public function getIndustry($id): Industry;
    public function getIndustryType($id): IndustryType;
}
