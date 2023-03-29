<?php

namespace App\Repositories\Enums\Reports\Ser;

interface IInvestmentReport
{
    public const InvestmentSize                                   = '4a4fed81-34d1-4581-a546-a1acc0f39832';       // 1 Объем инвестиций
    public const PhysicalVolumeIndex                              = 'dddded6e-781f-450f-affe-5ff2d9609dd8';       // 2 ИФО
    public const InternalInvestment                               = 'aa716ade-dc2c-4d11-965e-374c4364864f';       // 3 Внутренние инвестиции
    public const ExternalInvestment                               = 'dba203e6-0209-4855-bfc7-b804ce1985c2';       // 4 Внешние инвестиции
    public const InvestmentVolumeByActivity                       = '9f0eae95-1754-4c3e-809d-f2550ec03f83';       // 5 Объем инвестиции по видам деятельности
    public const InvestmentVolumeByActivityIndustry               = '6173de33-f84c-4dd6-80a3-d93748ec31a4';       // 5.1 Объем инвестиции по деятельности - "Промышленность"
    public const InvestmentVolumeByActivityForestAndFishing       = 'd4aa8712-9666-4561-96f7-70b40d54cb01';       // 5.2 Объем инвестиции по деятельности - "Сельское, лесное и рыбное хозяйство"
    public const InvestmentVolumeByActivityBuild                  = '1f8b0af5-aa1b-4371-9aa4-bb7ae836a5ed';       // 5.3 Объем инвестиции по деятельности - "Строительство"
    public const InvestmentVolumeByActivityTradeAndRepair         = '096e329c-1992-4e2b-81df-5cb44624ac32';       // 5.4 Объем инвестиции по деятельности - "Оптовая и розничная торговля; ремонт автомобилей и мотоциклов"
    public const InvestmentVolumeByActivityLogistic               = 'd3933408-6945-4a9c-9fea-5c9e56d6e277';       // 5.5 Объем инвестиции по деятельности - "Транспорт и складирование"
    public const InvestmentVolumeByActivityAccommodationAndFood   = '16e3a839-5133-4cc7-89ef-07274edcf147';       // 5.6 Объем инвестиции по деятельности - "Предоставление услуг по проживанию и питанию"
    public const InvestmentVolumeByActivityInformAndCommunication = '312e2404-56d8-441d-bbb2-bf2ac48a06c3';       // 5.7 Объем инвестиции по деятельности - "Информация и связь"
    public const InvestmentVolumeByActivityFinanceAndInsurance    = 'edc1b0c5-7834-496e-8bac-6dcd6538ae0a';       // 5.8 Объем инвестиции по деятельности - "Финансовая и страховая деятельность"
    public const InvestmentVolumeByActivityRealEstate             = '7d98a94c-f532-4154-b372-4f2cbb0d5083';       // 5.9 Объем инвестиции по деятельности - "Операции с недвижимым имуществом"
    public const InvestmentVolumeByActivityScience                = '16214401-4da8-48e8-aca2-69ae3b36cb62';       // 5.10 Объем инвестиции по деятельности - "Профессиональная, научная и техническая деятельность"
    public const InvestmentVolumeByActivityAdministrateAndSupport = '2315a7e4-70a9-4d36-9a30-a2d82e83b18a';       // 5.11 Объем инвестиции по деятельности - "Деятельность в области административного и вспомогательного обслуживания"
    public const InvestmentVolumeByActivityGovernmentAndDefence   = '7af0a306-f150-472e-bd69-e8c9b707f9a5';       // 5.12 Объем инвестиции по деятельности - "Государственное управление и оборона; обязательное  социальное обеспечение"
    public const InvestmentVolumeByActivityEducation              = '159c5027-a3cb-4f0c-acd9-9cb029322ea4';       // 5.13 Объем инвестиции по деятельности - "Образование"
    public const InvestmentVolumeByActivityHealthCare             = '0c8e3c56-eecb-4561-8dd1-be1e89c803a9';       // 5.14 Объем инвестиции по деятельности - "Здравоохранение и социальное обслуживание населения"
    public const InvestmentVolumeByActivityArtsAndEntertainment   = '8fa3d637-9f04-4f54-9cde-091bac051c34';       // 5.15 Объем инвестиции по деятельности - "Искусство, развлечения и отдых"
    public const InvestmentVolumeByActivityOther                  = '955af7d7-9f7d-4543-9bfe-873be42fe87d';       // 5.16 Объем инвестиции по деятельности - "Предоставление прочих видов услуг"
    public const InvestmentByDistrict                             = '8f99d0a2-e6a8-4854-930a-d452ce855a31';       // 6 Объем инвестиции по районам
    public const InvestmentBySizeOfEnterprises                    = '2968f831-cd5c-43e7-8c9d-3649619c5448';       // 7 Инвестиции по размерности предприятий
    public const InvestmentBySizeOfEnterprisesSmall               = '9d883919-b6c6-48b6-b171-d800105d7130';       // 7.1 Инвестиции по размерности предприятий - Малый бизнес
    public const InvestmentBySizeOfEnterprisesMedium              = '329c77ec-1390-42f1-8313-2029a14eb311';       // 7.2 Инвестиции по размерности предприятий - Средний бизнес
    public const InvestmentBySizeOfEnterprisesLarge               = 'f047c9c6-a6d3-4ec3-8457-e4d36d5cf5a9';       // 7.3 Инвестиции по размерности предприятий - Крупный бизнес
    public const InvestmentByCostType                             = '20871d70-ace1-4730-97c7-279a6c37f0fe';       // 8 Инвестиции по видам затрат
    public const InvestmentByCostTypeBuilding                     = 'd576132e-0283-4332-9f27-bcfce509a2b6';       // 8.1 Инвестиции по виду затрат - затраты на работы по строительству и капитальному ремонту зданий и сооружений
    public const InvestmentByCostTypeFarm                         = 'ccbf330f-6984-4eda-8006-292bbe53a4ce';       // 8.2 Инвестиции по виду затрат - затраты по насаждению и выращиванию многолетних культур
    public const InvestmentByCostTypeStockRaising                 = '02921696-a835-481b-9b01-903f4e4d15c2';       // 8.3 Инвестиции по виду затрат - затраты на формирование рабочего, продуктивного и племенного стада
    public const InvestmentByCostTypeOtherCapital                 = '681766a7-3680-43df-9801-6ed0caf35830';       // 8.4 Инвестиции по виду затрат - прочие затраты в объеме инвестиций в материальный основной капитал
    public const InvestmentByCostTypeMachinery                    = '3e856484-5394-4f9d-8ceb-8b182a34066f';       // 8.5 Инвестиции по виду затрат - Машины, оборудование и транспортные средства
    public const InvestmentByCostTypeIt                           = '40768c0a-8b07-4896-96da-2210b90f34da';       // 8.6 Инвестиции по виду затрат - затраты на создание и приобретение компьютерного программного обеспечения и баз данных
    public const InvestmentByCostTypeExploration                  = 'fcc49598-1ae5-438b-9bce-712a1b820c31';       // 8.7 Инвестиции по виду затрат - затраты на разведку и оценку запасов полезных ископаемых
    public const InvestmentByCostTypeOther                        = 'ddbc8da0-10a3-4c33-824b-5914be85253c';       // 8.8 Инвестиции по виду затрат - прочие затраты в объеме инвестиций в нематериальный основной капитал
    public const InvestmentIfoDynamic                             = '80be3cd1-cef7-4e66-9960-f5523cf617de';       // 9 Динамика ИФО инвестиции
    public const InvestmentGovernment                             = '51959f46-e470-48f2-b68d-7e346ad5b43c';       // 10 Государственные инвестиции
    public const InvestmentGovernmentRepublic                     = '6571a188-56e0-4484-803b-aff662bf86ad';       // 10.1 Государственные инвестиции - Республиканский бюджет
    public const InvestmentGovernmentLocal                        = 'e1b865f1-fe1f-4cee-a594-aedc8ae8bcb5';       // 10.2 Государственные инвестиции - Местный бюджет
    public const InvestmentOwn                                    = 'ac9e3371-1a18-42f8-be05-bdfea65862dc';       // 11 Собственные инвестиции
    public const InvestmentLoan                                   = '2ff0d278-1c1a-4a95-9bdd-4f2e5b100ffb';       // 12 Заемные инвестиции

    public const MonthRatiosList = [
        self::InvestmentIfoDynamic,
    ];
    public const QuarterRatiosList = [];

    public const VIRTUAL_RATIOS = [
        self::InvestmentVolumeByActivity,
        self::InvestmentBySizeOfEnterprises,
        self::InvestmentByCostType,
        self::InvestmentGovernment,
    ];

    public const DISTRICT_REPORT_RATIOS = [
        self::InvestmentByDistrict,
    ];

    public const InvestmentVolumeByActivityIds = [
        self::InvestmentVolumeByActivityIndustry               => 741340,
        self::InvestmentVolumeByActivityForestAndFishing       => 447173,
        self::InvestmentVolumeByActivityBuild                  => 448148,
        self::InvestmentVolumeByActivityTradeAndRepair         => 448215,
        self::InvestmentVolumeByActivityLogistic               => 448475,
        self::InvestmentVolumeByActivityAccommodationAndFood   => 448558,
        self::InvestmentVolumeByActivityInformAndCommunication => 448585,
        self::InvestmentVolumeByActivityFinanceAndInsurance    => 448658,
        self::InvestmentVolumeByActivityRealEstate             => 448714,
        self::InvestmentVolumeByActivityScience                => 448728,
        self::InvestmentVolumeByActivityAdministrateAndSupport => 448797,
        self::InvestmentVolumeByActivityGovernmentAndDefence   => 448889,
        self::InvestmentVolumeByActivityEducation              => 448918,
        self::InvestmentVolumeByActivityHealthCare             => 448950,
        self::InvestmentVolumeByActivityArtsAndEntertainment   => 448991,
        self::InvestmentVolumeByActivityOther                  => 449040,
    ];

    public const InvestmentVolumeByActivityNames = [
        self::InvestmentVolumeByActivityIndustry               => 'report.Investments.activity.Industry',
        self::InvestmentVolumeByActivityForestAndFishing       => 'report.Investments.activity.ForestAndFishing',
        self::InvestmentVolumeByActivityBuild                  => 'report.Investments.activity.Build',
        self::InvestmentVolumeByActivityTradeAndRepair         => 'report.Investments.activity.TradeAndRepair',
        self::InvestmentVolumeByActivityLogistic               => 'report.Investments.activity.Logistic',
        self::InvestmentVolumeByActivityAccommodationAndFood   => 'report.Investments.activity.AccommodationAndFood',
        self::InvestmentVolumeByActivityInformAndCommunication => 'report.Investments.activity.InformAndCommunication',
        self::InvestmentVolumeByActivityFinanceAndInsurance    => 'report.Investments.activity.FinanceAndInsurance',
        self::InvestmentVolumeByActivityRealEstate             => 'report.Investments.activity.RealEstate',
        self::InvestmentVolumeByActivityScience                => 'report.Investments.activity.Science',
        self::InvestmentVolumeByActivityAdministrateAndSupport => 'report.Investments.activity.AdministrateAndSupport',
        self::InvestmentVolumeByActivityGovernmentAndDefence   => 'report.Investments.activity.GovernmentAndDefence',
        self::InvestmentVolumeByActivityEducation              => 'report.Investments.activity.Education',
        self::InvestmentVolumeByActivityHealthCare             => 'report.Investments.activity.HealthCare',
        self::InvestmentVolumeByActivityArtsAndEntertainment   => 'report.Investments.activity.ArtsAndEntertainment',
        self::InvestmentVolumeByActivityOther                  => 'report.Investments.activity.Other',
    ];

    public const InvestmentBySizeOfEnterprisesIds = [
        self::InvestmentBySizeOfEnterprisesSmall  => 19123,
        self::InvestmentBySizeOfEnterprisesMedium => 19132,
        self::InvestmentBySizeOfEnterprisesLarge  => 19137,
    ];

    public const InvestmentBySizeOfEnterprisesNames = [
        self::InvestmentBySizeOfEnterprisesSmall  => 'report.Investments.size.small',
        self::InvestmentBySizeOfEnterprisesMedium => 'report.Investments.size.medium',
        self::InvestmentBySizeOfEnterprisesLarge  => 'report.Investments.size.large',
    ];

    public const InvestmentByCostTypeIds = [
        self::InvestmentByCostTypeBuilding     => 19721127,
        self::InvestmentByCostTypeFarm         => 19202543,
        self::InvestmentByCostTypeStockRaising => 19202544,
        self::InvestmentByCostTypeOtherCapital => 19202545,
        self::InvestmentByCostTypeMachinery    => 19202539,
        self::InvestmentByCostTypeIt           => 19202555,
        self::InvestmentByCostTypeExploration  => 19202556,
        self::InvestmentByCostTypeOther        => 19202560,
    ];

    public const InvestmentByCostTypeNames = [
        self::InvestmentByCostTypeBuilding     => 'report.Investments.costType.Building',
        self::InvestmentByCostTypeFarm         => 'report.Investments.costType.Farm',
        self::InvestmentByCostTypeStockRaising => 'report.Investments.costType.StockRaising',
        self::InvestmentByCostTypeOtherCapital => 'report.Investments.costType.OtherCapital',
        self::InvestmentByCostTypeMachinery    => 'report.Investments.costType.Machinery',
        self::InvestmentByCostTypeIt           => 'report.Investments.costType.It',
        self::InvestmentByCostTypeExploration  => 'report.Investments.costType.Exploration',
        self::InvestmentByCostTypeOther        => 'report.Investments.costType.Other',
    ];

    public const InvestmentGovernmentIds = [
        self::InvestmentGovernmentRepublic => 451911,
        self::InvestmentGovernmentLocal    => 451916,
    ];

    public const InvestmentGovernmentNames = [
        self::InvestmentGovernmentRepublic => 'report.Investments.government.Republic',
        self::InvestmentGovernmentLocal    => 'report.Investments.government.Local',
    ];

    public const RatioNames = [
        self::InvestmentSize                                   => 'report.Investments.fields.InvestmentSize',
        self::PhysicalVolumeIndex                              => 'report.Investments.fields.PhysicalVolumeIndex',
        self::InternalInvestment                               => 'report.Investments.fields.InternalInvestment',
        self::ExternalInvestment                               => 'report.Investments.fields.ExternalInvestment',
        self::InvestmentVolumeByActivity                       => 'report.Investments.fields.InvestmentVolumeByActivity',
        self::InvestmentVolumeByActivityIndustry               => 'report.Investments.fields.InvestmentVolumeByActivityIndustry',
        self::InvestmentVolumeByActivityForestAndFishing       => 'report.Investments.fields.InvestmentVolumeByActivityForestAndFishing',
        self::InvestmentVolumeByActivityBuild                  => 'report.Investments.fields.InvestmentVolumeByActivityBuild',
        self::InvestmentVolumeByActivityTradeAndRepair         => 'report.Investments.fields.InvestmentVolumeByActivityTradeAndRepair',
        self::InvestmentVolumeByActivityLogistic               => 'report.Investments.fields.InvestmentVolumeByActivityLogistic',
        self::InvestmentVolumeByActivityAccommodationAndFood   => 'report.Investments.fields.InvestmentVolumeByActivityAccommodationAndFood',
        self::InvestmentVolumeByActivityInformAndCommunication => 'report.Investments.fields.InvestmentVolumeByActivityInformAndCommunication',
        self::InvestmentVolumeByActivityFinanceAndInsurance    => 'report.Investments.fields.InvestmentVolumeByActivityFinanceAndInsurance',
        self::InvestmentVolumeByActivityRealEstate             => 'report.Investments.fields.InvestmentVolumeByActivityRealEstate',
        self::InvestmentVolumeByActivityScience                => 'report.Investments.fields.InvestmentVolumeByActivityScience',
        self::InvestmentVolumeByActivityAdministrateAndSupport => 'report.Investments.fields.InvestmentVolumeByActivityAdministrateAndSupport',
        self::InvestmentVolumeByActivityGovernmentAndDefence   => 'report.Investments.fields.InvestmentVolumeByActivityGovernmentAndDefence',
        self::InvestmentVolumeByActivityEducation              => 'report.Investments.fields.InvestmentVolumeByActivityEducation',
        self::InvestmentVolumeByActivityHealthCare             => 'report.Investments.fields.InvestmentVolumeByActivityHealthCare',
        self::InvestmentVolumeByActivityArtsAndEntertainment   => 'report.Investments.fields.InvestmentVolumeByActivityArtsAndEntertainment',
        self::InvestmentVolumeByActivityOther                  => 'report.Investments.fields.InvestmentVolumeByActivityOther',
        self::InvestmentByDistrict                             => 'report.Investments.fields.InvestmentByDistrict',
        self::InvestmentBySizeOfEnterprises                    => 'report.Investments.fields.InvestmentBySizeOfEnterprises',
        self::InvestmentBySizeOfEnterprisesSmall               => 'report.Investments.fields.InvestmentBySizeOfEnterprisesSmall',
        self::InvestmentBySizeOfEnterprisesMedium              => 'report.Investments.fields.InvestmentBySizeOfEnterprisesMedium',
        self::InvestmentBySizeOfEnterprisesLarge               => 'report.Investments.fields.InvestmentBySizeOfEnterprisesLarge',
        self::InvestmentByCostType                             => 'report.Investments.fields.InvestmentByCostType',
        self::InvestmentByCostTypeBuilding                     => 'report.Investments.fields.InvestmentByCostTypeBuilding',
        self::InvestmentByCostTypeFarm                         => 'report.Investments.fields.InvestmentByCostTypeFarm',
        self::InvestmentByCostTypeStockRaising                 => 'report.Investments.fields.InvestmentByCostTypeStockRaising',
        self::InvestmentByCostTypeOtherCapital                 => 'report.Investments.fields.InvestmentByCostTypeOtherCapital',
        self::InvestmentByCostTypeMachinery                    => 'report.Investments.fields.InvestmentByCostTypeMachinery',
        self::InvestmentByCostTypeIt                           => 'report.Investments.fields.InvestmentByCostTypeIt',
        self::InvestmentByCostTypeExploration                  => 'report.Investments.fields.InvestmentByCostTypeExploration',
        self::InvestmentByCostTypeOther                        => 'report.Investments.fields.InvestmentByCostTypeOther',
        self::InvestmentIfoDynamic                             => 'report.Investments.fields.InvestmentIfoDynamic',
        self::InvestmentGovernment                             => 'report.Investments.fields.InvestmentGovernment',
        self::InvestmentGovernmentRepublic                     => 'report.Investments.fields.InvestmentGovernmentRepublic',
        self::InvestmentGovernmentLocal                        => 'report.Investments.fields.InvestmentGovernmentLocal',
        self::InvestmentOwn                                    => 'report.Investments.fields.InvestmentOwn',
        self::InvestmentLoan                                   => 'report.Investments.fields.InvestmentLoan',
    ];

    public const PlainRatios = [
        self::InvestmentSize      => 'invest_value',
        self::PhysicalVolumeIndex => 'IFO',
        self::InternalInvestment  => 'internal_invest',
        self::ExternalInvestment  => 'external_invest',
        self::InvestmentOwn       => 'self_invest',
        self::InvestmentLoan      => 'loan_invest',
    ];

}
