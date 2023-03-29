<?php

namespace App\Contracts\AppealsReports;

interface IReportAppeals
{
    public const Id                              = 'id';                                 // record id

    public const AppealsCount                    = 'appeals_count';                         // Общее количество потребностей
    public const BusinessCount                     = 'Business_count';                          // Количество субъектов бизнеса
    public const AppealssByDistricts             = 'appeals_by_districts';               // Количество потребностей по районам Алматы
    public const BusinessByDistricts             = 'Business_by_districts';               // Количество субъектов бизнеса по районам Алматы
    public const AppealssByCategory             = 'Business_by_category';               // Количество потребностей по категориям
    public const BusinessByCategory            = 'Business_by_category';               // Количество субъектов бизнеса по категориям
    public const AppealssByDistrictsCategory             = 'appeals_by_districts_category';               // Общая статистика потребностей по районам категориям
    public const AppealssByCategoryIndustry             = 'appeals_by_category_indust';               // Общая статистика потребностей по категориям и отраслям

    public const    Appealsid   =  'id';
    public const     AppealsCategoryId  = 'category_id';
    public const     AppealsTypeId  = 'type_id';
    public const      AppealsContent = 'content';
    public const      AppealsCreateDate =  'createDate';
    public const      AppealsUpdateDate = 'updateDate';
    public const      AppealsUserId = 'user_id';
    public const       AppealsDistributorId = 'distributor_id';
    public const        AppealsAppealStatusId = 'appeal_status_id';
    public const     clientAppealStatusId  = 'client_appeal_status_id';
    public const     AppealsDistrictId  = 'district_id';
    public const     AppealsComment  = 'comment';
    public const     AppealsLastActionTypeId  = 'last_action_type_id';
    public const   AppealsLastExecutorId   =  'last_executor_id';
    public const   AppealsLastCoexecutorId  =   'last_coexecutor_id';
    public const   AppealsAppealResultTypeId   =  'appeal_result_type_id';
    public const    AppealsMioId  =  'mio_id';
    public const    AppealsBusinessId   = 'business_id';
    public const     AppealsSourceTypeId  = 'source_type_id';
    public const   AppealsFlowTypeId   =  'flow_type_id';
    public const    AppealsLastCuratorUpiId   = 'last_curator_upi_id';
    public const    AppealsLastCuratorDistrictId  =  'last_curator_district_id';
    public const    AppealsAppealNo  =  'appeal_no';
    public const    AppealsIndustryId  =  'industry_id';
    public const    AppealsExternalCategoryId  =  'external_category_id';

    public const BusinessId =        'id';
    public const BusinessOrganizationId =            'organization_id';
    public const BusinessName =            'name';
    public const BusinessDisplayName =            'display_name';
    public const BusinessAddressLine =            'address_line';
    public const BusinessAddressLineStat =            'address_line_stat';
    public const BusinessSource =            'source';
    public const BusinessEmployeeCount =            'employee_count';
    public const BusinessHasCashRegister =            'has_cash_register';
    public const BusinessCashRegisterCount =            'cash_register_count';
    public const BusinessHasPaymentTerminal =            'has_payment_terminal';
    public const BusinessNeedToContact =            'need_to_contact';
    public const BusinessRefusedToProvideIdentificationNumber =            'refused_to_provide_identification_number';
    public const BusinessIdentificationNumberNotFoundInStat =            'identification_number_not_found_in_stat';
    public const BusinessStatus =            'status';
    public const BusinessStatusChanged =            'status_changed';
    public const BusinessCreated =            'created';
    public const BusinessModified =            'modified';
    public const BusinessLocationLong =            'location_long';
    public const BusinessLocationLat =            'location_lat';
    public const BusinessMioId =            'mio_id';
    public const BusinessLastCallDate =            'last_call_date';
    public const BusinessDistributorId =            'distributor_id';
    public const BusinessDistrictId =            'district_id';
    public const BusinessRegionId =            'region_id';
    public const BusinessCityId =            'city_id';
    public const BusinessSourceTypeId =            'source_type_id';
    public const BusinessWorkingTypeId    =        'working_type_id';



    public const ReportRatios = [
        self::AppealsCount,
        self::BusinessCount,
        self::AppealssByDistricts,
        self::BusinessByDistricts,
        self::AppealssByCategory,
        self::BusinessByCategory,
        self::AppealssByDistrictsCategory,
        self::AppealssByCategoryIndustry,

    ];

    public const AppelasTableFields = [
        self::Appealsid,
        self::AppealsCategoryId,
        self::AppealsTypeId,
        self::AppealsContent,
        self::AppealsCreateDate,
        self::AppealsUpdateDate,
        self::AppealsUserId,
        self::AppealsDistributorId,
        self::AppealsAppealStatusId,
        self::clientAppealStatusId,
        self::AppealsDistrictId,
        self::AppealsComment,
        self::AppealsLastActionTypeId,
        self::AppealsLastExecutorId,
        self::AppealsLastCoexecutorId,
        self::AppealsAppealResultTypeId,
        self::AppealsMioId,
        self::AppealsBusinessId,
        self::AppealsSourceTypeId,
        self::AppealsFlowTypeId,
        self::AppealsLastCuratorUpiId,
        self::AppealsLastCuratorDistrictId,
        self::AppealsAppealNo,
        self::AppealsIndustryId,
        self::AppealsExternalCategoryId,
    ];

    public const BusinessTableFields = [
        self::BusinessId,
        self::BusinessOrganizationId,
        self::BusinessName,
        self::BusinessDisplayName,
        self::BusinessAddressLine,
        self::BusinessAddressLineStat,
        self::BusinessSource,
        self::BusinessEmployeeCount,
        self::BusinessHasCashRegister,
        self::BusinessCashRegisterCount,
        self::BusinessHasPaymentTerminal,
        self::BusinessNeedToContact,
        self::BusinessRefusedToProvideIdentificationNumber,
        self::BusinessIdentificationNumberNotFoundInStat,
        self::BusinessStatus,
        self::BusinessStatusChanged,
        self::BusinessCreated,
        self::BusinessModified,
        self::BusinessLocationLong,
        self::BusinessLocationLat,
        self::BusinessMioId,
        self::BusinessLastCallDate,
        self::BusinessDistributorId,
        self::BusinessDistrictId,
        self::BusinessRegionId,
        self::BusinessCityId,
        self::BusinessSourceTypeId,
        self::BusinessWorkingTypeId,
    ];
}
