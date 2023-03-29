<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportDKBSubsidies
{
    public const Id                                       = 'id';                                               // record id
    public const ReportId                                 = 'report_id';                                        // report header id
    public const Status                                   = 'status';                                           // Статус обработки записи
    public const Number                                   = 'number';                                           // № п/п
    public const STBName                                  = 'stb_name';                                         // Наименование БВУ
    public const EntrepreneurSName                        = 'entrepreneur_s_name';                              // Наименование предпринимателя
    public const CompanyBinIin                            = 'bin_iin';                                          // БИН/ИИН
    public const SubjectSize                              = 'subject_size';                                     // Размер субъекта
    public const District                                 = 'district';                                         // Район
    public const CreditAmount                             = 'credit_amount';                                    // Сумма кредита
    public const LoanRate                                 = 'loan_rate';                                        // Ставка по кредиту %
    public const Subsidies                                = 'subsidies';                                        // % субсидии
    public const TheAmountOfThePlannedSubsidyUntil        = 'the_amount_of_the_planned_subsidy_until';          // Сумма планирумой субсидии до 31.12.2020
    public const CurrentNumberOfWorkPlaces                = 'current_number_of_work_places';                    // Тек. колич-о раб.мест
    public const NumberOfCreatedWorkplaces                = 'number_of_created_workplaces';                     // Кол-во создаваемых раб.мест
    public const IndustryOfActivity                       = 'industry_of_activity';                             // Отрасль деятельности
    public const OKED                                     = 'oked';                                             // Вид деятельности (код ОКЭД)
    public const PurposeOfTheLoan                         = 'purpose_of_the_loan';                              // Целевое назначение кредита
    public const DirectionByProgram                       = 'direction_by_program';                             // Направление по Программе (1,2,3  / Механизм)
    public const TheEssenceOfTheQuestionIsNewProlongation = 'the_essence_of_the_question_is_new_prolongation';  // Суть вопроса новый/пролангация/
    public const dateOfRegistrationOfTheApplication       = 'date_of_registration_of_the_application';          // дата регистрации заявления
    public const ProtocolNumberOfTheFundMAPM              = 'protocol_number_of_the_fund_ma_pm';                // номер Протокола  УО Фонда/ КУП
    public const dateOfTheMinutesOfTheFundMAPM            = 'date_of_the_minutes_of_the_fund_ma_pm';            // дата Протокола УО Фонда / КУП
    public const ExpirationDateOfRKSFund                  = 'expiration_date_of_rks_fund';                      // Дата истечения срока РКС/Фонда
    public const DateOfSendingTheLetterToSTB              = 'date_of_sending_the_letter_to_stb';                // Дата направления письма в БВУ/
    public const YurCompanyAddress                        = 'yur_company_address';                              // Юр. адрес компании
    public const FullNameOfTheHead                        = 'full_name_of_the_head';                            // ФИО руководителя
    public const Contacts                                 = 'contacts';                                         // Контакты
    public const ProgramDistrictId                        = 'program_district_id';                              // Id района (таблица districts) определяется по полю District если оно === District то null
    public const CompanyUserId                            = 'company_user_id';                                  // Id пользователя компании - определяется по полю CompanyBinIin в таблице организаций
    public const CompanyId                                = 'company_id';                                       // Id компании - определяется по полю CompanyBinIin в таблице организаций
    public const LastEditorId                             = 'last_editor_id';                                   // Id последнего редактора записи
    public const IsEdited                                 = 'is_edited';                                        // Были ли внесены изменения пользователем
    public const CreatedAt                                = 'created_at';                                       // Дата создание
    public const UpdatedAt                                = 'updated_at';                                       // Дата изменения
    public const LastFailComment                          = 'last_fail_comment';                                // Список ошибок обработки записи
    public const Tax                                      = 'tax';                                              // Рост налоговых поступлений

    public const RatioSumOfProjects                            = 'sum_of_projects';                                  //Сумма проектов
    public const RatioNumberOfProjects                         = 'number_of_projects';                               //Кол-во проектов
    public const RatioNumberOfSubsidyProjectsByDistrict        = 'number_of_subsidy_projects_by_district';           //Кол-во проектов субсидирования по районам
    public const RatioTheAmountOfSubsidyProjectsByDistrict     = 'the_amount_of_subsidy_projects_by_district';       //Сумма проектов субсидирования по районам
    public const RatioAverageBillPerProject                    = 'average_bill_per_project';                         //Средний чек на проект
    public const RatioCreatedSlavePlaces                       = 'created_slave_places';                             //Созданные раб места
    public const RatioSavedSlavePlaces                         = 'saved_slave_places';                               //Сохраненные раб места
    public const RatioNumberOfProjectsByFundingPurpose         = 'number_of_projects_by_funding_purpose';            //Кол-во проектов по целям финансирования
    public const RatioNumberOfSubsidyProjectsByIndustry        = 'number_of_subsidy_projects_by_industry';           //Кол-во проектов субсидирования по отраслям
    public const RatioTheAmountOfSubsidyProjectsByIndustry     = 'the_amount_of_subsidy_projects_by_industry';       //Сумма проектов субсидирования по отраслям
    public const RatioNumberOfProjectsByDirectionsOfTheProgram = 'number_of_projects_by_directions_of_the_program';  //Кол-во проектов по Направлениям программы
    public const RatioVolumeOfProjectsByDirectionsOfTheProgram = 'volume_of_projects_by_directions_of_the_program';  //Объем проектов по Направлениям программы
    public const RatioAverageBillForAProjectByDistrict         = 'average_bill_for_a_project_by_district';           //Средний чек на проект по районам
    public const RatioNumberOfSubsidizingProjectsForSTBs       = 'number_of_subsidizing_projects_for_stbs';          //Кол-во проектов субсидирования по БВУ
    public const RatioAverageBillForAProjectByIndustry         = 'average_bill_for_a_project_by_industry';           //Средний чек на проект по отраслям

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

    public const FieldList = [
        self::Number,
        self::STBName,
        self::EntrepreneurSName,
        self::CompanyBinIin,
        self::SubjectSize,
        self::District,
        self::CreditAmount,
        self::LoanRate,
        self::Subsidies,
        self::TheAmountOfThePlannedSubsidyUntil,
        self::CurrentNumberOfWorkPlaces,
        self::NumberOfCreatedWorkplaces,
        self::IndustryOfActivity,
        self::OKED,
        self::PurposeOfTheLoan,
        self::DirectionByProgram,
        self::TheEssenceOfTheQuestionIsNewProlongation,
        self::dateOfRegistrationOfTheApplication,
        self::ProtocolNumberOfTheFundMAPM,
        self::dateOfTheMinutesOfTheFundMAPM,
        self::ExpirationDateOfRKSFund,
        self::DateOfSendingTheLetterToSTB,
        self::YurCompanyAddress,
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

    public const ReportFileFields = [
        self::Number,
        self::STBName,
        self::EntrepreneurSName,
        self::CompanyBinIin,
        self::SubjectSize,
        self::District,
        self::CreditAmount,
        self::LoanRate,
        self::Subsidies,
        self::TheAmountOfThePlannedSubsidyUntil,
        self::CurrentNumberOfWorkPlaces,
        self::NumberOfCreatedWorkplaces,
        self::IndustryOfActivity,
        self::OKED,
        self::PurposeOfTheLoan,
        self::DirectionByProgram,
        self::TheEssenceOfTheQuestionIsNewProlongation,
        self::dateOfRegistrationOfTheApplication,
        self::ProtocolNumberOfTheFundMAPM,
        self::dateOfTheMinutesOfTheFundMAPM,
        self::ExpirationDateOfRKSFund,
        self::DateOfSendingTheLetterToSTB,
        self::YurCompanyAddress,
        self::FullNameOfTheHead,
        self::Contacts,
    ];

    public const ReportRatios = [
        self::RatioSumOfProjects,
        self::RatioNumberOfProjects,
        self::RatioNumberOfSubsidyProjectsByDistrict,
        self::RatioTheAmountOfSubsidyProjectsByDistrict,
        self::RatioAverageBillPerProject,
        self::RatioCreatedSlavePlaces,
        self::RatioSavedSlavePlaces,
        self::RatioNumberOfProjectsByFundingPurpose,
        self::RatioNumberOfSubsidyProjectsByIndustry,
        self::RatioTheAmountOfSubsidyProjectsByIndustry,
        self::RatioNumberOfProjectsByDirectionsOfTheProgram,
        self::RatioVolumeOfProjectsByDirectionsOfTheProgram,
        self::RatioAverageBillForAProjectByDistrict,
        self::RatioNumberOfSubsidizingProjectsForSTBs,
        self::RatioAverageBillForAProjectByIndustry,
    ];

    public const ReportTableFields = [
        self::Number,
        self::STBName,
        self::PurposeOfTheLoan,
        self::IndustryOfActivity,
        self::CreditAmount,
        self::CurrentNumberOfWorkPlaces,
        self::NumberOfCreatedWorkplaces,
        self::District,
        self::DirectionByProgram,
        self::LastFailComment,
    ];

    public const ReportFileFieldsNames = [
        self::Number                                   => 'messages.reports.government.fields.Subsidies.Number',
        self::STBName                                  => 'messages.reports.government.fields.Subsidies.STBName',
        self::EntrepreneurSName                        => 'messages.reports.government.fields.Subsidies.EntrepreneurSName',
        self::CompanyBinIin                            => 'messages.reports.government.fields.Subsidies.CompanyBinIin',
        self::SubjectSize                              => 'messages.reports.government.fields.Subsidies.SubjectSize',
        self::District                                 => 'messages.reports.government.fields.Subsidies.District',
        self::CreditAmount                             => 'messages.reports.government.fields.Subsidies.CreditAmount',
        self::LoanRate                                 => 'messages.reports.government.fields.Subsidies.LoanRate',
        self::Subsidies                                => 'messages.reports.government.fields.Subsidies.Subsidies',
        self::TheAmountOfThePlannedSubsidyUntil        => 'messages.reports.government.fields.Subsidies.TheAmountOfThePlannedSubsidyUntil',
        self::CurrentNumberOfWorkPlaces                => 'messages.reports.government.fields.Subsidies.CurrentNumberOfWorkPlaces',
        self::NumberOfCreatedWorkplaces                => 'messages.reports.government.fields.Subsidies.NumberOfCreatedWorkplaces',
        self::IndustryOfActivity                       => 'messages.reports.government.fields.Subsidies.IndustryOfActivity',
        self::OKED                                     => 'messages.reports.government.fields.Subsidies.OKED',
        self::PurposeOfTheLoan                         => 'messages.reports.government.fields.Subsidies.PurposeOfTheLoan',
        self::DirectionByProgram                       => 'messages.reports.government.fields.Subsidies.DirectionByProgram',
        self::TheEssenceOfTheQuestionIsNewProlongation => 'messages.reports.government.fields.Subsidies.TheEssenceOfTheQuestionIsNewProlongation',
        self::dateOfRegistrationOfTheApplication       => 'messages.reports.government.fields.Subsidies.dateOfRegistrationOfTheApplication',
        self::ProtocolNumberOfTheFundMAPM              => 'messages.reports.government.fields.Subsidies.ProtocolNumberOfTheFundMAPM',
        self::dateOfTheMinutesOfTheFundMAPM            => 'messages.reports.government.fields.Subsidies.dateOfTheMinutesOfTheFundMAPM',
        self::ExpirationDateOfRKSFund                  => 'messages.reports.government.fields.Subsidies.ExpirationDateOfRKSFund',
        self::DateOfSendingTheLetterToSTB              => 'messages.reports.government.fields.Subsidies.DateOfSendingTheLetterToSTB',
        self::YurCompanyAddress                        => 'messages.reports.government.fields.Subsidies.YurCompanyAddress',
        self::FullNameOfTheHead                        => 'messages.reports.government.fields.Subsidies.FullNameOfTheHead',
        self::Contacts                                 => 'messages.reports.government.fields.Subsidies.Contacts',
        self::LastFailComment                          => 'messages.reports.government.fields.Subsidies.LastFailComment',
        self::Tax                          => 'messages.reports.government.fields.Subsidies.tax',
    ];
}
