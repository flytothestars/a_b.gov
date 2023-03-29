<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportFieldsTypes
{
    public const TypeInfo    = 'info';       // Информация для отображения / системных целей - не редактируется
    public const TypeText    = 'text';       // Текстовое поле
    public const TypeSelect  = 'select';     // Текстовое поле
    public const TypeDate    = 'date';       // Дата Y-m-d
    public const TypeFloat   = 'float';      // Вещественное число
    public const TypeInteger = 'int';        // Целое число
    public const TypeBoolean = 'bool';       // Логическое значение

}
