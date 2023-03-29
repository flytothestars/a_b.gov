<?php

namespace App\Repositories\Enums;

abstract class AppealResultTypeEnum
{
    const CompletedByPhone               = 'c4d36116-322d-4ed0-8c33-123dd026b035';
    const ClientNoAnswer                 = 'e70d2209-b0fa-496e-88f7-80dabbb9fece';
    const ByQolday                       = '08992438-a890-4a12-8850-d536f326bd9f';
    const NotByQolday                    = '23dcd77e-6a53-4562-a175-9f35f7696906';
    const RequiresClarification           = '107ad887-047c-405d-916e-3d2e3517a17d';
    const CompletedInQoldauOffice         = 'faa14dae-f9ed-4e48-ae25-0d54298e277c';
    const ClientDidNotComeToConsultation = '755ecc5a-789a-4d69-b180-4c53c223bc0f';
    const CompletedByCoExecutor          = '447b6de8-8936-427d-a0a5-14e0a1719fce';
    const ClientDoesNotGetInTouch        = 'a2a23c34-d129-4ae6-9658-b3cbafcef255';
    const CompletedByClient              = '8f901daa-7ac2-46a8-a7ef-38c0687b3e91';
    const Completed                      = '88838792-c29f-4b5d-becd-6c56dc46a896';
    const NoLegalBasic                   = 'c4032d8ea45b4fa2b8c2a0b52897ac45';
    const NotResponsiblePerson           = 'b29975ce-0384-47c1-9863-9ae50aab343d';
    const NotNeedsIdentified              = 'a3e443d3-1cef-4a69-b9ef-cfe37cbfbc78';
    const OutOfCompetence                = '2f8d8b6e-df2c-4486-8161-44f038fbdfd6';
}
