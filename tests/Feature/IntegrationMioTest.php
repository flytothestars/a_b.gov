<?php

namespace Tests\Feature;

use App\Integration\Model\Business;
use App\Integration\Model\City;
use App\Integration\Model\Contact;
use App\Integration\Model\District;
use App\Integration\Model\Entity;
use App\Integration\Model\Photo;
use App\Integration\Model\Region;
use App\Integration\Model\Request;
use App\Integration\Model\Requirement;
use App\Integration\Model\RequirementType;
use App\Models\User;
use App\Notifications\MioIntegrationError;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class IntegrationMioTest extends TestCase
{
    public function testGetBusinessCount()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();

        $result = $import->getBusinessCount('ACCEPTED', '2021-08-23', '2021-09-13');
        echo($result);
        $this->assertIsNumeric($result);
    }

    public function testGetBusiness()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getBusiness(10, 0, 'ACCEPTED', '2021-08-23', '2021-09-13');
//        echo($result[0]->location['coordinates'][0]);
        echo(sizeof($result));

        $this->assertIsArray($result);
        $this->assertInstanceOf(Business::class, $result[0]);

    }

    public function testGetBusinessEntities()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getBusinessEntities('a91a4282-8f38-4b1f-89f2-6bb3a431aad3');
//        echo($result[0]->name);
        $this->assertIsArray($result);
        $this->assertInstanceOf(Entity::class, $result[0]);
    }

    public function testGetBusinessRequests()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getBusinessRequests('418eac80-a427-423c-a166-dfb2f54da951');
        echo($result[0]->status);
        $this->assertIsArray($result);
        $this->assertInstanceOf(Request::class, $result[0]);
        $this->assertIsString($result[0]->business);
    }

    public function testGetBusinessContacts()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getBusinessContacts('418eac80-a427-423c-a166-dfb2f54da951');
        echo($result[0]->full_name);
        $this->assertIsArray($result);
        $this->assertInstanceOf(Contact::class, $result[0]);
        $this->assertIsString($result[0]->business);
    }

    public function testGetBusinessPhotos()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getBusinessPhotos('418eac80-a427-423c-a166-dfb2f54da951');
        echo($result[0]->photo_url);
        $this->assertIsArray($result);
        $this->assertInstanceOf(Photo::class, $result[0]);
        $this->assertIsString($result[0]->photo_url);
    }

    public function testGetRequirement()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getRequirement('9753ea34-ceaa-4d77-96d3-a9769be87c82');
        echo($result->name);
        $this->assertInstanceOf(Requirement::class, $result);
        $this->assertIsString($result->name);
    }

    public function testGetRequirementType()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getRequirementType('adb57eb4-e746-4f0f-86f1-bb67759f945e');
        echo($result->name);
        $this->assertInstanceOf(RequirementType::class, $result);
        $this->assertIsString($result->name);
    }

    public function testGetRegions()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getRegion('a9dc2bff-d317-4151-8cae-a078f2220c6b');
        echo($result->name);
        $this->assertInstanceOf(Region::class, $result);
        $this->assertIsString($result->name);
    }

    public function testGetCities()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getCity('c69ac69b-3b24-4885-bb7d-28fe6186abc6');
        echo($result->name);
        $this->assertInstanceOf(City::class, $result);
        $this->assertIsString($result->name);
    }

    public function testGetDistrict()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
        $result = $import->getDistrict('586616c9-342d-4566-8b77-553696ce7621');
        echo($result->name);
        $this->assertInstanceOf(District::class, $result);
        $this->assertIsString($result->name);
    }

//    public function testMioIntegrationService()
//    {
//        $import = new \App\Integration\MIORestClient();
//        $mioIntegrationLogRepository = new MioIntegrationLogRepository();
//        $service = new \App\Integration\MioIntegrationService($import, $mioIntegrationLogRepository);
//        $service->upload();
//        $this->assertTrue(true);
//    }

    public function testNotification()
    {
        $role = RoleIntEnum::Administrator;
        $users = User::whereHas('roles', function ($q) use ($role) {
            $q->where('role_id', $role);
        })->get();
        Notification::send($users, new MioIntegrationError());
//        Notification::route('telegram', env('TELEGRAM_BOT_TOKEN'))
//            ->notify(new MioIntegrationError());
    }
}
