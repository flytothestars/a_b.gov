<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportAlmatyBusinessMFO
{
    public const Id                    = 'id';                          // record id
    public const ReportId              = 'report_id';                   // report header id
    public const Status                = 'status';                      // Статус обработки записи
    public const Number                = 'number';                      // № п/п
    public const Name                  = 'name';                        // Наименование
    public const CurrentActivity       = 'current_activity';            // Вид текущей деятельности
    public const PlannedTypeOfActivity = 'planned_type_of_activity';    // планируемый вид деятельности (отрасль)
    public const Place                 = 'place';                       // место реализации, район
    public const LimitAmount           = 'limit_amount';                // Сумма лимита (тенге)
    public const WorkPlace             = 'work_place';                  // Раб.места
    public const CompanyBinIin         = 'iin_bin';                     // ИИН/БИН
    public const ProgramDistrictId     = 'program_district_id';         // Id района (таблица districts) определяется по полю ProjectLocation если оно === ProjectRegion то null
    public const CompanyUserId         = 'company_user_id';             // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const CompanyId             = 'company_id';                  // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const LastEditorId          = 'last_editor_id';              // Id последнего редактора записи
    public const IsEdited              = 'is_edited';                   // Были ли внесены изменения пользователем
    public const LastFailComment       = 'last_fail_comment';           // Список ошибок обработки записи
    public const CreatedAt             = 'created_at';                  // Дата создание
    public const UpdatedAt             = 'updated_at';                  // Дата изменения
    public const Tax                   = 'tax';                         // Рост налоговых поступлений

    public const RatioSumOfProjects     = 'sum_of_projects';        // Сумма проектов
    public const RatioNumberOfProjects  = 'number_of_projects';     // Кол-во проектов
    public const RatioNumberByDistrict  = 'number_by_district';     // Кол-во проектов субсидирования по районам
    public const RatioAmountDistrict    = 'amount_district';        // Сумма проектов субсидирования по районам
    public const RatioAverageBill       = 'average_bill';           // Средний чек на проект
    public const RatioCreatedWorkplace  = 'created_workplace';      // Созданные раб места
    public const RatioNumberByPurpose   = 'number_by_purpose';      // Кол-во проектов по целям финансирования
    public const RatioNumberByIndustry  = 'number_by_industry';     // Кол-во проектов субсидирования по отраслям
    public const RatioAmountByIndustry  = 'amount_by_industry';     // Сумма проектов субсидирования по отраслям
    public const RatioAverageByDistrict = 'average_by_district';    // Средний чек на проект по районам
    public const RatioAverageByIndustry = 'average_by_industry';    // Средний чек на проект по отраслям


    public const SystemFieldList = [
        self::Id,
        self::ReportId,
        self::Status,
        self::CompanyId,
        self::ProgramDistrictId,
        self::CompanyUserId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const ReportFileFields = [
        self::Number,
        self::Name,
        self::CurrentActivity,
        self::PlannedTypeOfActivity,
        self::Place,
        self::LimitAmount,
        self::WorkPlace,
        self::CompanyBinIin,
    ];
    public const FieldList        = [
        self::Number,
        self::Name,
        self::CurrentActivity,
        self::PlannedTypeOfActivity,
        self::Place,
        self::LimitAmount,
        self::WorkPlace,
        self::CompanyBinIin,
        self::Id,
        self::ReportId,
        self::Status,
        self::CompanyId,
        self::ProgramDistrictId,
        self::CompanyUserId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const ReportRatios = [
        self::RatioSumOfProjects,
        self::RatioNumberOfProjects,
        self::RatioNumberByDistrict,
        self::RatioAmountDistrict,
        self::RatioAverageBill,
        self::RatioCreatedWorkplace,
        self::RatioNumberByPurpose,
        self::RatioNumberByIndustry,
        self::RatioAmountByIndustry,
        self::RatioAverageByDistrict,
        self::RatioAverageByIndustry,
    ];

    public const ReportTableFields = [
        self::Number,
        self::Name,
        self::CurrentActivity,
        self::PlannedTypeOfActivity,
        self::Place,
        self::LimitAmount,
        self::WorkPlace,
        self::LastFailComment,
    ];

    public const FixedRatios = [
        self::Tax,
    ];

    public const ReportFileFieldsNames = [
        self::Number                => 'messages.reports.government.fields.MFO.Number',
        self::Name                  => 'messages.reports.government.fields.MFO.Name',
        self::CurrentActivity       => 'messages.reports.government.fields.MFO.CurrentActivity',
        self::PlannedTypeOfActivity => 'messages.reports.government.fields.MFO.PlannedTypeOfActivity',
        self::Place                 => 'messages.reports.government.fields.MFO.Place',
        self::LimitAmount           => 'messages.reports.government.fields.MFO.LimitAmount',
        self::WorkPlace             => 'messages.reports.government.fields.MFO.WorkPlace',
        self::CompanyBinIin         => 'messages.reports.government.fields.MFO.CompanyBinIin',
        self::LastFailComment       => 'messages.reports.government.fields.MFO.LastFailComment',
        self::Tax       => 'messages.reports.government.fields.MFO.tax',
    ];
}
