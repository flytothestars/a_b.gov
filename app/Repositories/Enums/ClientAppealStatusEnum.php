<?php

namespace App\Repositories\Enums;

abstract class ClientAppealStatusEnum
{
    const Draft = '686205ce-469c-477f-bb05-390abdedd21e';
    const Pending = '1cf63f67-fe81-45fc-97f0-d335251f66f7';
    const InWork = '9454eb49-44c5-4c12-8316-a9650f203a8a';
    const Completed = 'f9840d9f-d405-4c17-9789-8d34b082ad06';
    const Rejected = '21cbcd3d-b6b4-48f4-abbf-4929dde31706';
}
