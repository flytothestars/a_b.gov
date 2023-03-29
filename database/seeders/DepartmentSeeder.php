<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addDepartment('7061f99a-fbec-4803-a5b3-f0cc1755c943', null,'УПиИ');
            $this->addDepartment('d7b55215-839d-4b4d-a6d5-ff7628c2e1ae', '7061f99a-fbec-4803-a5b3-f0cc1755c943', 'Направление 1');
            $this->addDepartment('dadc6867-ca42-415b-ac8f-8e07a4dbe7b4', '7061f99a-fbec-4803-a5b3-f0cc1755c943', 'Направление 2');
            $this->addDepartment('8ed4991a-9ca7-4a70-a007-30999515885d', '7061f99a-fbec-4803-a5b3-f0cc1755c943', 'Направление 3');
            $this->addDepartment('649d8633-6e72-46c4-b28a-15f89eb3331b', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae', 'Отдел 1');
            $this->addDepartment('3b3e4660-4724-4f42-9c4e-d7fdd8205772', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae', 'Отдел 2');
            $this->addDepartment('ed834278-55fd-4096-878d-4a8a36c3c01d', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae', 'Отдел 3');
            $this->addDepartment('7dc79f5f-535a-4403-97ee-fe63ea670ac5', 'd7b55215-839d-4b4d-a6d5-ff7628c2e1ae', 'Отдел 4');
            $this->addDepartment('a73e2ddf-ebfd-442e-9e1b-b82e4acf6cdd', 'dadc6867-ca42-415b-ac8f-8e07a4dbe7b4', 'Отдел 5');
            $this->addDepartment('23ea9b5d-8d1e-42a5-aa1a-6aca0e1dd7cc', 'dadc6867-ca42-415b-ac8f-8e07a4dbe7b4', 'Отдел 6');
            $this->addDepartment('0a9f4e42-03a0-4272-b301-e57dfe0a7170', 'dadc6867-ca42-415b-ac8f-8e07a4dbe7b4', 'Отдел 7');
            $this->addDepartment('d4fdf06e-c744-4050-aa1f-671b5c7fc31f', '8ed4991a-9ca7-4a70-a007-30999515885d', 'Отдел 8');
            $this->addDepartment('0dd52384-a49b-4285-8e84-4ea3dd240af5', '8ed4991a-9ca7-4a70-a007-30999515885d', 'Отдел 9');
            $this->addDepartment('0f85a7c3-0281-4d94-81d4-b0de253ba21c', '8ed4991a-9ca7-4a70-a007-30999515885d', 'Отдел 10');

        $this->addDepartment('3d693e95-d6bb-492a-ad09-a5b26ed04dcc', null,'ЦП "Qolday"');
            $this->addDepartment('840542f4-4dc6-4b94-89dd-8e48bad53873', '3d693e95-d6bb-492a-ad09-a5b26ed04dcc', 'ДКРНП');
            $this->addDepartment('615cfce0-aa59-4f42-856a-71ab86fd97a4', '3d693e95-d6bb-492a-ad09-a5b26ed04dcc', 'ДСП');
            $this->addDepartment('6362e34f-cf6d-41e4-a128-951ee62da35f', '3d693e95-d6bb-492a-ad09-a5b26ed04dcc', 'ДРД');
            $this->addDepartment('5942d308-041c-49da-8e0e-4a31b7d5d068', '3d693e95-d6bb-492a-ad09-a5b26ed04dcc', 'ДО');

        $this->addDepartment('7f0015ec-303d-4972-a23b-41302a730330', null,'Almaty MFO');
        $this->addDepartment('b5eebd4b-4d20-4f63-86f5-5c60805f31e2', null,'Almaty Finance');

        $this->addDepartment('578100bf-af7e-433d-b1d4-3fd87e6a5c81', null,'Алмалинский акимат');
        $this->addDepartment('4ca27543-892c-4dc9-84e4-d7b5e774adf8', null,'Алатауский акимат');
        $this->addDepartment('df76024a-ab23-4970-8101-e4edaccf77e6', null,'Ауэзовский акимат');
        $this->addDepartment('b0c4995f-fd69-4003-9bb5-3b563ad8b716', null,'Бостандыкский акимат');
        $this->addDepartment('8f898799-35a1-49f2-9d37-edf5a20ae102', null,'Медеуский акимат');
        $this->addDepartment('dd2fa2ef-1ace-4ee6-b6c0-fa55bbb0baec', null,'Наурызбайский акимат');
        $this->addDepartment('5ea60f7e-8a96-4211-84cb-5d59a9ebbd7d', null,'Турксибский акимат');
        $this->addDepartment('b5550f23-be71-4839-b505-3275db0a5293', null,'Жетысуский акимат');
    }

    private function addDepartment($id, $parentId, $name){
        Department::query()->updateOrCreate([
            'id' => $id
        ], [
            'parent_department_id' => $parentId,
            'name' => $name
        ]);
    }
}
