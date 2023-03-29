<?php

namespace App\Repositories\Enums\Reports\Ser;

interface IBusinessStatisticsRatioEnum
{

    public const RegisteredEnterprisesNumber                               = 'c21e48e4-79c7-4f72-b278-a37821bdc8c4';    // 1 Количество зарегистрированных предприятий
    public const RegisteredEnterprisesGrowth                               = '7db9856e-a32f-4ca1-99a4-8b9e2c83374d';    // 2 Прирост зарегистрированных предприятий к предыдущему месяцу
    public const OperatingEnterprisesNumber                                = 'bc675092-d982-4d6d-8016-6002e3601c29';    // 3 Количество действующих предприятий
    public const OperatingEnterprisesGrowth                                = 'ca025533-e458-4035-98f5-c3b41d197a62';    // 4 Прирост действующих предприятий к предыдущему месяцу
    public const RegisteredEnterprisesNumberDistrict                       = 'a1262e82-06ac-4fea-aaa6-0cf144fea0cc';    // 5 Кол-во зарегистрированных предприятий по районам
    public const RegisteredEnterprisesNumberIndustry                       = '2c5a2a60-838b-446a-a95f-5a8206aeafa4';    // 6 Кол-во зарегистрированных предприятий по отраслям
    public const RegisteredEnterprisesNumberIndustryForestAndFishing       = '708b96f8-d5b1-4669-b781-fec72ffcc326';    // 6.1 Кол-во зарегистрированных предприятий по отрасли "Сельское, лесное и рыбное хозяйство"
    public const RegisteredEnterprisesNumberIndustryMining                 = '3be29623-feab-473e-b82b-b9825d7a361f';    // 6.2 Кол-во зарегистрированных предприятий по отрасли "Горнодобывающая промышленность и разработка карьеров"
    public const RegisteredEnterprisesNumberIndustryManufacture            = '11375ae1-560b-4757-9f67-019b9aed983d';    // 6.3 Кол-во зарегистрированных предприятий по отрасли "Обрабатывающая промышленность"
    public const RegisteredEnterprisesNumberIndustrySupply                 = '696c5066-f921-4fae-a3b4-02328126322a';    // 6.4 Кол-во зарегистрированных предприятий по отрасли "Снабжение электроэнергией, газом, паром, горячей водой и кондиционированным воздухом"
    public const RegisteredEnterprisesNumberIndustryWaste                  = '1172b2f2-ea47-40c6-a76b-ddb1be38368a';    // 6.5 Кол-во зарегистрированных предприятий по отрасли "Водоснабжение; сбор, обработка и удаление отходов, деятельность по ликвидации загрязнений"
    public const RegisteredEnterprisesNumberIndustryBuild                  = '296502d9-b3b7-4592-93f6-335ab2e3c658';    // 6.6 Кол-во зарегистрированных предприятий по отрасли "Строительство"
    public const RegisteredEnterprisesNumberIndustryTradeAndRepair         = '7498a1d7-d805-4771-94b8-d9233fa12eeb';    // 6.7 Кол-во зарегистрированных предприятий по отрасли "Оптовая и розничная торговля; ремонт автомобилей и мотоциклов"
    public const RegisteredEnterprisesNumberIndustryLogistic               = '366f197d-970a-400e-af8c-efc21da5ae18';    // 6.8 Кол-во зарегистрированных предприятий по отрасли "Транспорт и складирование"
    public const RegisteredEnterprisesNumberIndustryAccommodationAndFood   = 'd26996e6-8d9b-42fa-bc46-7b029f329079';    // 6.9 Кол-во зарегистрированных предприятий по отрасли "Предоставление услуг по проживанию и питанию"
    public const RegisteredEnterprisesNumberIndustryInformAndCommunication = 'ea159440-dfea-4194-aff7-4bef65c1895d';    // 6.10 Кол-во зарегистрированных предприятий по отрасли "Информация и связь"
    public const RegisteredEnterprisesNumberIndustryFinanceAndInsurance    = '195d1135-2d90-4dbb-bf02-7c72c0fdd0db';    // 6.11 Кол-во зарегистрированных предприятий по отрасли "Финансовая и страховая деятельность"
    public const RegisteredEnterprisesNumberIndustryRealEstate             = 'd313e1c0-d420-4124-bed9-dc39a2eb6f8d';    // 6.12 Кол-во зарегистрированных предприятий по отрасли "Операции с недвижимым имуществом"
    public const RegisteredEnterprisesNumberIndustryScience                = 'd2978223-8302-4a9c-a4eb-18bd89c959de';    // 6.13 Кол-во зарегистрированных предприятий по отрасли "Профессиональная, научная и техническая деятельность"
    public const RegisteredEnterprisesNumberIndustryAdministrateAndSupport = '83886073-e0e7-4f79-b7bf-62a80222b34f';    // 6.14 Кол-во зарегистрированных предприятий по отрасли "Деятельность в области административного и вспомогательного обслуживания"
    public const RegisteredEnterprisesNumberIndustryGovernmentAndDefence   = '9ff90102-baf3-4c45-a129-ff2187d64c1f';    // 6.15 Кол-во зарегистрированных предприятий по отрасли "Государственное управление и оборона; обязательное  социальное обеспечение"
    public const RegisteredEnterprisesNumberIndustryEducation              = '58190fe4-9dc5-4927-b999-8ab2f2bc583a';    // 6.16 Кол-во зарегистрированных предприятий по отрасли "Образование"
    public const RegisteredEnterprisesNumberIndustryHealthCare             = 'b6a8adc0-f855-4163-aaa4-b4721e667bc2';    // 6.17 Кол-во зарегистрированных предприятий по отрасли "Здравоохранение и социальное обслуживание населения"
    public const RegisteredEnterprisesNumberIndustryArtsAndEntertainment   = 'b3c6a643-de08-46c3-ba40-42cdfd7480ee';    // 6.18 Кол-во зарегистрированных предприятий по отрасли "Искусство, развлечения и отдых"
    public const RegisteredEnterprisesNumberIndustryOther                  = '7816f0f1-3cfd-412c-b927-8202bf0502d3';    // 6.19 Кол-во зарегистрированных предприятий по отрасли "Предоставление прочих видов услуг"
    public const RegisteredEnterprisesNumberIndustryHouseHold              = '8932ce88-1f4c-43c6-9e05-3e87b7aaa38a';    // 6.20 Кол-во зарегистрированных предприятий по отрасли "Деятельность домашних хозяйств, нанимающих домашнюю прислугу; деятельность домашних хозяйств по производству товаров и услуг для собственного потребления"
    public const RegisteredEnterprisesNumberIndustryExtraterritorial       = '958568b5-5973-4876-a4fb-89c9cc4f058d';    // 6.21 Кол-во зарегистрированных предприятий по отрасли "Деятельность экстерриториальных организаций и органов"
    public const RegisteredEnterprisesGrowthYears                          = '853220a6-b4b1-4392-b3f1-45a83919e036';    // 7 Динамика количества зарегистрированных предприятий за 3 года
    public const RegisteredEnterprisesNumberBySize                         = 'b4de5ece-1039-4714-9668-57aefa104a30';    // 8 Кол-во зарегистрированных предприятий по размерности
    public const RegisteredEnterprisesNumberBySizeSmall                    = '0e978ec8-81ea-43fd-8821-b0a6ee1a62ad';    // 8.1 Кол-во зарегистрированных предприятий по размерности Малые
    public const RegisteredEnterprisesNumberBySizeMedium                   = '05a80887-e34a-4044-a8ed-61eb6d6ecdeb';    // 8.2 Кол-во зарегистрированных предприятий по размерности Средние
    public const RegisteredEnterprisesNumberBySizeLarge                    = '4d1c0318-739a-4c81-8a1b-19bdc66da72b';    // 8.3 Кол-во зарегистрированных предприятий по размерности Крупные
    public const OperatingEnterprisesNumberDistrict                        = '16c62eab-3348-4cf2-b5d4-767d2c3b2205';    // 9 Кол-во действующих предприятий по районам
    public const OperatingEnterprisesNumberIndustry                        = '5e52c947-61a8-4767-ae00-e7b7b25ddf53';    // 10 Кол-во действующих предприятий по отраслям
    public const OperatingEnterprisesNumberIndustryForestAndFishing        = '74cfa3ed-868b-4195-b3a3-be61c00fb9d0';    // 10.1 Кол-во действующих предприятий по отрасли "Сельское, лесное и рыбное хозяйство"
    public const OperatingEnterprisesNumberIndustryMining                  = 'c2f43428-d41d-4ac8-977e-388b606fe0b9';    // 10.2 Кол-во действующих предприятий по отрасли "Горнодобывающая промышленность и разработка карьеров"
    public const OperatingEnterprisesNumberIndustryManufacture             = 'cf704ed3-27ef-4f82-92d1-1ff64e0f810a';    // 10.3 Кол-во действующих предприятий по отрасли "Обрабатывающая промышленность"
    public const OperatingEnterprisesNumberIndustrySupply                  = '68db4de0-4258-473f-b863-9eb9f1a13928';    // 10.4 Кол-во действующих предприятий по отрасли "Снабжение электроэнергией, газом, паром, горячей водой и кондиционированным воздухом"
    public const OperatingEnterprisesNumberIndustryWaste                   = '94b812ed-00c2-4b5c-8206-dc2f8953f460';    // 10.5 Кол-во действующих предприятий по отрасли "Водоснабжение; сбор, обработка и удаление отходов, деятельность по ликвидации загрязнений"
    public const OperatingEnterprisesNumberIndustryBuild                   = 'f24c5a0e-509d-49b1-9f0d-b69897331702';    // 10.6 Кол-во действующих предприятий по отрасли "Строительство"
    public const OperatingEnterprisesNumberIndustryTradeAndRepair          = '1082c2c0-2d08-4a2b-9fb2-5137a959b518';    // 10.7 Кол-во действующих предприятий по отрасли "Оптовая и розничная торговля; ремонт автомобилей и мотоциклов"
    public const OperatingEnterprisesNumberIndustryLogistic                = 'ca5ff8d9-14b0-4102-8d60-11c5de6b4eb4';    // 10.8 Кол-во действующих предприятий по отрасли "Транспорт и складирование"
    public const OperatingEnterprisesNumberIndustryAccommodationAndFood    = 'df8ecf3f-c289-43b3-ad02-390016b21198';    // 10.9 Кол-во действующих предприятий по отрасли "Предоставление услуг по проживанию и питанию"
    public const OperatingEnterprisesNumberIndustryInformAndCommunication  = 'b5ca482c-ab60-4d4e-81dd-a767325d9866';    // 10.10 Кол-во действующих предприятий по отрасли "Информация и связь"
    public const OperatingEnterprisesNumberIndustryFinanceAndInsurance     = '508c7481-d682-4d9d-a247-07608102bbf7';    // 10.11 Кол-во действующих предприятий по отрасли "Финансовая и страховая деятельность"
    public const OperatingEnterprisesNumberIndustryRealEstate              = 'b30c55a7-0893-4cc8-bfcb-e215fb61d70b';    // 10.12 Кол-во действующих предприятий по отрасли "Операции с недвижимым имуществом"
    public const OperatingEnterprisesNumberIndustryScience                 = '1d8a1ff3-b330-4361-9fbd-a82d5b7eb772';    // 10.13 Кол-во действующих предприятий по отрасли "Профессиональная, научная и техническая деятельность"
    public const OperatingEnterprisesNumberIndustryAdministrateAndSupport  = '90313c03-c81d-46aa-9ac1-3988297c4e21';    // 10.14 Кол-во действующих предприятий по отрасли "Деятельность в области административного и вспомогательного обслуживания"
    public const OperatingEnterprisesNumberIndustryGovernmentAndDefence    = 'f8caafde-3354-4d37-a15f-17b374a75564';    // 10.15 Кол-во действующих предприятий по отрасли "Государственное управление и оборона; обязательное  социальное обеспечение"
    public const OperatingEnterprisesNumberIndustryEducation               = '2203f9b6-54dc-477d-a1f9-8850fe7c1f51';    // 10.16 Кол-во действующих предприятий по отрасли "Образование"
    public const OperatingEnterprisesNumberIndustryHealthCare              = '54f30358-4934-4e47-973a-3e1b40873063';    // 10.17 Кол-во действующих предприятий по отрасли "Здравоохранение и социальное обслуживание населения"
    public const OperatingEnterprisesNumberIndustryArtsAndEntertainment    = '4be8a9f7-ec3d-4461-92cc-746d17c5eeeb';    // 10.18 Кол-во действующих предприятий по отрасли "Искусство, развлечения и отдых"
    public const OperatingEnterprisesNumberIndustryOther                   = '29aa6798-4d5e-4f1a-844d-439f55ed9c89';    // 10.19 Кол-во действующих предприятий по отрасли "Предоставление прочих видов услуг"
    public const OperatingEnterprisesNumberIndustryHouseHold               = '2e3e6457-c161-4701-af57-ceaf3a8daf93';    // 10.20 Кол-во действующих предприятий по отрасли "Деятельность домашних хозяйств, нанимающих домашнюю прислугу; деятельность домашних хозяйств по производству товаров и услуг для собственного потребления"
    public const OperatingEnterprisesNumberIndustryExtraterritorial        = '6fb68e0a-7691-48fd-a774-f663de167e88';    // 10.21 Кол-во действующих предприятий по отрасли "Деятельность экстерриториальных организаций и органов"
    public const OperatingEnterprisesGrowthYears                           = '486158ff-a2c3-4582-acd3-74d505ac21ad';    // 11 Динамика количества действующих предприятий  за 3 года
    public const OperatingEnterprisesNumberBySize                          = '3cd1573c-1bfd-458a-8d8b-61aecefc42ab';    // 12 Кол-во действующих предприятий по размерности
    public const OperatingEnterprisesNumberBySizeSmall                     = 'cade86c0-ea41-42f6-8882-14cfa68c4bc1';    // 12 Кол-во действующих предприятий по размерности Малые
    public const OperatingEnterprisesNumberBySizeMedium                    = '1c2ad741-7aea-40be-b1cd-a97237e83074';    // 12 Кол-во действующих предприятий по размерности Средние
    public const OperatingEnterprisesNumberBySizeLarge                     = '2cfb42fd-c19c-49d3-96bc-f38602c301ab';    // 12 Кол-во действующих предприятий по размерности Крупные


    public const IndustryForestAndFishingId       = '447173';
    public const IndustryMiningId                 = '447279';
    public const IndustryManufactureId            = '447346';
    public const IndustrySupplyId                 = '448090';
    public const IndustryWasteId                  = '448117';
    public const IndustryBuildId                  = '448148';
    public const IndustryTradeAndRepairId         = '448215';
    public const IndustryLogisticId               = '448475';
    public const IndustryAccommodationAndFoodId   = '448558';
    public const IndustryInformAndCommunicationId = '448585';
    public const IndustryFinanceAndInsuranceId    = '448658';
    public const IndustryRealEstateId             = '448714';
    public const IndustryScienceId                = '448728';
    public const IndustryAdministrateAndSupportId = '448797';
    public const IndustryGovernmentAndDefenceId   = '448889';
    public const IndustryEducationId              = '448918';
    public const IndustryHealthCareId             = '448950';
    public const IndustryArtsAndEntertainmentId   = '448991';
    public const IndustryOtherId                  = '449040';
    public const IndustryHouseHoldId              = '449097';
    public const IndustryExtraterritorialId       = '449109';

    public const MonthRatiosList = [];
    public const QuarterRatiosList = [];

    public const ExcludedRatios = [
        self::OperatingEnterprisesNumberDistrict,
        self::RegisteredEnterprisesNumberDistrict,
    ];

    public const CountRatios = [
        self::RegisteredEnterprisesNumber,
        self::OperatingEnterprisesNumber,
        self::RegisteredEnterprisesNumberIndustryForestAndFishing,
        self::RegisteredEnterprisesNumberIndustryMining,
        self::RegisteredEnterprisesNumberIndustryManufacture,
        self::RegisteredEnterprisesNumberIndustrySupply,
        self::RegisteredEnterprisesNumberIndustryWaste,
        self::RegisteredEnterprisesNumberIndustryBuild,
        self::RegisteredEnterprisesNumberIndustryTradeAndRepair,
        self::RegisteredEnterprisesNumberIndustryLogistic,
        self::RegisteredEnterprisesNumberIndustryAccommodationAndFood,
        self::RegisteredEnterprisesNumberIndustryInformAndCommunication,
        self::RegisteredEnterprisesNumberIndustryFinanceAndInsurance,
        self::RegisteredEnterprisesNumberIndustryRealEstate,
        self::RegisteredEnterprisesNumberIndustryScience,
        self::RegisteredEnterprisesNumberIndustryAdministrateAndSupport,
        self::RegisteredEnterprisesNumberIndustryGovernmentAndDefence,
        self::RegisteredEnterprisesNumberIndustryEducation,
        self::RegisteredEnterprisesNumberIndustryHealthCare,
        self::RegisteredEnterprisesNumberIndustryArtsAndEntertainment,
        self::RegisteredEnterprisesNumberIndustryOther,
        self::RegisteredEnterprisesNumberIndustryHouseHold,
        self::RegisteredEnterprisesNumberIndustryExtraterritorial,
        self::RegisteredEnterprisesNumberBySizeSmall,
        self::RegisteredEnterprisesNumberBySizeMedium,
        self::RegisteredEnterprisesNumberBySizeLarge,
        self::OperatingEnterprisesNumberIndustryForestAndFishing,
        self::OperatingEnterprisesNumberIndustryMining,
        self::OperatingEnterprisesNumberIndustryManufacture,
        self::OperatingEnterprisesNumberIndustrySupply,
        self::OperatingEnterprisesNumberIndustryWaste,
        self::OperatingEnterprisesNumberIndustryBuild,
        self::OperatingEnterprisesNumberIndustryTradeAndRepair,
        self::OperatingEnterprisesNumberIndustryLogistic,
        self::OperatingEnterprisesNumberIndustryAccommodationAndFood,
        self::OperatingEnterprisesNumberIndustryInformAndCommunication,
        self::OperatingEnterprisesNumberIndustryFinanceAndInsurance,
        self::OperatingEnterprisesNumberIndustryRealEstate,
        self::OperatingEnterprisesNumberIndustryScience,
        self::OperatingEnterprisesNumberIndustryAdministrateAndSupport,
        self::OperatingEnterprisesNumberIndustryGovernmentAndDefence,
        self::OperatingEnterprisesNumberIndustryEducation,
        self::OperatingEnterprisesNumberIndustryHealthCare,
        self::OperatingEnterprisesNumberIndustryArtsAndEntertainment,
        self::OperatingEnterprisesNumberIndustryOther,
        self::OperatingEnterprisesNumberIndustryHouseHold,
        self::OperatingEnterprisesNumberIndustryExtraterritorial,
        self::OperatingEnterprisesNumberBySizeSmall,
        self::OperatingEnterprisesNumberBySizeMedium,
        self::OperatingEnterprisesNumberBySizeLarge,
    ];


    public const CITY_RATIOS_LIST = [
        self::RegisteredEnterprisesNumber,
        self::OperatingEnterprisesNumber,
        self::RegisteredEnterprisesNumberIndustryForestAndFishing,
        self::RegisteredEnterprisesNumberIndustryMining,
        self::RegisteredEnterprisesNumberIndustryManufacture,
        self::RegisteredEnterprisesNumberIndustrySupply,
        self::RegisteredEnterprisesNumberIndustryWaste,
        self::RegisteredEnterprisesNumberIndustryBuild,
        self::RegisteredEnterprisesNumberIndustryTradeAndRepair,
        self::RegisteredEnterprisesNumberIndustryLogistic,
        self::RegisteredEnterprisesNumberIndustryAccommodationAndFood,
        self::RegisteredEnterprisesNumberIndustryInformAndCommunication,
        self::RegisteredEnterprisesNumberIndustryFinanceAndInsurance,
        self::RegisteredEnterprisesNumberIndustryRealEstate,
        self::RegisteredEnterprisesNumberIndustryScience,
        self::RegisteredEnterprisesNumberIndustryAdministrateAndSupport,
        self::RegisteredEnterprisesNumberIndustryGovernmentAndDefence,
        self::RegisteredEnterprisesNumberIndustryEducation,
        self::RegisteredEnterprisesNumberIndustryHealthCare,
        self::RegisteredEnterprisesNumberIndustryArtsAndEntertainment,
        self::RegisteredEnterprisesNumberIndustryOther,
        self::RegisteredEnterprisesNumberIndustryHouseHold,
        self::RegisteredEnterprisesNumberIndustryExtraterritorial,
        self::RegisteredEnterprisesNumberBySizeSmall,
        self::RegisteredEnterprisesNumberBySizeMedium,
        self::RegisteredEnterprisesNumberBySizeLarge,
        self::OperatingEnterprisesNumberIndustryForestAndFishing,
        self::OperatingEnterprisesNumberIndustryMining,
        self::OperatingEnterprisesNumberIndustryManufacture,
        self::OperatingEnterprisesNumberIndustrySupply,
        self::OperatingEnterprisesNumberIndustryWaste,
        self::OperatingEnterprisesNumberIndustryBuild,
        self::OperatingEnterprisesNumberIndustryTradeAndRepair,
        self::OperatingEnterprisesNumberIndustryLogistic,
        self::OperatingEnterprisesNumberIndustryAccommodationAndFood,
        self::OperatingEnterprisesNumberIndustryInformAndCommunication,
        self::OperatingEnterprisesNumberIndustryFinanceAndInsurance,
        self::OperatingEnterprisesNumberIndustryRealEstate,
        self::OperatingEnterprisesNumberIndustryScience,
        self::OperatingEnterprisesNumberIndustryAdministrateAndSupport,
        self::OperatingEnterprisesNumberIndustryGovernmentAndDefence,
        self::OperatingEnterprisesNumberIndustryEducation,
        self::OperatingEnterprisesNumberIndustryHealthCare,
        self::OperatingEnterprisesNumberIndustryArtsAndEntertainment,
        self::OperatingEnterprisesNumberIndustryOther,
        self::OperatingEnterprisesNumberIndustryHouseHold,
        self::OperatingEnterprisesNumberIndustryExtraterritorial,
        self::OperatingEnterprisesNumberBySizeSmall,
        self::OperatingEnterprisesNumberBySizeMedium,
        self::OperatingEnterprisesNumberBySizeLarge,
    ];

    public const DISTRICT_RATIOS_LIST = [
        self::RegisteredEnterprisesNumberDistrict,
        self::OperatingEnterprisesNumberDistrict,
    ];

    public const VirtualRatioList = [
        self::RegisteredEnterprisesGrowth,
        self::OperatingEnterprisesGrowth,
        self::RegisteredEnterprisesGrowthYears,
        self::OperatingEnterprisesGrowthYears,
        self::RegisteredEnterprisesNumberIndustry,
        self::OperatingEnterprisesNumberIndustry,
        self::RegisteredEnterprisesNumberBySize,
        self::OperatingEnterprisesNumberBySize,
    ];

    public const CalculatedRatioList = [
        self::RegisteredEnterprisesGrowth,
        self::OperatingEnterprisesGrowth,
        self::RegisteredEnterprisesGrowthYears,
        self::OperatingEnterprisesGrowthYears,
    ];

    public const RatioNames = [
        self::RegisteredEnterprisesNumber                               => 'report.BusinessStat.RegisteredEnterprisesNumber',
        self::RegisteredEnterprisesGrowth                               => 'report.BusinessStat.RegisteredEnterprisesGrowth',
        self::OperatingEnterprisesNumber                                => 'report.BusinessStat.OperatingEnterprisesNumber',
        self::OperatingEnterprisesGrowth                                => 'report.BusinessStat.OperatingEnterprisesGrowth',
        self::RegisteredEnterprisesNumberDistrict                       => 'report.BusinessStat.RegisteredEnterprisesNumberDistrict',
        self::RegisteredEnterprisesNumberIndustry                       => 'report.BusinessStat.RegisteredEnterprisesNumberIndustry',
        self::RegisteredEnterprisesNumberIndustryForestAndFishing       => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryForestAndFishing',
        self::RegisteredEnterprisesNumberIndustryMining                 => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryMining',
        self::RegisteredEnterprisesNumberIndustryManufacture            => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryManufacture',
        self::RegisteredEnterprisesNumberIndustrySupply                 => 'report.BusinessStat.RegisteredEnterprisesNumberIndustrySupply',
        self::RegisteredEnterprisesNumberIndustryWaste                  => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryWaste',
        self::RegisteredEnterprisesNumberIndustryBuild                  => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryBuild',
        self::RegisteredEnterprisesNumberIndustryTradeAndRepair         => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryTradeAndRepair',
        self::RegisteredEnterprisesNumberIndustryLogistic               => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryLogistic',
        self::RegisteredEnterprisesNumberIndustryAccommodationAndFood   => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryAccommodationAndFood',
        self::RegisteredEnterprisesNumberIndustryInformAndCommunication => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryInformAndCommunication',
        self::RegisteredEnterprisesNumberIndustryFinanceAndInsurance    => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryFinanceAndInsurance',
        self::RegisteredEnterprisesNumberIndustryRealEstate             => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryRealEstate',
        self::RegisteredEnterprisesNumberIndustryScience                => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryScience',
        self::RegisteredEnterprisesNumberIndustryAdministrateAndSupport => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryAdministrateAndSupport',
        self::RegisteredEnterprisesNumberIndustryGovernmentAndDefence   => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryGovernmentAndDefence',
        self::RegisteredEnterprisesNumberIndustryEducation              => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryEducation',
        self::RegisteredEnterprisesNumberIndustryHealthCare             => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryHealthCare',
        self::RegisteredEnterprisesNumberIndustryArtsAndEntertainment   => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryArtsAndEntertainment',
        self::RegisteredEnterprisesNumberIndustryOther                  => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryOther',
        self::RegisteredEnterprisesNumberIndustryHouseHold              => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryHouseHold',
        self::RegisteredEnterprisesNumberIndustryExtraterritorial       => 'report.BusinessStat.RegisteredEnterprisesNumberIndustryExtraterritorial',
        self::RegisteredEnterprisesGrowthYears                          => 'report.BusinessStat.RegisteredEnterprisesGrowthYears',
        self::RegisteredEnterprisesNumberBySize                         => 'report.BusinessStat.RegisteredEnterprisesNumberBySize',
        self::RegisteredEnterprisesNumberBySizeSmall                    => 'report.BusinessStat.RegisteredEnterprisesNumberBySizeSmall',
        self::RegisteredEnterprisesNumberBySizeMedium                   => 'report.BusinessStat.RegisteredEnterprisesNumberBySizeMedium',
        self::RegisteredEnterprisesNumberBySizeLarge                    => 'report.BusinessStat.RegisteredEnterprisesNumberBySizeLarge',
        self::OperatingEnterprisesNumberDistrict                        => 'report.BusinessStat.OperatingEnterprisesNumberDistrict',
        self::OperatingEnterprisesNumberIndustry                        => 'report.BusinessStat.OperatingEnterprisesNumberIndustry',
        self::OperatingEnterprisesNumberIndustryForestAndFishing        => 'report.BusinessStat.OperatingEnterprisesNumberIndustryForestAndFishing',
        self::OperatingEnterprisesNumberIndustryMining                  => 'report.BusinessStat.OperatingEnterprisesNumberIndustryMining',
        self::OperatingEnterprisesNumberIndustryManufacture             => 'report.BusinessStat.OperatingEnterprisesNumberIndustryManufacture',
        self::OperatingEnterprisesNumberIndustrySupply                  => 'report.BusinessStat.OperatingEnterprisesNumberIndustrySupply',
        self::OperatingEnterprisesNumberIndustryWaste                   => 'report.BusinessStat.OperatingEnterprisesNumberIndustryWaste',
        self::OperatingEnterprisesNumberIndustryBuild                   => 'report.BusinessStat.OperatingEnterprisesNumberIndustryBuild',
        self::OperatingEnterprisesNumberIndustryTradeAndRepair          => 'report.BusinessStat.OperatingEnterprisesNumberIndustryTradeAndRepair',
        self::OperatingEnterprisesNumberIndustryLogistic                => 'report.BusinessStat.OperatingEnterprisesNumberIndustryLogistic',
        self::OperatingEnterprisesNumberIndustryAccommodationAndFood    => 'report.BusinessStat.OperatingEnterprisesNumberIndustryAccommodationAndFood',
        self::OperatingEnterprisesNumberIndustryInformAndCommunication  => 'report.BusinessStat.OperatingEnterprisesNumberIndustryInformAndCommunication',
        self::OperatingEnterprisesNumberIndustryFinanceAndInsurance     => 'report.BusinessStat.OperatingEnterprisesNumberIndustryFinanceAndInsurance',
        self::OperatingEnterprisesNumberIndustryRealEstate              => 'report.BusinessStat.OperatingEnterprisesNumberIndustryRealEstate',
        self::OperatingEnterprisesNumberIndustryScience                 => 'report.BusinessStat.OperatingEnterprisesNumberIndustryScience',
        self::OperatingEnterprisesNumberIndustryAdministrateAndSupport  => 'report.BusinessStat.OperatingEnterprisesNumberIndustryAdministrateAndSupport',
        self::OperatingEnterprisesNumberIndustryGovernmentAndDefence    => 'report.BusinessStat.OperatingEnterprisesNumberIndustryGovernmentAndDefence',
        self::OperatingEnterprisesNumberIndustryEducation               => 'report.BusinessStat.OperatingEnterprisesNumberIndustryEducation',
        self::OperatingEnterprisesNumberIndustryHealthCare              => 'report.BusinessStat.OperatingEnterprisesNumberIndustryHealthCare',
        self::OperatingEnterprisesNumberIndustryArtsAndEntertainment    => 'report.BusinessStat.OperatingEnterprisesNumberIndustryArtsAndEntertainment',
        self::OperatingEnterprisesNumberIndustryOther                   => 'report.BusinessStat.OperatingEnterprisesNumberIndustryOther',
        self::OperatingEnterprisesNumberIndustryHouseHold               => 'report.BusinessStat.OperatingEnterprisesNumberIndustryHouseHold',
        self::OperatingEnterprisesNumberIndustryExtraterritorial        => 'report.BusinessStat.OperatingEnterprisesNumberIndustryExtraterritorial',
        self::OperatingEnterprisesGrowthYears                           => 'report.BusinessStat.OperatingEnterprisesGrowthYears',
        self::OperatingEnterprisesNumberBySize                          => 'report.BusinessStat.OperatingEnterprisesNumberBySize',
        self::OperatingEnterprisesNumberBySizeSmall                     => 'report.BusinessStat.OperatingEnterprisesNumberBySizeSmall',
        self::OperatingEnterprisesNumberBySizeMedium                    => 'report.BusinessStat.OperatingEnterprisesNumberBySizeMedium',
        self::OperatingEnterprisesNumberBySizeLarge                     => 'report.BusinessStat.OperatingEnterprisesNumberBySizeLarge',
    ];

    public const IndustryNames = [
        self::RegisteredEnterprisesNumberIndustryForestAndFishing       => 'report.BusinessStat.industry.ForestAndFishing',
        self::RegisteredEnterprisesNumberIndustryMining                 => 'report.BusinessStat.industry.Mining',
        self::RegisteredEnterprisesNumberIndustryManufacture            => 'report.BusinessStat.industry.Manufacture',
        self::RegisteredEnterprisesNumberIndustrySupply                 => 'report.BusinessStat.industry.Supply',
        self::RegisteredEnterprisesNumberIndustryWaste                  => 'report.BusinessStat.industry.Waste',
        self::RegisteredEnterprisesNumberIndustryBuild                  => 'report.BusinessStat.industry.Build',
        self::RegisteredEnterprisesNumberIndustryTradeAndRepair         => 'report.BusinessStat.industry.TradeAndRepair',
        self::RegisteredEnterprisesNumberIndustryLogistic               => 'report.BusinessStat.industry.Logistic',
        self::RegisteredEnterprisesNumberIndustryAccommodationAndFood   => 'report.BusinessStat.industry.AccommodationAndFood',
        self::RegisteredEnterprisesNumberIndustryInformAndCommunication => 'report.BusinessStat.industry.InformAndCommunication',
        self::RegisteredEnterprisesNumberIndustryFinanceAndInsurance    => 'report.BusinessStat.industry.FinanceAndInsurance',
        self::RegisteredEnterprisesNumberIndustryRealEstate             => 'report.BusinessStat.industry.RealEstate',
        self::RegisteredEnterprisesNumberIndustryScience                => 'report.BusinessStat.industry.Science',
        self::RegisteredEnterprisesNumberIndustryAdministrateAndSupport => 'report.BusinessStat.industry.AdministrateAndSupport',
        self::RegisteredEnterprisesNumberIndustryGovernmentAndDefence   => 'report.BusinessStat.industry.GovernmentAndDefence',
        self::RegisteredEnterprisesNumberIndustryEducation              => 'report.BusinessStat.industry.Education',
        self::RegisteredEnterprisesNumberIndustryHealthCare             => 'report.BusinessStat.industry.HealthCare',
        self::RegisteredEnterprisesNumberIndustryArtsAndEntertainment   => 'report.BusinessStat.industry.ArtsAndEntertainment',
        self::RegisteredEnterprisesNumberIndustryOther                  => 'report.BusinessStat.industry.Other',
        self::RegisteredEnterprisesNumberIndustryHouseHold              => 'report.BusinessStat.industry.HouseHold',
        self::RegisteredEnterprisesNumberIndustryExtraterritorial       => 'report.BusinessStat.industry.Extraterritorial',
        self::OperatingEnterprisesNumberIndustryForestAndFishing        => 'report.BusinessStat.industry.ForestAndFishing',
        self::OperatingEnterprisesNumberIndustryMining                  => 'report.BusinessStat.industry.Mining',
        self::OperatingEnterprisesNumberIndustryManufacture             => 'report.BusinessStat.industry.Manufacture',
        self::OperatingEnterprisesNumberIndustrySupply                  => 'report.BusinessStat.industry.Supply',
        self::OperatingEnterprisesNumberIndustryWaste                   => 'report.BusinessStat.industry.Waste',
        self::OperatingEnterprisesNumberIndustryBuild                   => 'report.BusinessStat.industry.Build',
        self::OperatingEnterprisesNumberIndustryTradeAndRepair          => 'report.BusinessStat.industry.TradeAndRepair',
        self::OperatingEnterprisesNumberIndustryLogistic                => 'report.BusinessStat.industry.Logistic',
        self::OperatingEnterprisesNumberIndustryAccommodationAndFood    => 'report.BusinessStat.industry.AccommodationAndFood',
        self::OperatingEnterprisesNumberIndustryInformAndCommunication  => 'report.BusinessStat.industry.InformAndCommunication',
        self::OperatingEnterprisesNumberIndustryFinanceAndInsurance     => 'report.BusinessStat.industry.FinanceAndInsurance',
        self::OperatingEnterprisesNumberIndustryRealEstate              => 'report.BusinessStat.industry.RealEstate',
        self::OperatingEnterprisesNumberIndustryScience                 => 'report.BusinessStat.industry.Science',
        self::OperatingEnterprisesNumberIndustryAdministrateAndSupport  => 'report.BusinessStat.industry.AdministrateAndSupport',
        self::OperatingEnterprisesNumberIndustryGovernmentAndDefence    => 'report.BusinessStat.industry.GovernmentAndDefence',
        self::OperatingEnterprisesNumberIndustryEducation               => 'report.BusinessStat.industry.Education',
        self::OperatingEnterprisesNumberIndustryHealthCare              => 'report.BusinessStat.industry.HealthCare',
        self::OperatingEnterprisesNumberIndustryArtsAndEntertainment    => 'report.BusinessStat.industry.ArtsAndEntertainment',
        self::OperatingEnterprisesNumberIndustryOther                   => 'report.BusinessStat.industry.Other',
        self::OperatingEnterprisesNumberIndustryHouseHold               => 'report.BusinessStat.industry.HouseHold',
        self::OperatingEnterprisesNumberIndustryExtraterritorial        => 'report.BusinessStat.industry.Extraterritorial',
    ];

    public const SizeNames = [
        self::RegisteredEnterprisesNumberBySizeSmall  => 'report.BusinessStat.size.small',
        self::RegisteredEnterprisesNumberBySizeMedium => 'report.BusinessStat.size.medium',
        self::RegisteredEnterprisesNumberBySizeLarge  => 'report.BusinessStat.size.large',
        self::OperatingEnterprisesNumberBySizeSmall   => 'report.BusinessStat.size.small',
        self::OperatingEnterprisesNumberBySizeMedium  => 'report.BusinessStat.size.medium',
        self::OperatingEnterprisesNumberBySizeLarge   => 'report.BusinessStat.size.large',
    ];

    public const RegisteredIndustries = [
        self::RegisteredEnterprisesNumberIndustryForestAndFishing,
        self::RegisteredEnterprisesNumberIndustryMining,
        self::RegisteredEnterprisesNumberIndustryManufacture,
        self::RegisteredEnterprisesNumberIndustrySupply,
        self::RegisteredEnterprisesNumberIndustryWaste,
        self::RegisteredEnterprisesNumberIndustryBuild,
        self::RegisteredEnterprisesNumberIndustryTradeAndRepair,
        self::RegisteredEnterprisesNumberIndustryLogistic,
        self::RegisteredEnterprisesNumberIndustryAccommodationAndFood,
        self::RegisteredEnterprisesNumberIndustryInformAndCommunication,
        self::RegisteredEnterprisesNumberIndustryFinanceAndInsurance,
        self::RegisteredEnterprisesNumberIndustryRealEstate,
        self::RegisteredEnterprisesNumberIndustryScience,
        self::RegisteredEnterprisesNumberIndustryAdministrateAndSupport,
        self::RegisteredEnterprisesNumberIndustryGovernmentAndDefence,
        self::RegisteredEnterprisesNumberIndustryEducation,
        self::RegisteredEnterprisesNumberIndustryHealthCare,
        self::RegisteredEnterprisesNumberIndustryArtsAndEntertainment,
        self::RegisteredEnterprisesNumberIndustryOther,
        self::RegisteredEnterprisesNumberIndustryHouseHold,
        self::RegisteredEnterprisesNumberIndustryExtraterritorial,
    ];

    public const RegisteredSizes = [
        self::RegisteredEnterprisesNumberBySizeSmall,
        self::RegisteredEnterprisesNumberBySizeMedium,
        self::RegisteredEnterprisesNumberBySizeLarge,
    ];

    public const OperatingIndustries = [
        self::OperatingEnterprisesNumberIndustryForestAndFishing,
        self::OperatingEnterprisesNumberIndustryMining,
        self::OperatingEnterprisesNumberIndustryManufacture,
        self::OperatingEnterprisesNumberIndustrySupply,
        self::OperatingEnterprisesNumberIndustryWaste,
        self::OperatingEnterprisesNumberIndustryBuild,
        self::OperatingEnterprisesNumberIndustryTradeAndRepair,
        self::OperatingEnterprisesNumberIndustryLogistic,
        self::OperatingEnterprisesNumberIndustryAccommodationAndFood,
        self::OperatingEnterprisesNumberIndustryInformAndCommunication,
        self::OperatingEnterprisesNumberIndustryFinanceAndInsurance,
        self::OperatingEnterprisesNumberIndustryRealEstate,
        self::OperatingEnterprisesNumberIndustryScience,
        self::OperatingEnterprisesNumberIndustryAdministrateAndSupport,
        self::OperatingEnterprisesNumberIndustryGovernmentAndDefence,
        self::OperatingEnterprisesNumberIndustryEducation,
        self::OperatingEnterprisesNumberIndustryHealthCare,
        self::OperatingEnterprisesNumberIndustryArtsAndEntertainment,
        self::OperatingEnterprisesNumberIndustryOther,
        self::OperatingEnterprisesNumberIndustryHouseHold,
        self::OperatingEnterprisesNumberIndustryExtraterritorial,
    ];

    public const OperatingSizes = [
        self::OperatingEnterprisesNumberBySizeSmall,
        self::OperatingEnterprisesNumberBySizeMedium,
        self::OperatingEnterprisesNumberBySizeLarge,
    ];

    public const FirstPartRatios = [
        self::RegisteredEnterprisesNumber,
        self::RegisteredEnterprisesGrowth,
        self::OperatingEnterprisesNumber,
        self::OperatingEnterprisesGrowth,
        self::RegisteredEnterprisesNumberDistrict,
        self::RegisteredEnterprisesNumberIndustry,
        self::RegisteredEnterprisesNumberIndustryForestAndFishing,
        self::RegisteredEnterprisesNumberIndustryMining,
        self::RegisteredEnterprisesNumberIndustryManufacture,
        self::RegisteredEnterprisesNumberIndustrySupply,
        self::RegisteredEnterprisesNumberIndustryWaste,
        self::RegisteredEnterprisesNumberIndustryBuild,
        self::RegisteredEnterprisesNumberIndustryTradeAndRepair,
        self::RegisteredEnterprisesNumberIndustryLogistic,
        self::RegisteredEnterprisesNumberIndustryAccommodationAndFood,
        self::RegisteredEnterprisesNumberIndustryInformAndCommunication,
        self::RegisteredEnterprisesNumberIndustryFinanceAndInsurance,
        self::RegisteredEnterprisesNumberIndustryRealEstate,
        self::RegisteredEnterprisesNumberIndustryScience,
        self::RegisteredEnterprisesNumberIndustryAdministrateAndSupport,
        self::RegisteredEnterprisesNumberIndustryGovernmentAndDefence,
        self::RegisteredEnterprisesNumberIndustryEducation,
        self::RegisteredEnterprisesNumberIndustryHealthCare,
        self::RegisteredEnterprisesNumberIndustryArtsAndEntertainment,
        self::RegisteredEnterprisesNumberIndustryOther,
        self::RegisteredEnterprisesNumberIndustryHouseHold,
        self::RegisteredEnterprisesNumberIndustryExtraterritorial,
        self::RegisteredEnterprisesGrowthYears,
        self::RegisteredEnterprisesNumberBySize,
        self::RegisteredEnterprisesNumberBySizeSmall,
    ];

    public const SecondPartRatios = [
        self::RegisteredEnterprisesNumberBySizeMedium,
        self::RegisteredEnterprisesNumberBySizeLarge,
        self::OperatingEnterprisesNumberDistrict,
        self::OperatingEnterprisesNumberIndustry,
        self::OperatingEnterprisesNumberIndustryForestAndFishing,
        self::OperatingEnterprisesNumberIndustryMining,
        self::OperatingEnterprisesNumberIndustryManufacture,
        self::OperatingEnterprisesNumberIndustrySupply,
        self::OperatingEnterprisesNumberIndustryWaste,
        self::OperatingEnterprisesNumberIndustryBuild,
        self::OperatingEnterprisesNumberIndustryTradeAndRepair,
        self::OperatingEnterprisesNumberIndustryLogistic,
        self::OperatingEnterprisesNumberIndustryAccommodationAndFood,
        self::OperatingEnterprisesNumberIndustryInformAndCommunication,
        self::OperatingEnterprisesNumberIndustryFinanceAndInsurance,
        self::OperatingEnterprisesNumberIndustryRealEstate,
        self::OperatingEnterprisesNumberIndustryScience,
        self::OperatingEnterprisesNumberIndustryAdministrateAndSupport,
        self::OperatingEnterprisesNumberIndustryGovernmentAndDefence,
        self::OperatingEnterprisesNumberIndustryEducation,
        self::OperatingEnterprisesNumberIndustryHealthCare,
        self::OperatingEnterprisesNumberIndustryArtsAndEntertainment,
        self::OperatingEnterprisesNumberIndustryOther,
        self::OperatingEnterprisesNumberIndustryHouseHold,
        self::OperatingEnterprisesNumberIndustryExtraterritorial,
        self::OperatingEnterprisesGrowthYears,
        self::OperatingEnterprisesNumberBySize,
        self::OperatingEnterprisesNumberBySizeSmall,
        self::OperatingEnterprisesNumberBySizeMedium,
        self::OperatingEnterprisesNumberBySizeLarge,
    ];

}
