<?php

namespace App\Services\MSB;

use Illuminate\Contracts\Support\Arrayable;

interface IProgramByBinIinResponse extends Arrayable
{

    public const ResponseFieldVersion        = 'version';            // Версия api
    public const ResponseFieldOkedCompany    = 'oked_company';       // Вид деятельности
    public const ResponseFieldOked           = 'oked';               // Список видов деятельности
    public const ResponseFieldKatoCompany    = 'kato_company';       // Юридический адрес
    public const ResponseFieldKato           = 'kato';               // КАТО
    public const ResponseFieldKRP            = 'krp';                // krp
    public const ResponseFieldName           = 'name';               // Наименование компании
    public const ResponseFieldPrograms       = 'programs';           // Список доступных программ
    public const ResponseFieldInfrastructure = 'infrastructure';

    public const RawResponseFields = [
        self::ResponseFieldVersion,
        self::ResponseFieldOkedCompany,
        self::ResponseFieldOked,
        self::ResponseFieldKatoCompany,
        self::ResponseFieldKato,
        self::ResponseFieldKRP,
        self::ResponseFieldName,
        self::ResponseFieldPrograms,
        self::ResponseFieldInfrastructure,
    ];

    public function getCommonInformationData(): array;

    /**
     * @return IProgramInfo[]
     */
    public function getPrograms(): array;

}
