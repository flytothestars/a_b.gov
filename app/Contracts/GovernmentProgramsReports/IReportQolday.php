<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportQolday
{
    public const Id                    = 'id';                          // record id
    public const ReportId              = 'report_id';                   // report header id
    public const Status                = 'status';                      // Статус обработки записи
    public const NumberOfConsultations = 'number_of_consultations';     // Кол-во  консультаций
    public const DevelopedPlans        = 'developed_plans';             // Разработано бизнес-планов
    public const AccompaniedProjects   = 'accompanied_projects';        // Сопровождено бизнес-проектов
    public const SumOfProjects         = 'sum_of_projects';             // Сумма проектов
    public const PermitsReceived       = 'permits_received';            // Получено разрешительных документов
    public const NumberOfListeners     = 'number_of_listeners';         // Кол-во слушателей
    public const LastEditorId          = 'last_editor_id';              // Id последнего редактора записи
    public const IsEdited              = 'is_edited';                   // Были ли внесены изменения пользователем
    public const LastFailComment       = 'last_fail_comment';           // Список ошибок обработки записи
    public const CreatedAt             = 'created_at';                  // Дата создание
    public const UpdatedAt             = 'updated_at';                  // Дата изменения


    public const SystemFieldList = [
        self::Id,
        self::ReportId,
        self::Status,
        self::LastEditorId,
        self::IsEdited,
        self::CreatedAt,
        self::UpdatedAt,
    ];

    public const FixedRatios = [];

    public const ReportRatios = [
        self::ReportId,
        self::Status,
        self::NumberOfConsultations,
        self::DevelopedPlans,
        self::AccompaniedProjects,
        self::SumOfProjects,
        self::PermitsReceived,
        self::NumberOfListeners,
    ];

    public const ReportTableFields = [
        self::NumberOfConsultations,
        self::DevelopedPlans,
        self::AccompaniedProjects,
        self::SumOfProjects,
        self::PermitsReceived,
        self::NumberOfListeners,
        self::LastFailComment,
    ];

    public const ReportFileFieldsNames = [
        self::NumberOfConsultations => 'messages.reports.government.fields.Qolday.NumberOfConsultations',
        self::DevelopedPlans        => 'messages.reports.government.fields.Qolday.DevelopedPlans',
        self::AccompaniedProjects   => 'messages.reports.government.fields.Qolday.AccompaniedProjects',
        self::SumOfProjects         => 'messages.reports.government.fields.Qolday.SumOfProjects',
        self::PermitsReceived       => 'messages.reports.government.fields.Qolday.PermitsReceived',
        self::NumberOfListeners     => 'messages.reports.government.fields.Qolday.NumberOfListeners',
    ];

}
