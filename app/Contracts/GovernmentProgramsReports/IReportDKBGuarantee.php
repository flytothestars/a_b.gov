<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportDKBGuarantee
{
    public const Id                              = 'id';                                 // record id
    public const ReportId                        = 'report_id';                          // report header id
    public const Status                          = 'status';                             // Статус обработки записи
    public const Number                          = 'number';                             // № п/п
    public const CompanyType                     = 'company_type';                       // ОПФ (ТОО/ИП)
    public const Name                            = 'name';                               // Наименование Заёмщика
    public const ProjectDescription              = 'project_description';                // Описание проекта
    public const LoanTarget                      = 'loan_target';                        // Цель кредита
    public const BankIssueDate                   = 'bank_issue_date';                    // Дата заявления заемщика в Банк
    public const BankUODecisionDate              = 'bank_uo_decision_date';              // Дата решения УО Банка
    public const Industry                        = 'industry';                           // Отрасль
    public const SubIndustry                     = 'sub_industry';                       // Подотрасль
    public const LenderBank                      = 'lender_bank';                        // Банк кредитор
    public const LoanAmount                      = 'loan_amount';                        // Сумма кредита (тенге)
    public const LoanGuarantee                   = 'loan_guarantee';                     // Сумма гарантии (тенге)
    public const LoanGuaranteePeriod             = 'loan_guarantee_period';              // Срок гарантии       (в месяцах)
    public const FoundationDecisionDate          = 'foundation_decision_date';           // Дата решения Фонда
    public const SignGuaranteeAgreementDate      = 'sign_guarantee_agreement_date';      // Дата подписания договора гарантии
    public const GuaranteeAgreementNumber        = 'guarantee_agreement_number';         // № Договора гарантии
    public const CurrentEmployeesCount           = 'current_employers_count';            // Текущее кол-во работников
    public const NewJobsPlacesCount              = 'new_jobs_places_count';              // Количество новых создаваемых рабочих мест
    public const WomenEntrepreneurshipCompliance = 'women_entrepreneurship_compliance';  // Соответствие параметрам женского предпринимательства (да, нет)
    public const CompanyHeadDateOfBirth          = 'company_head_date_of_birth';         // Дата рождения ИП/ главы крестьянского хозяйства
    public const ProjectRegion                   = 'project_region';                     // Регион
    public const ProjectLocation                 = 'project_location';                   // Место реализации проекта (район, либо город (если он не относится к району)
    public const ProjectLocationInMonocity       = 'project_location_in_monocity';       // Проект реализуется в моногороде (ППРК от 01/10/2014г/ (да /нет)
    public const DKBProgram                      = 'dkb_program';                        // Программа (ДКБ 2025/ АГ)
    public const ProgramDirection                = 'program_direction';                  // Направление программы (первое/второе)
    public const FundingSource                   = 'funding_source';                     // Источник финансирования
    public const LoanPercent                     = 'loan_percent';                       // % по кредитам
    public const GuaranteeKind                   = 'guarantee_kind';                     // Вид гарантии (МНП,НП,ЭГ,ИГ,ММП)
    public const GuaranteeEndDate                = 'guarantee_end_date';                 // Дата окончания договора гарантии
    public const GuaranteeExpired                = 'guarantee_expired';                  // Срок гарантии истек (да, нет)
    public const ProjectStatus                   = 'project_status';                     // Статус проекта (действующий, истек срок действия гарантии, аннулированный, расторгнутый, досрочно погашенный, дефолт)
    public const GuaranteeExpireDate             = 'guarantee_expire_date';              // Дата фактического прекращения действия гарантии
    public const BankPayOnDemandAmount           = 'bank_pay_on_demand_amount';          // Сумма, выплаченная Банку  по требованию (тенге)
    public const CompanyBinIin                   = 'bin_iin';                            // ИИН/БИН
    public const RFManagerFullName               = 'rf_manager_full_name';               // Ф.И.О.менеджера РФ
    public const Year                            = 'year';                               // Год
    public const Quarter                         = 'quarter';                            // Квартал оприходования в системе бухгалтерского учета
    public const PortfolioGuarantee              = 'portfolio_guarantee';                // Портфельное гарантирование (да/нет)
    public const PGCommissionRegistrationDate    = 'pg_commission_registration_date';    // Дата регистрации компании по ПГ
    public const ProgramCityId                   = 'program_city_id';                    // Id города (таблица cities) - определяется по полю ProjectRegion (Регион)
    public const IsRegionProject                 = 'is_region_project';                  // Если поле Регион === Место реализации проекта (ProjectRegion === ProjectLocation)
    public const ProgramDistrictId               = 'program_district_id';                // Id района (таблица districts) определяется по полю ProjectLocation если оно === ProjectRegion то null
    public const CompanyUserId                   = 'company_user_id';                    // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const LastEditorId                    = 'last_editor_id';                     // Id последнего редактора записи
    public const IsEdited                        = 'is_edited';                          // Были ли внесены изменения пользователем
    public const LastFailComment                 = 'last_fail_comment';                  // Список ошибок обработки записи
    public const CreatedAt                       = 'created_at';                         // Дата создание
    public const UpdatedAt                       = 'updated_at';                         // Дата изменения

    public const RatioAmount                    = 'amount';                         // Сумма всех кредитов (LoanAmount) по проекту
    public const RatioCount                     = 'count';                          // Количество проектов (сумма всех записей)
    public const RatioContByRegion              = 'count_by_regions';               // Количество проектов по каждому району (ProjectLocation) + общие на все районы ProjectRegion(IsRegionProject)
    public const RatioAmountByRegion            = 'amount_by_regions';              // Сумма всех проектов группированная каждому району (ProjectLocation) + общие на все районы ProjectRegion(IsRegionProject)
    public const RatioAverageProjectAmount      = 'average_amount';                 // Средний чек по проектам RatioAmount/RatioCount
    public const RatioNewJpbPlaces              = 'new_jop_places';                 // Сумма всех новых рабочих мест (NewJobsPlacesCount)
    public const RatioSavedJpbPlaces            = 'saved_jop_places';               // Сумма всех сохраненных рабочих мест (CurrentEmployeesCount)
    public const RatioProjectsTargetsCount      = 'projects_targets_count';         // Количество проектов группированных по целям (LoanTarget)
    public const RatioLoanAmountByIndustry      = 'loan_amount_by_industry';        // Сумма кредитов группированная по отраслям (LoanAmount(Industry))
    public const RatioProjectsCountByIndustry   = 'projects_count_by_industry';     // Количество проектов группированных по отраслям (RatioCount(Industry))
    public const RatioProjectsCountByDirection  = 'projects_count_by_direction';    // Количество проектов группированных по направлениям (ProgramDirection)
    public const RatioProjectsAmountByDirection = 'projects_amount_by_direction';   // Сумма кредитов (LoanAmount) группированная по направлениям (ProgramDirection)
    public const RatioAverageAmountByRegion     = 'average_amount_by_regions';      // Средний чек по проектам группированный по по каждому району + общий
    public const RatioAmountByLenderBank        = 'count_by_lender_bank';           // Количество проектов группированных по банку выдавшему займ (LenderBank)
    public const RatioAverageAmountByIndustry   = 'average_amount_by_industry';     // Средний чек по каждой отрасли Industry(RatioAmount/RatioCount)

    public const SystemFieldList = [
        self::Id,
        self::ReportId,
        self::Status,
        self::ProgramCityId,
        self::IsRegionProject,
        self::ProgramDistrictId,
        self::CompanyUserId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const FixedRatios = [];

    public const ReportFileFields = [
        self::Number,
        self::CompanyType,
        self::Name,
        self::ProjectDescription,
        self::LoanTarget,
        self::BankIssueDate,
        self::BankUODecisionDate,
        self::Industry,
        self::SubIndustry,
        self::LenderBank,
        self::LoanAmount,
        self::LoanGuarantee,
        self::LoanGuaranteePeriod,
        self::FoundationDecisionDate,
        self::SignGuaranteeAgreementDate,
        self::GuaranteeAgreementNumber,
        self::CurrentEmployeesCount,
        self::NewJobsPlacesCount,
        self::WomenEntrepreneurshipCompliance,
        self::CompanyHeadDateOfBirth,
        self::ProjectRegion,
        self::ProjectLocation,
        self::ProjectLocationInMonocity,
        self::DKBProgram,
        self::ProgramDirection,
        self::FundingSource,
        self::LoanPercent,
        self::GuaranteeKind,
        self::GuaranteeEndDate,
        self::GuaranteeExpired,
        self::ProjectStatus,
        self::GuaranteeExpireDate,
        self::BankPayOnDemandAmount,
        self::CompanyBinIin,
        self::RFManagerFullName,
        self::Year,
        self::Quarter,
        self::PortfolioGuarantee,
        self::PGCommissionRegistrationDate,
    ];

    public const ReportFileFieldsNames = [
        self::Number                          => 'messages.reports.government.fields.Guarantee.Number',
        self::CompanyType                     => 'messages.reports.government.fields.Guarantee.CompanyType',
        self::Name                            => 'messages.reports.government.fields.Guarantee.Name',
        self::ProjectDescription              => 'messages.reports.government.fields.Guarantee.ProjectDescription',
        self::LoanTarget                      => 'messages.reports.government.fields.Guarantee.LoanTarget',
        self::BankIssueDate                   => 'messages.reports.government.fields.Guarantee.BankIssueDate',
        self::BankUODecisionDate              => 'messages.reports.government.fields.Guarantee.BankUODecisionDate',
        self::Industry                        => 'messages.reports.government.fields.Guarantee.Industry',
        self::SubIndustry                     => 'messages.reports.government.fields.Guarantee.SubIndustry',
        self::LenderBank                      => 'messages.reports.government.fields.Guarantee.LenderBank',
        self::LoanAmount                      => 'messages.reports.government.fields.Guarantee.LoanAmount',
        self::LoanGuarantee                   => 'messages.reports.government.fields.Guarantee.LoanGuarantee',
        self::LoanGuaranteePeriod             => 'messages.reports.government.fields.Guarantee.LoanGuaranteePeriod',
        self::FoundationDecisionDate          => 'messages.reports.government.fields.Guarantee.FoundationDecisionDate',
        self::SignGuaranteeAgreementDate      => 'messages.reports.government.fields.Guarantee.SignGuaranteeAgreementDate',
        self::GuaranteeAgreementNumber        => 'messages.reports.government.fields.Guarantee.GuaranteeAgreementNumber',
        self::CurrentEmployeesCount           => 'messages.reports.government.fields.Guarantee.CurrentEmployeesCount',
        self::NewJobsPlacesCount              => 'messages.reports.government.fields.Guarantee.NewJobsPlacesCount',
        self::WomenEntrepreneurshipCompliance => 'messages.reports.government.fields.Guarantee.WomenEntrepreneurshipCompliance',
        self::CompanyHeadDateOfBirth          => 'messages.reports.government.fields.Guarantee.CompanyHeadDateOfBirth',
        self::ProjectRegion                   => 'messages.reports.government.fields.Guarantee.ProjectRegion',
        self::ProjectLocation                 => 'messages.reports.government.fields.Guarantee.ProjectLocation',
        self::ProjectLocationInMonocity       => 'messages.reports.government.fields.Guarantee.ProjectLocationInMonocity',
        self::DKBProgram                      => 'messages.reports.government.fields.Guarantee.DKBProgram',
        self::ProgramDirection                => 'messages.reports.government.fields.Guarantee.ProgramDirection',
        self::FundingSource                   => 'messages.reports.government.fields.Guarantee.FundingSource',
        self::LoanPercent                     => 'messages.reports.government.fields.Guarantee.LoanPercent',
        self::GuaranteeKind                   => 'messages.reports.government.fields.Guarantee.GuaranteeKind',
        self::GuaranteeEndDate                => 'messages.reports.government.fields.Guarantee.GuaranteeEndDate',
        self::GuaranteeExpired                => 'messages.reports.government.fields.Guarantee.GuaranteeExpired',
        self::ProjectStatus                   => 'messages.reports.government.fields.Guarantee.ProjectStatus',
        self::GuaranteeExpireDate             => 'messages.reports.government.fields.Guarantee.GuaranteeExpireDate',
        self::BankPayOnDemandAmount           => 'messages.reports.government.fields.Guarantee.BankPayOnDemandAmount',
        self::CompanyBinIin                   => 'messages.reports.government.fields.Guarantee.CompanyBinIin',
        self::RFManagerFullName               => 'messages.reports.government.fields.Guarantee.RFManagerFullName',
        self::Year                            => 'messages.reports.government.fields.Guarantee.Year',
        self::Quarter                         => 'messages.reports.government.fields.Guarantee.Quarter',
        self::PortfolioGuarantee              => 'messages.reports.government.fields.Guarantee.PortfolioGuarantee',
        self::PGCommissionRegistrationDate    => 'messages.reports.government.fields.Guarantee.PGCommissionRegistrationDate',
        self::LastFailComment                 => 'messages.reports.government.fields.Guarantee.LastFailComment',
    ];

    public const FieldList = [
        self::Number,
        self::CompanyType,
        self::Name,
        self::ProjectDescription,
        self::LoanTarget,
        self::BankIssueDate,
        self::BankUODecisionDate,
        self::Industry,
        self::SubIndustry,
        self::LenderBank,
        self::LoanAmount,
        self::LoanGuarantee,
        self::LoanGuaranteePeriod,
        self::FoundationDecisionDate,
        self::SignGuaranteeAgreementDate,
        self::GuaranteeAgreementNumber,
        self::CurrentEmployeesCount,
        self::NewJobsPlacesCount,
        self::WomenEntrepreneurshipCompliance,
        self::CompanyHeadDateOfBirth,
        self::ProjectRegion,
        self::ProjectLocation,
        self::ProjectLocationInMonocity,
        self::DKBProgram,
        self::ProgramDirection,
        self::FundingSource,
        self::LoanPercent,
        self::GuaranteeKind,
        self::GuaranteeEndDate,
        self::GuaranteeExpired,
        self::ProjectStatus,
        self::GuaranteeExpireDate,
        self::BankPayOnDemandAmount,
        self::CompanyBinIin,
        self::RFManagerFullName,
        self::Year,
        self::Quarter,
        self::PortfolioGuarantee,
        self::PGCommissionRegistrationDate,
        self::Id,
        self::ReportId,
        self::Status,
        self::ProgramCityId,
        self::IsRegionProject,
        self::ProgramDistrictId,
        self::CompanyUserId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const ReportRatios = [
        self::RatioAmount,
        self::RatioCount,
        self::RatioContByRegion,
        self::RatioAmountByRegion,
        self::RatioAverageProjectAmount,
        self::RatioNewJpbPlaces,
        self::RatioSavedJpbPlaces,
        self::RatioProjectsTargetsCount,
        self::RatioLoanAmountByIndustry,
        self::RatioProjectsCountByIndustry,
        self::RatioProjectsCountByDirection,
        self::RatioProjectsAmountByDirection,
        self::RatioAverageAmountByRegion,
        self::RatioAmountByLenderBank,
        self::RatioAverageAmountByIndustry,
    ];

    public const ReportTableFields = [
        self::Number,
        self::Name,
        self::Industry,
        self::ProgramDirection,
        self::LenderBank,
        self::LoanAmount,
        self::LoanTarget,
        self::ProjectLocation,
        self::ProjectRegion,
        self::NewJobsPlacesCount,
        self::CurrentEmployeesCount,
        self::LastFailComment,
    ];


}
