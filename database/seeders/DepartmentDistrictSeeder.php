<?php

namespace Database\Seeders;

use App\Models\DepartmentDistrict;
use App\Models\District;
use Illuminate\Database\Seeder;

class DepartmentDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addDepartmentDistrict('4ca27543-892c-4dc9-84e4-d7b5e774adf8', 'Алатауский');
        $this->addDepartmentDistrict('578100bf-af7e-433d-b1d4-3fd87e6a5c81', 'Алмалинский');
        $this->addDepartmentDistrict('5ea60f7e-8a96-4211-84cb-5d59a9ebbd7d', 'Турксибский');
        $this->addDepartmentDistrict('8f898799-35a1-49f2-9d37-edf5a20ae102', 'Медеуский');
        $this->addDepartmentDistrict('b0c4995f-fd69-4003-9bb5-3b563ad8b716', 'Бостандыкский');
        $this->addDepartmentDistrict('b5550f23-be71-4839-b505-3275db0a5293', 'Жетысуский');
        $this->addDepartmentDistrict('dd2fa2ef-1ace-4ee6-b6c0-fa55bbb0baec', 'Наурызбайский');
        $this->addDepartmentDistrict('df76024a-ab23-4970-8101-e4edaccf77e6', 'Ауэзовский');
    }

    private function addDepartmentDistrict($department, $districtName){
        $district = District::query()->where('name', $districtName)->first();
        DepartmentDistrict::query()->updateOrCreate([
            'department_id' => $department
        ], ['district_id' => $district->id]);
    }
}
