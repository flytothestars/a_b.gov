<?php

namespace App\Repositories\Enums;

abstract class AppealActionTypeEnum
{
    const DataChanged = 'ecaf25f3-c98b-49b5-87af-5eba97d296d7';
    const ExecutorAssigned = '5ac55ff5-0ccc-4c5e-8966-7b568ed83dc2';
    const CoExecutorAssigned = '273e5685-ed77-476f-a7bf-b097bd7d0f08';
    const DistributorAssigned = '9bdb4fbf-2c97-4b5e-8f5b-995411f269e9';
    const Confirmed = '3874b48a-f95d-489d-9fba-fc2eaf115e79';
    const Completed = 'a5881c96-0ca1-4376-acd3-c5e81503a725';
    const Rejected = 'c470341c-8a6d-479f-a471-d55dbe1f30a9';
    const Returned = 'cf238a8a-7189-4b55-9bed-388547c4b7e6';
    const CuratorAssigned = '135fce4e-d5bd-4537-ac37-cb8fd55aab54';
    const CantContact = '5cf7190e-4504-46a1-ab00-74980e847aee';
}
