<?php

namespace App\Repositories\Enums;

abstract class AppealStatusEnum
{
    const Pending = '1cf63f67-fe81-45fc-97f0-d335251f66f7';
    const DistributorAssigned = '36d72113-ecd0-481b-954b-c5f62d0357af';
    const InWork = '9454eb49-44c5-4c12-8316-a9650f203a8a';
    const CantContact = '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc';
    const CoExecutorAssigned = 'c4c32c42-a651-4195-9a38-5b2c81456350';
    const Confirmed = '1a2f5be3-b525-4856-aa10-1f6fe3580f73';
    const Completed = 'f9840d9f-d405-4c17-9789-8d34b082ad06';
    const Rejected = '21cbcd3d-b6b4-48f4-abbf-4929dde31706';
    const requiresClarification = '107ad887-047c-405d-916e-3d2e3517a17d';
    const DivisionCuratorConfirm = 'ded57df4-80be-4e34-8d76-0e443285f706';
    const DistrictCuratorConfirm = '1c12f4ef-5530-4e35-b6a6-b267c3db3e4a';
    const OnConfirmDistrictCurator = 'f2a7d913-8066-4a24-85b0-030bec7ac782';
    const adviceByProduct = '08992438-a890-4a12-8850-d536f326bd9f';
    const advicebNotByProduct = '23dcd77e-6a53-4562-a175-9f35f7696906';
}








