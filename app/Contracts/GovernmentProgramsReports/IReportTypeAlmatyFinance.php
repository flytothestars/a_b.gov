<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportTypeAlmatyFinance
{
    public const Id                       = 'id';                           // record id
    public const ReportId                 = 'report_id';                    // report header id
    public const Status                   = 'status';                       // Статус обработки записи
    public const Number                   = 'number';                       // № п/п
    public const EntrepreneurName         = 'entrepreneur_name';            // Наименование предпринимателя
    public const CompanyBinIin            = 'bin_iin';                      // БИН/ИИН
    public const SubjectSize              = 'subject_size';                 // Размер субъекта
    public const PlaceOfImplementation    = 'place_of_implementation';      // Место реализации
    public const CreditAmount             = 'credit_amount';                // Сумма кредита
    public const LoanRate                 = 'loan_rate';                    // Ставка по кредиту
    public const CurrentWorkPlace         = 'current_workplace';            // Текущее кол-во рабочих мест
    public const CreatedWorkPlace         = 'created__workplace';           // Кол-во создаваемых рабочих мест
    public const BranchOfActivity         = 'branch_of_activity';           // Отрасль деятельности
    public const OKED                     = 'oked';                         // ОКЭД
    public const BusinessOfImplementation = 'business_of_implementation';   // Что будет на месте реализации
    public const PurposeOfTheLoan         = 'purpose_of_the_loan';          // Целевое назначение кредита
    public const ProjectStatus            = 'project_status';               // Статус проекта
    public const DateOfIssue              = 'date_of_issue';                // Дата выдачи
    public const LegalAddressOfTheCompany = 'legal_address';                // Юридический адрес компании
    public const FullNameOfTheHead        = 'head_full_name';               // ФИО руководителя
    public const Contacts                 = 'contacts';                     // Контакты
    public const ProgramDistrictId        = 'program_district_id';          // Id района (таблица districts) определяется по полю ProjectLocation если оно === ProjectRegion то null
    public const CompanyUserId            = 'company_user_id';              // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const CompanyId                = 'company_id';                   // Id компании - определяется по полю CompanyBinIin в таблице организаций
    public const LastEditorId             = 'last_editor_id';               // Id последнего редактора записи
    public const LastFailComment          = 'last_fail_comment';            // Список ошибок обработки записи
    public const IsEdited                 = 'is_edited';                    // Были ли внесены изменения пользователем
    public const CreatedAt                = 'created_at';                   // Дата создание
    public const UpdatedAt                = 'updated_at';                   // Дата изменения
    public const Tax                      = 'tax';                          // Рост налоговых поступлений

    public const RatioSumOfProjects       = 'sum_of_projects';              // Сумма проектов
    public const RatioNumberOfProjects    = 'number_of_projects';           // Кол-во проектов
    public const RatioNumberByDistrict    = 'number_by_district';           // Кол-во проектов субсидирования по районам
    public const RatioTheAmountByDistrict = 'the_amount_by_district';       // Сумма проектов субсидирования по районам
    public const RatioAverageBill         = 'average_bill';                 // Средний чек на проект
    public const RatioCreatedWorkplace    = 'created_workplace';            // Созданные раб места
    public const RatioSavedWorkplace      = 'saved_workplace';              // Сохраненные раб места
    public const RatioNumberByPurpose     = 'number_by_purpose';            // Кол-во проектов по целям финансирования
    public const RatioNumberByIndustry    = 'number_by_industry';           // Кол-во проектов субсидирования по отраслям
    public const RatioTheAmountByIndustry = 'the_amount_by_industry';       // Сумма проектов субсидирования по отраслям
    public const RatioAverageByDistrict   = 'average_by_district';          // Средний чек на проект по районам
    public const RatioAverageByIndustry   = 'average_by_industry';          // Средний чек на проект по отраслям

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
        self::EntrepreneurName,
        self::CompanyBinIin,
        self::SubjectSize,
        self::PlaceOfImplementation,
        self::CreditAmount,
        self::LoanRate,
        self::CurrentWorkPlace,
        self::CreatedWorkPlace,
        self::BranchOfActivity,
        self::OKED,
        self::BusinessOfImplementation,
        self::PurposeOfTheLoan,
        self::ProjectStatus,
        self::DateOfIssue,
        self::LegalAddressOfTheCompany,
        self::FullNameOfTheHead,
        self::Contacts,
    ];

    public const FieldList = [
        self::Number,
        self::EntrepreneurName,
        self::CompanyBinIin,
        self::SubjectSize,
        self::PlaceOfImplementation,
        self::CreditAmount,
        self::LoanRate,
        self::CurrentWorkPlace,
        self::CreatedWorkPlace,
        self::BranchOfActivity,
        self::OKED,
        self::BusinessOfImplementation,
        self::PurposeOfTheLoan,
        self::ProjectStatus,
        self::DateOfIssue,
        self::LegalAddressOfTheCompany,
        self::FullNameOfTheHead,
        self::Contacts,
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

    public const ReportRatios = [
        self::RatioSumOfProjects,
        self::RatioNumberOfProjects,
        self::RatioNumberByDistrict,
        self::RatioTheAmountByDistrict,
        self::RatioAverageBill,
        self::RatioCreatedWorkplace,
        self::RatioSavedWorkplace,
        self::RatioNumberByPurpose,
        self::RatioNumberByIndustry,
        self::RatioTheAmountByIndustry,
        self::RatioAverageByDistrict,
        self::RatioAverageByIndustry,
    ];

    public const ReportTableFields = [
        self::Number,
        self::EntrepreneurName,
        self::CreditAmount,
        self::PlaceOfImplementation,
        self::CreatedWorkPlace,
        self::CurrentWorkPlace,
        self::PurposeOfTheLoan,
        self::BranchOfActivity,
        self::LastFailComment,
    ];

    public const ReportFileFieldsNames = [
        self::Number                   => 'messages.reports.government.fields.AlmatyFinance.Number',
        self::EntrepreneurName         => 'messages.reports.government.fields.AlmatyFinance.EntrepreneurName',
        self::CompanyBinIin            => 'messages.reports.government.fields.AlmatyFinance.CompanyBinIin',
        self::SubjectSize              => 'messages.reports.government.fields.AlmatyFinance.SubjectSize',
        self::PlaceOfImplementation    => 'messages.reports.government.fields.AlmatyFinance.PlaceOfImplementation',
        self::CreditAmount             => 'messages.reports.government.fields.AlmatyFinance.CreditAmount',
        self::LoanRate                 => 'messages.reports.government.fields.AlmatyFinance.LoanRate',
        self::CurrentWorkPlace         => 'messages.reports.government.fields.AlmatyFinance.CurrentWorkPlace',
        self::CreatedWorkPlace         => 'messages.reports.government.fields.AlmatyFinance.CreatedWorkPlace',
        self::BranchOfActivity         => 'messages.reports.government.fields.AlmatyFinance.BranchOfActivity',
        self::OKED                     => 'messages.reports.government.fields.AlmatyFinance.OKED',
        self::BusinessOfImplementation => 'messages.reports.government.fields.AlmatyFinance.BusinessOfImplementation',
        self::PurposeOfTheLoan         => 'messages.reports.government.fields.AlmatyFinance.PurposeOfTheLoan',
        self::ProjectStatus            => 'messages.reports.government.fields.AlmatyFinance.ProjectStatus',
        self::DateOfIssue              => 'messages.reports.government.fields.AlmatyFinance.dateOfIssue',
        self::LegalAddressOfTheCompany => 'messages.reports.government.fields.AlmatyFinance.LegalAddressOfTheCompany',
        self::FullNameOfTheHead        => 'messages.reports.government.fields.AlmatyFinance.FullNameOfTheHead',
        self::Contacts                 => 'messages.reports.government.fields.AlmatyFinance.Contacts',
        self::LastFailComment          => 'messages.reports.government.fields.AlmatyFinance.LastFailComment',
        self::Tax                      => 'messages.reports.government.fields.AlmatyFinance.tax',
    ];

}
