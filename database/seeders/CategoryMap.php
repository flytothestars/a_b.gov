<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryMap extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategoryMap('9ad3cc69-6283-469a-8ba4-72f367ff28a0', '17fca7d8-47ce-4c98-abb6-ee3bb405a9db', '20d47f1e-1b63-4e2b-8b83-a714644043b1');
        $this->createCategoryMap('da0a90aa-1918-48eb-9866-4594fbbab90f', '17fca7d8-47ce-4c98-abb6-ee3bb405a9db', '0fdf34ed-48a2-4f08-874c-6cfc6cdeceb8');
        $this->createCategoryMap('5e5e8626-05ef-475e-8d22-97d7627f4d40', '81d51d67-700d-476c-aae4-1e3571b8e84e', '9753ea34-ceaa-4d77-96d3-a9769be87c82');
        $this->createCategoryMap('697d6cd4-5997-49eb-ac9c-e1d947f02b64', '61163fe6-7ea1-47c2-9248-5336b6d45d9b', '3a46ac20-bb1e-4bd3-8a71-b1471f508412');
        $this->createCategoryMap('f4168ee6-6b7d-45d2-a13e-84e7ebd156f1', '81d51d67-700d-476c-aae4-1e3571b8e84e', 'f49ea204-4321-40ad-90e7-2d2bc9ca88eb');
        $this->createCategoryMap('81522e43-4a9a-4122-9d5d-2d7fece2a42e', '81d51d67-700d-476c-aae4-1e3571b8e84e', 'ce899c1c-931d-4aac-a3aa-0e55a3d9a9cc');
        $this->createCategoryMap('b95e60c7-5b03-496b-ad87-daf92612e7f7', '86fb5edc-82db-47d4-ab31-e9a9285b16ab', '847d7be4-a3aa-48b7-82ab-bbdbe5a25ea7');
        $this->createCategoryMap('e0b67fe4-6c22-4e99-8551-da2b14dd3db9', '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'e672518b-9df6-4424-9c8e-daa41becf034');
        $this->createCategoryMap('d3ab3832-7755-42bb-858a-956140f8fdef', '61163fe6-7ea1-47c2-9248-5336b6d45d9b', '0c787d0c-4225-44f0-8c8d-0d16e135bc5b');
        $this->createCategoryMap('b484c514-ac46-4abc-a3c2-a16f8831527e', 'b73710d6-d455-43c4-a5ce-c002d144535a', '0669d1d6-ce0b-4b6f-8996-955d54c9e14a');
        $this->createCategoryMap('c1049fb2-f8ad-47e2-9221-4e682f5b6121', '61163fe6-7ea1-47c2-9248-5336b6d45d9b', '244bca6a-bf42-41f9-ab2b-dedce3f2d2da');
        $this->createCategoryMap('2f35d7ff-45ff-48de-b936-953ddf671f2c', '81d51d67-700d-476c-aae4-1e3571b8e84e', '6c8cf2ed-765f-4624-abea-7de12aeb6f83');
    }

    private function createCategoryMap($id, $serviceGroupId, $externalCategoryId)
    {
        \App\Models\CategoryMap::query()->updateOrCreate([
            'id' => $id
        ], [
            'service_group_id' => $serviceGroupId,
            'external_category_id' => $externalCategoryId,
        ]);
    }
}
