<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportAlmatyBusinessZhibekZholy
{
    public const Id                         = 'id';                                 // record id
    public const ReportId                   = 'report_id';                          // report header id
    public const Status                     = 'status';                             // Статус обработки записи
    public const Number                     = 'number';                             // № п/п
    public const Program                    = 'program';                            // Программа
    public const NameOfTheBank              = 'name_of_the_bank';                   // Наименование Банка
    public const Region                     = 'region';                             // Область
    public const BorrowerName               = 'borrower_name';                      // Наименование Заемщика
    public const LegalStatus                = 'legal_status';                       // Юридический статус
    public const LoanIssueDate              = 'loan_issue_date';                    // Дата выдачи займа
    public const LoanTerm                   = 'loan_term';                          // Срок займа
    public const LoanAmount                 = 'loan_amount';                        // Сумма займа
    public const ApprovedLoanAmount         = 'approved_loan_amount';               // Сумма займа одобренная за счет средств Фонда
    public const FundsOwnAmount             = 'funds_own_amount';                   // Сумма займа собственных средств БВУ
    public const ActualAmount               = 'actual_amount';                      // Сумма фактической выдачи средств
    public const FundActualAmount           = 'fund_actual_amount';                 // Сумма фактической выдачи за счет средств Фонда
    public const BankActualAmount           = 'bank_actual_amount';                 // Сумма фактической выдачи за счет средств Банка
    public const PrincipalRepaymentPeriod   = 'principal_repayment_period';         // Льготный период по погашению основного долга
    public const RemunerationPaymentPeriod  = 'remuneration_payment_period';        // Льготный период по выплате вознаграждения
    public const LoanInterestRate           = 'loan_interest_rate';                 // Ставка вознаграждения по кредиту
    public const EffectiveLoanRate          = 'effective_loan_rate';                // Эффективная ставка вознаграждения по кредиту
    public const LoanObject                 = 'loan_object';                        // Объект кредитования
    public const PurposeOfBorrowedFunds     = 'purpose_of_borrowed_funds';          // Целевое назначение заемных средств
    public const PlaceOfImplementation      = 'place_of_implementation';            // Место реализации
    public const OKED                       = 'oked';                               // Отрасль экономики (сектор экономики) ОКЭД
    public const SubSectorOKED              = 'sub_sector_oked';                    // Подотрасль Экономики (5-значный  код) ОКЭД
    public const NewWorkplaces              = 'new_workplaces';                     // Новые рабочие места, создаваемые за счет реализации проекта
    public const AuthorizedBankDecisionNo   = 'authorized_bank_decision_no';        // № решения Уполномоченного органа Банка
    public const AuthorizedBankDecisionDate = 'authorized_bank_decision_date';      // Дата решения Уполномоченного органа Банка
    public const LoanAgreementNo            = 'loan_agreement_no';                  // № Договора банковского займа/ Соглашения о займе
    public const LoanAgreementDate          = 'loan_agreement_date';                // Дата Договора банковского займа/ Соглашения о займе
    public const CompanyBinIin              = 'iin_bin';                            // ИИН/БИН Заемщика/ Лизингополучателя
    public const BusinessProject            = 'business_project';                   // Бизнес по проекту (действующий/ стартовый)
    public const ProgramCityId              = 'program_city_id';                    // Id города (таблица cities) - определяется по полю Region (Регион)
    public const IsRegionProject            = 'is_region_project';                  // Если поле Регион === Место реализации проекта (Region === PlaceOfImplementation)
    public const CompanyUserId              = 'company_user_id';                    // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const CompanyId                  = 'company_id';                         // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const LastEditorId               = 'last_editor_id';                     // Id последнего редактора записи
    public const IsEdited                   = 'is_edited';                          // Были ли внесены изменения пользователем
    public const CreatedAt                  = 'created_at';                         // Дата создание
    public const UpdatedAt                  = 'updated_at';                         // Дата изменения
    public const LastFailComment            = 'last_fail_comment';                  // Список ошибок обработки записи
    public const CurrentWorkPlaces          = 'current_workplaces';                 // Текущее кол-во рабочих мест
    public const Tax                        = 'tax';                                // Рост налоговых поступлений

    public const SumOfProjects                = 'sum_of_projects';                      // Сумма проектов
    public const NumberOfProjects             = 'number_of_projects';                   // Кол-во проектов
    public const AverageBillPerProject        = 'average_bill_per_project';             // Средний чек на проект
    public const CreatedWorkPlaces            = 'created_work_places';                  // Созданные раб места
    public const NumberOfProjectsByPurpose    = 'number_of_projects_by_purpose';        // Кол-во проектов по целям финансирования
    public const NumberOfSubsidyByIndustry    = 'number_of_subsidy_by_industry';        // Кол-во проектов субсидирования по отраслям
    public const TheAmountOfSubsidyByIndustry = 'the_amount_of_subsidy_by_industry';    // Сумма проектов субсидирования по отраслям
    public const NumberOfSubsidizingForSTB    = 'number_of_subsidizing_for_stb';        // Кол-во проектов субсидирования по БВУ
    public const AverageBillByIndustry        = 'average_bill_by_industry';             // Средний чек на проект по отраслям
    public const ShareOf                      = 'share_of_startups';                    // Доля стартапов от общего кол-ва проектов


    public const SystemFieldList = [
        self::Id,
        self::ReportId,
        self::Status,
        self::ProgramCityId,
        self::IsRegionProject,
        self::CompanyId,
        self::CompanyUserId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const FixedRatios = [
        self::Tax,
        self::CurrentWorkPlaces,
    ];

    public const FieldList = [
        self::Number,
        self::Program,
        self::NameOfTheBank,
        self::Region,
        self::BorrowerName,
        self::LegalStatus,
        self::LoanIssueDate,
        self::LoanTerm,
        self::LoanAmount,
        self::ApprovedLoanAmount,
        self::FundsOwnAmount,
        self::ActualAmount,
        self::FundActualAmount,
        self::BankActualAmount,
        self::PrincipalRepaymentPeriod,
        self::RemunerationPaymentPeriod,
        self::LoanInterestRate,
        self::EffectiveLoanRate,
        self::LoanObject,
        self::PurposeOfBorrowedFunds,
        self::PlaceOfImplementation,
        self::OKED,
        self::SubSectorOKED,
        self::NewWorkplaces,
        self::AuthorizedBankDecisionNo,
        self::AuthorizedBankDecisionDate,
        self::LoanAgreementNo,
        self::LoanAgreementDate,
        self::CompanyBinIin,
        self::BusinessProject,
        self::Id,
        self::ReportId,
        self::Status,
        self::ProgramCityId,
        self::IsRegionProject,
        self::CompanyId,
        self::CompanyUserId,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const  ReportFileFields = [
        self::Number,
        self::Program,
        self::NameOfTheBank,
        self::Region,
        self::BorrowerName,
        self::LegalStatus,
        self::LoanIssueDate,
        self::LoanTerm,
        self::LoanAmount,
        self::ApprovedLoanAmount,
        self::FundsOwnAmount,
        self::ActualAmount,
        self::FundActualAmount,
        self::BankActualAmount,
        self::PrincipalRepaymentPeriod,
        self::RemunerationPaymentPeriod,
        self::LoanInterestRate,
        self::EffectiveLoanRate,
        self::LoanObject,
        self::PurposeOfBorrowedFunds,
        self::PlaceOfImplementation,
        self::OKED,
        self::SubSectorOKED,
        self::NewWorkplaces,
        self::AuthorizedBankDecisionNo,
        self::AuthorizedBankDecisionDate,
        self::LoanAgreementNo,
        self::LoanAgreementDate,
        self::CompanyBinIin,
        self::BusinessProject,
    ];

    public const ReportFileFieldsNames = [
        self::Number                     => 'messages.reports.government.fields.ZhibekZholy.Number',
        self::Program                    => 'messages.reports.government.fields.ZhibekZholy.Program',
        self::NameOfTheBank              => 'messages.reports.government.fields.ZhibekZholy.NameOfTheBank',
        self::Region                     => 'messages.reports.government.fields.ZhibekZholy.Region',
        self::LegalStatus                => 'messages.reports.government.fields.ZhibekZholy.LegalStatus',
        self::LoanIssueDate              => 'messages.reports.government.fields.ZhibekZholy.LoanIssueDate',
        self::LoanTerm                   => 'messages.reports.government.fields.ZhibekZholy.LoanTerm',
        self::LoanAmount                 => 'messages.reports.government.fields.ZhibekZholy.LoanAmount',
        self::ApprovedLoanAmount         => 'messages.reports.government.fields.ZhibekZholy.ApprovedLoanAmount',
        self::FundsOwnAmount             => 'messages.reports.government.fields.ZhibekZholy.FundsOwnAmount',
        self::ActualAmount               => 'messages.reports.government.fields.ZhibekZholy.ActualAmount',
        self::FundActualAmount           => 'messages.reports.government.fields.ZhibekZholy.FundActualAmount',
        self::BankActualAmount           => 'messages.reports.government.fields.ZhibekZholy.BankActualAmount',
        self::PrincipalRepaymentPeriod   => 'messages.reports.government.fields.ZhibekZholy.PrincipalRepaymentPeriod',
        self::RemunerationPaymentPeriod  => 'messages.reports.government.fields.ZhibekZholy.RemunerationPaymentPeriod',
        self::LoanInterestRate           => 'messages.reports.government.fields.ZhibekZholy.LoanInterestRate',
        self::EffectiveLoanRate          => 'messages.reports.government.fields.ZhibekZholy.EffectiveLoanRate',
        self::LoanObject                 => 'messages.reports.government.fields.ZhibekZholy.LoanObject',
        self::PurposeOfBorrowedFunds     => 'messages.reports.government.fields.ZhibekZholy.PurposeOfBorrowedFunds',
        self::PlaceOfImplementation      => 'messages.reports.government.fields.ZhibekZholy.PlaceOfImplementation',
        self::OKED                       => 'messages.reports.government.fields.ZhibekZholy.OKED',
        self::SubSectorOKED              => 'messages.reports.government.fields.ZhibekZholy.SubSectorOKED',
        self::NewWorkplaces              => 'messages.reports.government.fields.ZhibekZholy.NewWorkplaces',
        self::AuthorizedBankDecisionNo   => 'messages.reports.government.fields.ZhibekZholy.AuthorizedBankDecisionNo',
        self::AuthorizedBankDecisionDate => 'messages.reports.government.fields.ZhibekZholy.AuthorizedBankDecisionDate',
        self::LoanAgreementNo            => 'messages.reports.government.fields.ZhibekZholy.LoanAgreementNo',
        self::LoanAgreementDate          => 'messages.reports.government.fields.ZhibekZholy.LoanAgreementDate',
        self::CompanyBinIin              => 'messages.reports.government.fields.ZhibekZholy.CompanyBinIin',
        self::BusinessProject            => 'messages.reports.government.fields.ZhibekZholy.BusinessProject',
        self::LastFailComment            => 'messages.reports.government.fields.ZhibekZholy.LastFailComment',
        self::Tax            => 'messages.reports.government.fields.ZhibekZholy.tax',
        self::CurrentWorkPlaces            => 'messages.reports.government.fields.ZhibekZholy.CurrentWorkPlaces',
    ];

    public const ReportRatios = [
        self::SumOfProjects,
        self::NumberOfProjects,
        self::AverageBillPerProject,
        self::CreatedWorkPlaces,
        self::NumberOfProjectsByPurpose,
        self::NumberOfSubsidyByIndustry,
        self::TheAmountOfSubsidyByIndustry,
        self::NumberOfSubsidizingForSTB,
        self::AverageBillByIndustry,
        self::ShareOf,
    ];

    public const ReportTableFields = [
        self::Number,
        self::Program,
        self::NameOfTheBank,
        self::Region,
        self::ActualAmount,
        self::LoanObject,
        self::OKED,
        self::NewWorkplaces,
        self::CompanyBinIin,
        self::BusinessProject,
        self::LastFailComment,
    ];

}
