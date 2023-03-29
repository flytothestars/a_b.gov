<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportEnbek
{
    public const Id                     = 'id';                                 // record id
    public const ReportId               = 'report_id';                          // report header id
    public const Status                 = 'status';                             // Статус обработки записи
    public const Number                 = 'number';                             // № п/п
    public const STB                    = 'stb';                                // БВУ
    public const Source                 = 'source';                             // источник
    public const CompanyBinIin          = 'bin_iin';                            // БИН
    public const Borrower               = 'borrower';                           // заемщик
    public const Amount                 = 'sum';                                // сумма, тыс.тг
    public const Target                 = 'target';                             // Цель
    public const TypeOfActivityIndustry = 'type_of_activity_industry';          // Вид деятельности, отрасль
    public const ADistrictOfTheCity     = 'a_district_of_the_city';             // Район города (Алатауский, Алмалинсикий  и т.д)
    public const WorkplacesActual       = 'workplaces_actual';                  // Рабочие места Действующее
    public const JobsCreated            = 'jobs_created';                       // Рабочие места Создаваемое
    public const StartUp                = 'start_up';                           // Start-Up
    public const ProjectStatus          = 'project_status';                     // Статус (выдано, одобрено, утвержен, на рассмотрении, сбор документов)
    public const Guarantees             = 'guarantees';                         // Гарантии (тыс. тг)
    public const ProgramDistrictId      = 'program_district_id';                // Id района (таблица districts) определяется по полю ProjectLocation если оно === ProjectRegion то null
    public const CompanyUserId          = 'company_user_id';                    // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const CompanyId              = 'company_id';                         // Id компании - определяется по полю CompanyBinIin в таблице организаций
    public const LastEditorId           = 'last_editor_id';                     // Id последнего редактора записи
    public const IsEdited               = 'is_edited';                          // Были ли внесены изменения пользователем
    public const CreatedAt              = 'created_at';                         // Дата создание
    public const UpdatedAt              = 'updated_at';                         // Дата изменения
    public const Tax                    = 'tax';                                // Рост налоговых поступлений

    public const LastFailComment               = 'last_fail_comment';                       // Список ошибок обработки записи
    public const SumOfProjects                 = 'sum_of_projects';                         // Сумма проектов
    public const NumberOfProjects              = 'number_of_projects';                      // Кол-во проектов
    public const NumberOfProjectsByDistrict    = 'number_of_projects_by_district';          // Кол-во проектов субсидирования по районам
    public const TheAmountOfProjectsByDistrict = 'the_amount_of_projects_by_district';      // Сумма проектов субсидирования по районам
    public const AverageBillPerProject         = 'average_bill_per_project';                // Средний чек на проект
    public const workplaces                    = 'workplaces';                              // Созданные раб места
    public const SavedWorkplaces               = 'saved_workplaces';                        // Сохраненные раб места
    public const NumberOfProjectsByGoals       = 'number_of_projects_by_goals';             // Кол-во проектов по целям финансирования
    public const NumberOfProjectsByIndustry    = 'number_of_projects_by_industry';          // Кол-во проектов субсидирования по отраслям
    public const TheAmountOfProjectsByIndustry = 'the_amount_of_projects_by_industry';      // Сумма проектов субсидирования по отраслям
    public const AverageCheckByDistricts       = 'average_check_by_districts';              // Средний чек на проект по районам
    public const ShareOfStartups               = 'share_of_startups';                       // Доля стартапов от общего кол-ва проектов
    public const AverageBillByIndustry         = 'average_bill_by_industry';                // Средний чек на проект по отраслям


    public const SystemFieldList = [
        self::Id,
        self::ReportId,
        self::Status,
        self::ProgramDistrictId,
        self::CompanyUserId,
        self::CompanyId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const FixedRatios = [
        self::Tax,
    ];

    public const ReportFileFields = [
        self::Number,
        self::STB,
        self::Source,
        self::CompanyBinIin,
        self::Borrower,
        self::Amount,
        self::Target,
        self::TypeOfActivityIndustry,
        self::ADistrictOfTheCity,
        self::WorkplacesActual,
        self::JobsCreated,
        self::StartUp,
        self::ProjectStatus,
        self::Guarantees,
    ];

    public const FieldList = [
        self::Number,
        self::STB,
        self::Source,
        self::CompanyBinIin,
        self::Borrower,
        self::Amount,
        self::Target,
        self::TypeOfActivityIndustry,
        self::ADistrictOfTheCity,
        self::WorkplacesActual,
        self::JobsCreated,
        self::StartUp,
        self::ProjectStatus,
        self::Guarantees,
        self::Id,
        self::ReportId,
        self::Status,
        self::ProgramDistrictId,
        self::CompanyUserId,
        self::CompanyId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
        self::Tax,
    ];

    public const ReportRatios = [
        self::SumOfProjects,
        self::NumberOfProjects,
        self::NumberOfProjectsByDistrict,
        self::TheAmountOfProjectsByDistrict,
        self::AverageBillPerProject,
        self::workplaces,
        self::SavedWorkplaces,
        self::NumberOfProjectsByGoals,
        self::NumberOfProjectsByIndustry,
        self::TheAmountOfProjectsByIndustry,
        self::AverageCheckByDistricts,
        self::ShareOfStartups,
        self::AverageBillByIndustry,
    ];

    public const ReportTableFields = [
        self::Number,
        self::STB,
        self::Amount,
        self::ADistrictOfTheCity,
        self::JobsCreated,
        self::WorkplacesActual,
        self::Target,
        self::TypeOfActivityIndustry,
        self::StartUp,
        self::LastFailComment,
        self::Tax,
    ];

    public const ReportFileFieldsNames = [
        self::Number                 => 'messages.reports.government.fields.Enbek.Number',
        self::STB                    => 'messages.reports.government.fields.Enbek.STB',
        self::Source                 => 'messages.reports.government.fields.Enbek.Source',
        self::CompanyBinIin          => 'messages.reports.government.fields.Enbek.CompanyBinIin',
        self::Borrower               => 'messages.reports.government.fields.Enbek.Borrower',
        self::Amount                 => 'messages.reports.government.fields.Enbek.Amount',
        self::Target                 => 'messages.reports.government.fields.Enbek.Target',
        self::TypeOfActivityIndustry => 'messages.reports.government.fields.Enbek.TypeOfActivityIndustry',
        self::ADistrictOfTheCity     => 'messages.reports.government.fields.Enbek.ADistrictOfTheCity',
        self::WorkplacesActual       => 'messages.reports.government.fields.Enbek.WorkplacesActual',
        self::JobsCreated            => 'messages.reports.government.fields.Enbek.JobsCreated',
        self::StartUp                => 'messages.reports.government.fields.Enbek.StartUp',
        self::ProjectStatus          => 'messages.reports.government.fields.Enbek.ProjectStatus',
        self::Guarantees             => 'messages.reports.government.fields.Enbek.Guarantees',
        self::LastFailComment        => 'messages.reports.government.fields.Enbek.LastFailComment',
        self::Tax        => 'messages.reports.government.fields.Enbek.tax',
    ];


}
