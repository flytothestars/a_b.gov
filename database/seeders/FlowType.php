<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FlowType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addFlowType('34971c0d-0dfe-4e50-a2b3-0842c74ac9ac', 'Qoldau');
        $this->addFlowType('5aeff8a2-aa51-49bf-9c4a-2b5db2977e9b', 'Upi');
    }

    private function addFlowType($id, $name){
        \App\Models\FlowType::query()->firstOrCreate([
            'id' => $id
        ], [
            'name' => $name
        ]);
    }
}
