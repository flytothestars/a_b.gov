<?php

namespace App\Repositories\Enums\Reports\Prt;

interface IPrtReport
{
    public const PhysicalVolumeIndexProcessingIndustrialPlan = '622a1ff8-f11f-43f3-8b11-601f19820636';      // 1.1 ИФО производства в обрабатывающей промышленности - план
    public const PhysicalVolumeIndexProcessingIndustrialFact = '44f7ae36-43b5-4237-ad61-558d119eb1d8';      // 1.2 ИФО производства в обрабатывающей промышленности - факт
    public const NonResourceExportGrowthPlan                 = '4a174d40-8b1d-46a1-a03a-a64123a68093';      // 2.1 Рост объема не сырьевого экспорта - план
    public const NonResourceExportGrowthFact                 = '9d4a5dad-e304-492d-89be-169c02142b6b';      // 2.2 Рост объема не сырьевого экспорта - факт
    public const MainCapitalInvestmentsPlan                  = '35c121d2-77b5-451a-ac87-05661a1876ae';      // 3.1 Инвестиции в основной капитал в обрабатывающей промышленности - план
    public const MainCapitalInvestmentsPlanAmount            = '0a49bd26-c806-471e-aed0-25078202db75';      // 3.3 Инвестиции в основной капитал в обрабатывающей промышленности - план сумма
    public const MainCapitalInvestmentsFact                  = '430e80b6-53f4-497d-9216-0a48ba4f3968';      // 3.2 Инвестиции в основной капитал в обрабатывающей промышленности - факт
    public const IfoProcessingIndustrialDynamic              = 'fd7572ed-5c24-449c-aa5f-7de7b938b0df';      // 4 Динамика ИФО производства в обрабатывающей промышленности
    public const NonResourceExportDynamic                    = 'ece10b85-3a10-408d-8282-680d255a2c56';      // 5 Динамика роста объема не сырьевого экспорта
    public const MainCapitalInvestmentsInvestmentsDynamic    = '133e5ccb-42f7-44f2-ada0-725672cb542a';      // 6 Инвестиции в основной капитал в обрабатывающей промышленности
    public const Top5IndustryIfoUp                           = 'c752c88f-4df8-4991-99bb-cdec89341b88';      // 7 ТОП 5 отраслей по росту ИФО
    public const Top5IndustryIfoDown                         = '80947dbb-eafc-463d-a991-1bccff4cce97';      // 8 ТОП 5 отраслей по снижению ИФО
    public const IndustryIfoIndustryIndustrial               = '715a7692-6b99-4744-97bd-1b8da53cbd38';      // 8.1 ИФО отрасли - "Промышленность"
    public const IndustryIfoIndustryForestAndFishing         = '1afd0517-1a8c-42b6-b32b-5b54cc1e885b';      // 8.2 ИФО отрасли - "Сельское, лесное и рыбное хозяйство"
    public const IndustryIfoIndustryBuild                    = 'beb31b40-473a-459d-bdd1-15be40c3f04a';      // 8.3 ИФО отрасли - "Строительство"
    public const IndustryIfoIndustryTradeAndRepair           = 'de2c408d-d6ed-4e8f-9f01-c3ff8d874c67';      // 8.4 ИФО отрасли - "Оптовая и розничная торговля; ремонт автомобилей и мотоциклов"
    public const IndustryIfoIndustryLogistic                 = '48a55a28-5f72-472c-80fc-dc49014e97d3';      // 8.5 ИФО отрасли - "Транспорт и складирование"
    public const IndustryIfoIndustryAccommodationAndFood     = '37469f4f-964e-49c2-ba94-3e01d58769a9';      // 8.6 ИФО отрасли - "Предоставление услуг по проживанию и питанию"
    public const IndustryIfoIndustryInformAndCommunication   = '163d48f9-e9bb-4173-b721-1e2074b33996';      // 8.7 ИФО отрасли - "Информация и связь"
    public const IndustryIfoIndustryFinanceAndInsurance      = 'f75028fc-a362-40ee-b0bc-8ea410517103';      // 8.8 ИФО отрасли - "Финансовая и страховая деятельность"
    public const IndustryIfoIndustryRealEstate               = 'bb4f4e49-225f-4793-a0b7-abfdb026ab9c';      // 8.9 ИФО отрасли - "Операции с недвижимым имуществом"
    public const IndustryIfoIndustryScience                  = '92a546ec-070f-4955-81e7-f7a045349336';      // 8.10 ИФО отрасли - "Профессиональная, научная и техническая деятельность"
    public const IndustryIfoIndustryAdministrateAndSupport   = '0db8d5ac-b66b-45df-aa83-bfa4a7db7bb9';      // 8.11 ИФО отрасли - "Деятельность в области административного и вспомогательного обслуживания"
    public const IndustryIfoIndustryGovernmentAndDefence     = '4ccf909c-e98f-4885-9c19-d33eb7389a49';      // 8.12 ИФО отрасли - "Государственное управление и оборона; обязательное  социальное обеспечение"
    public const IndustryIfoIndustryEducation                = '2a4dabaf-bed7-4147-ba03-539e346bd2e9';      // 8.13 ИФО отрасли - "Образование"
    public const IndustryIfoIndustryHealthCare               = '4899c482-e771-43db-9a4a-e47654663c80';      // 8.14 ИФО отрасли - "Здравоохранение и социальное обслуживание населения"
    public const IndustryIfoIndustryArtsAndEntertainment     = 'c68dd5cd-8900-42f6-b59c-6892c9043654';      // 8.15 ИФО отрасли - "Искусство, развлечения и отдых"
    public const IndustryIfoIndustryOther                    = '9df9853b-e70c-4803-9740-de50df45f398';      // 8.16 ИФО отрасли - "Предоставление прочих видов услуг"
    public const IndustryIfoIndustryHouseHold                = 'a4792694-f407-4230-abfa-7eac33ec2727';      // 8.17 ИФО отрасли - "Деятельность домашних хозяйств, нанимающих домашнюю прислугу; деятельность домашних хозяйств по производству товаров и услуг для собственного потребления"
    public const IndustryIfoIndustryExtraterritorial         = '0e3a5526-2be3-4a67-8715-249e6ed48f17';      // 8.18 ИФО отрасли - "Деятельность экстерриториальных организаций и органов"
    public const IndustryIfoIndustryMining                   = 'add431ae-b972-4a30-8d4d-36ffad6354f1';      // 8.19 ИФО отрасли - "Горнодобывающая промышленность и разработка карьеров"
    public const IndustryIfoIndustryManufacture              = '84f4dacd-923d-4ae3-b675-964dbfc6eb67';      // 8.20 ИФО отрасли - "Обрабатывающая промышленность"
    public const IndustryIfoIndustrySupply                   = 'f07bc780-3bf6-450b-b7e9-a28b93c61ac1';      // 8.21 ИФО отрасли - "Снабжение электроэнергией, газом, паром, горячей водой и кондиционированным воздухом"
    public const IndustryIfoIndustryWaste                    = '453f1e9c-932e-4aa7-8fbb-a59bf3d9d355';      // 8.22 ИФО отрасли - "Водоснабжение; сбор, обработка и удаление отходов, деятельность по ликвидации загрязнений"
    public const Top5IndustryExportIfoUp                     = 'c66b7f1f-ec61-4ff1-96ee-6d7507399ff1';      // 9 ТОП 5 отраслей по росту экспорта
    public const Top5IndustryExportIfoDown                   = '4a4d1f3e-2769-4745-aefc-973a7c93e1e2';      // 10 ТОП 5 отраслей по снижению экспорта
    public const IndustryIfoExportIndustrial                 = 'c1e7a0aa-088c-4e39-9233-f5edc15c42f1';      // 10.1 экспорт отрасли - "Промышленность"
    public const IndustryIfoExportForestAndFishing           = '9db48375-cef0-4958-b288-a3298e9a3b5f';      // 10.2 экспорт отрасли - "Сельское, лесное и рыбное хозяйство"
    public const IndustryIfoExportBuild                      = 'a4c3367f-1170-401d-824e-dff5a56f0c46';      // 10.3 экспорт отрасли - "Строительство"
    public const IndustryIfoExportTradeAndRepair             = '6d46a55d-7498-4685-b0b5-345346119165';      // 10.4 экспорт отрасли - "Оптовая и розничная торговля; ремонт автомобилей и мотоциклов"
    public const IndustryIfoExportLogistic                   = '38a1981d-0658-40ba-8d8b-7278094ba667';      // 10.5 экспорт отрасли - "Транспорт и складирование"
    public const IndustryIfoExportAccommodationAndFood       = '1131ea66-7b8f-4aed-86b2-344e041c853f';      // 10.6 экспорт отрасли - "Предоставление услуг по проживанию и питанию"
    public const IndustryIfoExportInformAndCommunication     = 'ca77382f-b5c1-429d-bd26-4e3b8727f476';      // 10.7 экспорт отрасли - "Информация и связь"
    public const IndustryIfoExportFinanceAndInsurance        = '655ce397-1922-4637-b6a4-4d3440cd5757';      // 10.8 экспорт отрасли - "Финансовая и страховая деятельность"
    public const IndustryIfoExportRealEstate                 = '74e616b7-34c6-4db3-a810-9315351edcd8';      // 10.9 экспорт отрасли - "Операции с недвижимым имуществом"
    public const IndustryIfoExportScience                    = '3316c672-b0d9-4661-ac71-bd7d8be2ac8d';      // 10.10 экспорт отрасли - "Профессиональная, научная и техническая деятельность"
    public const IndustryIfoExportAdministrateAndSupport     = '4c01a8f6-f30d-4175-9b74-ac3aafbd6cab';      // 10.11 экспорт отрасли - "Деятельность в области административного и вспомогательного обслуживания"
    public const IndustryIfoExportGovernmentAndDefence       = 'af1001e4-711b-47ca-bc81-437be3e57d36';      // 10.12 экспорт отрасли - "Государственное управление и оборона; обязательное  социальное обеспечение"
    public const IndustryIfoExportEducation                  = '5acce7d1-8fbb-4b4b-931e-5722880ce47f';      // 10.13 экспорт отрасли - "Образование"
    public const IndustryIfoExportHealthCare                 = '7bef33c7-d885-4a08-8c11-ffec08924f54';      // 10.14 экспорт отрасли - "Здравоохранение и социальное обслуживание населения"
    public const IndustryIfoExportArtsAndEntertainment       = '1064656f-549a-4442-83fe-b74d3c64de31';      // 10.15 экспорт отрасли - "Искусство, развлечения и отдых"
    public const IndustryIfoExportOther                      = 'da1d7d8a-7e77-48ed-942c-446836d80386';      // 10.16 экспорт отрасли - "Предоставление прочих видов услуг"
    public const IndustryIfoExportHouseHold                  = '21644513-bbeb-4fa0-abb6-96f1f4a8287b';      // 10.17 экспорт отрасли - "Деятельность домашних хозяйств, нанимающих домашнюю прислугу; деятельность домашних хозяйств по производству товаров и услуг для собственного потребления"
    public const IndustryIfoExportExtraterritorial           = '8f74fc82-3e14-4b45-8090-7b477d65bfac';      // 10.18 экспорт отрасли - "Деятельность экстерриториальных организаций и органов"
    public const IndustryIfoExportMining                     = 'fbb8b789-2674-4fa8-8295-3e11af98a959';      // 10.19 экспорт отрасли - "Горнодобывающая промышленность и разработка карьеров"
    public const IndustryIfoExportManufacture                = '40bff292-8325-4900-8cad-60c223bcaa6f';      // 10.20 экспорт отрасли - "Обрабатывающая промышленность"
    public const IndustryIfoExportSupply                     = '47a45ff0-2415-4dd5-9c2e-1c6260a49201';      // 10.21 экспорт отрасли - "Снабжение электроэнергией, газом, паром, горячей водой и кондиционированным воздухом"
    public const IndustryIfoExportWaste                      = '52955e93-7820-41c4-815a-38f6315669b8';      // 10.22 экспорт отрасли - "Водоснабжение; сбор, обработка и удаление отходов, деятельность по ликвидации загрязнений"
    public const Top5IndustryInvestUp                        = 'c4ff897e-b6c2-46fa-a00e-f93a24890433';      // 11 ТОП 5 отраслей по росту инвестиций
    public const Top5IndustryInvestDown                      = '99fc2321-fc51-49dc-8405-4acf779e2ba4';      // 12 ТОП 5 отраслей по снижению инвестиций
    public const Top5IndustryInvestIndustrial                = 'd7f5d8ee-6eed-48b7-95d0-2239553b5505';      // 12.1 инвестиции отрасли - "Промышленность"
    public const Top5IndustryInvestForestAndFishing          = '445fdb49-e63f-4767-8fb7-1408e4131d8b';      // 12.2 инвестиции отрасли - "Сельское, лесное и рыбное хозяйство"
    public const Top5IndustryInvestBuild                     = '8d48188f-ca5f-40d3-9340-9b92c1d781bb';      // 12.3 инвестиции отрасли - "Строительство"
    public const Top5IndustryInvestTradeAndRepair            = '4978a9c4-f505-4662-be4d-91f3c9385783';      // 12.4 инвестиции отрасли - "Оптовая и розничная торговля; ремонт автомобилей и мотоциклов"
    public const Top5IndustryInvestLogistic                  = '9dc7596c-2b54-483c-a2eb-a8270dfac2d0';      // 12.5 инвестиции отрасли - "Транспорт и складирование"
    public const Top5IndustryInvestAccommodationAndFood      = 'b36ae0ad-affb-4933-8843-f025ba86fa26';      // 12.6 инвестиции отрасли - "Предоставление услуг по проживанию и питанию"
    public const Top5IndustryInvestInformAndCommunication    = '8cda8d18-3434-480d-a84a-9dc2ea73d442';      // 12.7 инвестиции отрасли - "Информация и связь"
    public const Top5IndustryInvestFinanceAndInsurance       = 'c5e62f94-a229-48a9-b3f8-801feecb4378';      // 12.8 инвестиции отрасли - "Финансовая и страховая деятельность"
    public const Top5IndustryInvestRealEstate                = 'bc83b072-39b7-4e33-98ca-ed80888da6ae';      // 12.9 инвестиции отрасли - "Операции с недвижимым имуществом"
    public const Top5IndustryInvestScience                   = 'c3f64e77-ed5d-4422-889e-d15c7bb1cac7';      // 12.10 инвестиции отрасли - "Профессиональная, научная и техническая деятельность"
    public const Top5IndustryInvestAdministrateAndSupport    = 'b5e964d3-4b52-4b9f-9aa2-95cd3932ccca';      // 12.11 инвестиции отрасли - "Деятельность в области административного и вспомогательного обслуживания"
    public const Top5IndustryInvestGovernmentAndDefence      = '068d1ce1-a83e-415b-b19c-9930d2cd9c3c';      // 12.12 инвестиции отрасли - "Государственное управление и оборона; обязательное  социальное обеспечение"
    public const Top5IndustryInvestEducation                 = '0f93a675-e0e2-4811-833a-388cd12abca7';      // 12.13 инвестиции отрасли - "Образование"
    public const Top5IndustryInvestHealthCare                = '64b1524f-5f4c-46d6-9090-c95af23b862e';      // 12.14 инвестиции отрасли - "Здравоохранение и социальное обслуживание населения"
    public const Top5IndustryInvestArtsAndEntertainment      = '4d8394be-b65c-459c-932b-7053a12c4d7a';      // 12.15 инвестиции отрасли - "Искусство, развлечения и отдых"
    public const Top5IndustryInvestOther                     = '2918284a-982e-4712-8920-d1397dc2f688';      // 12.16 инвестиции отрасли - "Предоставление прочих видов услуг"
    public const Top5IndustryInvestHouseHold                 = '4ce4914e-b46b-4b83-badc-10d605b82b09';      // 12.17 инвестиции отрасли - "Деятельность домашних хозяйств, нанимающих домашнюю прислугу; деятельность домашних хозяйств по производству товаров и услуг для собственного потребления"
    public const Top5IndustryInvestExtraterritorial          = '56abd80b-f2b4-41f4-a145-a318e5261963';      // 12.18 инвестиции отрасли - "Деятельность экстерриториальных организаций и органов"
    public const Top5IndustryInvestMining                    = 'cc430f9e-3181-4d9e-9ceb-d603ed2d237f';      // 12.19 инвестиции отрасли - "Горнодобывающая промышленность и разработка карьеров"
    public const Top5IndustryInvestManufacture               = '5f7312fa-0b68-4761-a087-c08632355068';      // 12.20 инвестиции отрасли - "Обрабатывающая промышленность"
    public const Top5IndustryInvestSupply                    = 'c2ee3aea-f199-410a-80fe-b808c6b7fa29';      // 12.21 инвестиции отрасли - "Снабжение электроэнергией, газом, паром, горячей водой и кондиционированным воздухом"
    public const Top5IndustryInvestWaste                     = '3fc2f613-9549-4218-9129-19adcbfdd53e';       // 12.22 инвестиции отрасли - "Водоснабжение; сбор, обработка и удаление отходов, деятельность по ликвидации загрязнений"

    public const MonthRatiosList   = [
        self::IfoProcessingIndustrialDynamic,
        self::MainCapitalInvestmentsFact,
    ];
    public const QuarterRatiosList = [
        self::NonResourceExportDynamic,
    ];

    public const VIRTUAL_RATIOS = [
        self::PhysicalVolumeIndexProcessingIndustrialFact,
        self::IfoProcessingIndustrialDynamic,
        self::NonResourceExportDynamic,
        self::MainCapitalInvestmentsInvestmentsDynamic,
        self::Top5IndustryIfoUp,
        self::Top5IndustryIfoDown,
        self::Top5IndustryExportIfoUp,
        self::Top5IndustryExportIfoDown,
        self::Top5IndustryInvestUp,
        self::Top5IndustryInvestDown,
    ];

    public const IndustryNames = [
        self::IndustryIfoIndustryIndustrial             => 'report.PRT.industries.Top5IndustryInvestIndustrial',
        self::IndustryIfoIndustryForestAndFishing       => 'report.PRT.industries.Top5IndustryInvestForestAndFishing',
        self::IndustryIfoIndustryBuild                  => 'report.PRT.industries.Top5IndustryInvestBuild',
        self::IndustryIfoIndustryTradeAndRepair         => 'report.PRT.industries.Top5IndustryInvestTradeAndRepair',
        self::IndustryIfoIndustryLogistic               => 'report.PRT.industries.Top5IndustryInvestLogistic',
        self::IndustryIfoIndustryAccommodationAndFood   => 'report.PRT.industries.Top5IndustryInvestAccommodationAndFood',
        self::IndustryIfoIndustryInformAndCommunication => 'report.PRT.industries.Top5IndustryInvestInformAndCommunication',
        self::IndustryIfoIndustryFinanceAndInsurance    => 'report.PRT.industries.Top5IndustryInvestFinanceAndInsurance',
        self::IndustryIfoIndustryRealEstate             => 'report.PRT.industries.Top5IndustryInvestRealEstate',
        self::IndustryIfoIndustryScience                => 'report.PRT.industries.Top5IndustryInvestScience',
        self::IndustryIfoIndustryAdministrateAndSupport => 'report.PRT.industries.Top5IndustryInvestAdministrateAndSupport',
        self::IndustryIfoIndustryGovernmentAndDefence   => 'report.PRT.industries.Top5IndustryInvestGovernmentAndDefence',
        self::IndustryIfoIndustryEducation              => 'report.PRT.industries.Top5IndustryInvestEducation',
        self::IndustryIfoIndustryHealthCare             => 'report.PRT.industries.Top5IndustryInvestHealthCare',
        self::IndustryIfoIndustryArtsAndEntertainment   => 'report.PRT.industries.Top5IndustryInvestArtsAndEntertainment',
        self::IndustryIfoIndustryOther                  => 'report.PRT.industries.Top5IndustryInvestOther',
        self::IndustryIfoIndustryHouseHold              => 'report.PRT.industries.Top5IndustryInvestHouseHold',
        self::IndustryIfoIndustryExtraterritorial       => 'report.PRT.industries.Top5IndustryInvestExtraterritorial',
        self::IndustryIfoIndustryMining                 => 'report.PRT.industries.Top5IndustryInvestMining',
        self::IndustryIfoIndustryManufacture            => 'report.PRT.industries.Top5IndustryInvestManufacture',
        self::IndustryIfoIndustrySupply                 => 'report.PRT.industries.Top5IndustryInvestSupply',
        self::IndustryIfoIndustryWaste                  => 'report.PRT.industries.Top5IndustryInvestWaste',

        self:: IndustryIfoExportIndustrial             => 'report.PRT.industries.Top5IndustryInvestIndustrial',
        self:: IndustryIfoExportForestAndFishing       => 'report.PRT.industries.Top5IndustryInvestForestAndFishing',
        self:: IndustryIfoExportBuild                  => 'report.PRT.industries.Top5IndustryInvestBuild',
        self:: IndustryIfoExportTradeAndRepair         => 'report.PRT.industries.Top5IndustryInvestTradeAndRepair',
        self:: IndustryIfoExportLogistic               => 'report.PRT.industries.Top5IndustryInvestLogistic',
        self:: IndustryIfoExportAccommodationAndFood   => 'report.PRT.industries.Top5IndustryInvestAccommodationAndFood',
        self:: IndustryIfoExportInformAndCommunication => 'report.PRT.industries.Top5IndustryInvestInformAndCommunication',
        self:: IndustryIfoExportFinanceAndInsurance    => 'report.PRT.industries.Top5IndustryInvestFinanceAndInsurance',
        self:: IndustryIfoExportRealEstate             => 'report.PRT.industries.Top5IndustryInvestRealEstate',
        self:: IndustryIfoExportScience                => 'report.PRT.industries.Top5IndustryInvestScience',
        self:: IndustryIfoExportAdministrateAndSupport => 'report.PRT.industries.Top5IndustryInvestAdministrateAndSupport',
        self:: IndustryIfoExportGovernmentAndDefence   => 'report.PRT.industries.Top5IndustryInvestGovernmentAndDefence',
        self:: IndustryIfoExportEducation              => 'report.PRT.industries.Top5IndustryInvestEducation',
        self:: IndustryIfoExportHealthCare             => 'report.PRT.industries.Top5IndustryInvestHealthCare',
        self:: IndustryIfoExportArtsAndEntertainment   => 'report.PRT.industries.Top5IndustryInvestArtsAndEntertainment',
        self:: IndustryIfoExportOther                  => 'report.PRT.industries.Top5IndustryInvestOther',
        self:: IndustryIfoExportHouseHold              => 'report.PRT.industries.Top5IndustryInvestHouseHold',
        self:: IndustryIfoExportExtraterritorial       => 'report.PRT.industries.Top5IndustryInvestExtraterritorial',
        self:: IndustryIfoExportMining                 => 'report.PRT.industries.Top5IndustryInvestMining',
        self:: IndustryIfoExportManufacture            => 'report.PRT.industries.Top5IndustryInvestManufacture',
        self:: IndustryIfoExportSupply                 => 'report.PRT.industries.Top5IndustryInvestSupply',
        self:: IndustryIfoExportWaste                  => 'report.PRT.industries.Top5IndustryInvestWaste',

        self:: Top5IndustryInvestIndustrial             => 'report.PRT.industries.Top5IndustryInvestIndustrial',
        self:: Top5IndustryInvestForestAndFishing       => 'report.PRT.industries.Top5IndustryInvestForestAndFishing',
        self:: Top5IndustryInvestBuild                  => 'report.PRT.industries.Top5IndustryInvestBuild',
        self:: Top5IndustryInvestTradeAndRepair         => 'report.PRT.industries.Top5IndustryInvestTradeAndRepair',
        self:: Top5IndustryInvestLogistic               => 'report.PRT.industries.Top5IndustryInvestLogistic',
        self:: Top5IndustryInvestAccommodationAndFood   => 'report.PRT.industries.Top5IndustryInvestAccommodationAndFood',
        self:: Top5IndustryInvestInformAndCommunication => 'report.PRT.industries.Top5IndustryInvestInformAndCommunication',
        self:: Top5IndustryInvestFinanceAndInsurance    => 'report.PRT.industries.Top5IndustryInvestFinanceAndInsurance',
        self:: Top5IndustryInvestRealEstate             => 'report.PRT.industries.Top5IndustryInvestRealEstate',
        self:: Top5IndustryInvestScience                => 'report.PRT.industries.Top5IndustryInvestScience',
        self:: Top5IndustryInvestAdministrateAndSupport => 'report.PRT.industries.Top5IndustryInvestAdministrateAndSupport',
        self:: Top5IndustryInvestGovernmentAndDefence   => 'report.PRT.industries.Top5IndustryInvestGovernmentAndDefence',
        self:: Top5IndustryInvestEducation              => 'report.PRT.industries.Top5IndustryInvestEducation',
        self:: Top5IndustryInvestHealthCare             => 'report.PRT.industries.Top5IndustryInvestHealthCare',
        self:: Top5IndustryInvestArtsAndEntertainment   => 'report.PRT.industries.Top5IndustryInvestArtsAndEntertainment',
        self:: Top5IndustryInvestOther                  => 'report.PRT.industries.Top5IndustryInvestOther',
        self:: Top5IndustryInvestHouseHold              => 'report.PRT.industries.Top5IndustryInvestHouseHold',
        self:: Top5IndustryInvestExtraterritorial       => 'report.PRT.industries.Top5IndustryInvestExtraterritorial',
        self:: Top5IndustryInvestMining                 => 'report.PRT.industries.Top5IndustryInvestMining',
        self:: Top5IndustryInvestManufacture            => 'report.PRT.industries.Top5IndustryInvestManufacture',
        self:: Top5IndustryInvestSupply                 => 'report.PRT.industries.Top5IndustryInvestSupply',
        self:: Top5IndustryInvestWaste                  => 'report.PRT.industries.Top5IndustryInvestWaste',
    ];

    public const IndustryIds = [
        self::IndustryIfoIndustryIndustrial             => 741340,
        self::IndustryIfoIndustryForestAndFishing       => 447173,
        self::IndustryIfoIndustryBuild                  => 448148,
        self::IndustryIfoIndustryTradeAndRepair         => 448215,
        self::IndustryIfoIndustryLogistic               => 448475,
        self::IndustryIfoIndustryAccommodationAndFood   => 448558,
        self::IndustryIfoIndustryInformAndCommunication => 448585,
        self::IndustryIfoIndustryFinanceAndInsurance    => 448658,
        self::IndustryIfoIndustryRealEstate             => 448714,
        self::IndustryIfoIndustryScience                => 448728,
        self::IndustryIfoIndustryAdministrateAndSupport => 448797,
        self::IndustryIfoIndustryGovernmentAndDefence   => 448889,
        self::IndustryIfoIndustryEducation              => 448918,
        self::IndustryIfoIndustryHealthCare             => 448950,
        self::IndustryIfoIndustryArtsAndEntertainment   => 448991,
        self::IndustryIfoIndustryOther                  => 449040,
        self::IndustryIfoIndustryHouseHold              => 449097,
        //        self::IndustryIfoIndustryExtraterritorial       => 449109,
        //        self::IndustryIfoIndustryMining                 => 447279,
        //        self::IndustryIfoIndustryManufacture            => 447346,
        //        self::IndustryIfoIndustrySupply                 => 448090,
        //        self::IndustryIfoIndustryWaste                  => 448117,

        self:: IndustryIfoExportIndustrial             => 741340,
        self:: IndustryIfoExportForestAndFishing       => 447173,
        self:: IndustryIfoExportBuild                  => 448148,
        self:: IndustryIfoExportTradeAndRepair         => 448215,
        self:: IndustryIfoExportLogistic               => 448475,
        self:: IndustryIfoExportAccommodationAndFood   => 448558,
        self:: IndustryIfoExportInformAndCommunication => 448585,
        self:: IndustryIfoExportFinanceAndInsurance    => 448658,
        self:: IndustryIfoExportRealEstate             => 448714,
        self:: IndustryIfoExportScience                => 448728,
        self:: IndustryIfoExportAdministrateAndSupport => 448797,
        self:: IndustryIfoExportGovernmentAndDefence   => 448889,
        self:: IndustryIfoExportEducation              => 448918,
        self:: IndustryIfoExportHealthCare             => 448950,
        self:: IndustryIfoExportArtsAndEntertainment   => 448991,
        self:: IndustryIfoExportOther                  => 449040,
        self:: IndustryIfoExportHouseHold              => 449097,
        //        self:: IndustryIfoExportExtraterritorial       => 449109,
        //        self:: IndustryIfoExportMining                 => 447279,
        //        self:: IndustryIfoExportManufacture            => 447346,
        //        self:: IndustryIfoExportSupply                 => 448090,
        //        self:: IndustryIfoExportWaste                  => 448117,

        self:: Top5IndustryInvestIndustrial             => 741340,
        self:: Top5IndustryInvestForestAndFishing       => 447173,
        self:: Top5IndustryInvestBuild                  => 448148,
        self:: Top5IndustryInvestTradeAndRepair         => 448215,
        self:: Top5IndustryInvestLogistic               => 448475,
        self:: Top5IndustryInvestAccommodationAndFood   => 448558,
        self:: Top5IndustryInvestInformAndCommunication => 448585,
        self:: Top5IndustryInvestFinanceAndInsurance    => 448658,
        self:: Top5IndustryInvestRealEstate             => 448714,
        self:: Top5IndustryInvestScience                => 448728,
        self:: Top5IndustryInvestAdministrateAndSupport => 448797,
        self:: Top5IndustryInvestGovernmentAndDefence   => 448889,
        self:: Top5IndustryInvestEducation              => 448918,
        self:: Top5IndustryInvestHealthCare             => 448950,
        self:: Top5IndustryInvestArtsAndEntertainment   => 448991,
        self:: Top5IndustryInvestOther                  => 449040,
        self:: Top5IndustryInvestHouseHold              => 449097,
        //        self:: Top5IndustryInvestExtraterritorial       => 449109,
        //        self:: Top5IndustryInvestMining                 => 447279,
        //        self:: Top5IndustryInvestManufacture            => 447346,
        //        self:: Top5IndustryInvestSupply                 => 448090,
        //        self:: Top5IndustryInvestWaste                  => 448117,
    ];

    public const DisabledIndustry = [
        self::IndustryIfoIndustryExtraterritorial,
        self::IndustryIfoIndustryMining,
        self::IndustryIfoIndustryManufacture,
        self::IndustryIfoIndustrySupply,
        self::IndustryIfoIndustryWaste,
        self:: IndustryIfoExportExtraterritorial,
        self:: IndustryIfoExportMining,
        self:: IndustryIfoExportManufacture,
        self:: IndustryIfoExportSupply,
        self:: IndustryIfoExportWaste,
        self:: Top5IndustryInvestExtraterritorial,
        self:: Top5IndustryInvestMining,
        self:: Top5IndustryInvestManufacture,
        self:: Top5IndustryInvestSupply,
        self:: Top5IndustryInvestWaste,
    ];

    public const Top5IndustryIfoList = [
        self::IndustryIfoIndustryIndustrial,
        self::IndustryIfoIndustryForestAndFishing,
        self::IndustryIfoIndustryBuild,
        self::IndustryIfoIndustryTradeAndRepair,
        self::IndustryIfoIndustryLogistic,
        self::IndustryIfoIndustryAccommodationAndFood,
        self::IndustryIfoIndustryInformAndCommunication,
        self::IndustryIfoIndustryFinanceAndInsurance,
        self::IndustryIfoIndustryRealEstate,
        self::IndustryIfoIndustryScience,
        self::IndustryIfoIndustryAdministrateAndSupport,
        self::IndustryIfoIndustryGovernmentAndDefence,
        self::IndustryIfoIndustryEducation,
        self::IndustryIfoIndustryHealthCare,
        self::IndustryIfoIndustryArtsAndEntertainment,
        self::IndustryIfoIndustryOther,
        self::IndustryIfoIndustryHouseHold,
        //        self::IndustryIfoIndustryExtraterritorial,
        //        self::IndustryIfoIndustryMining,
        //        self::IndustryIfoIndustryManufacture,
        //        self::IndustryIfoIndustrySupply,
        //        self::IndustryIfoIndustryWaste,
    ];

    public const Top5ExportList = [
        self:: IndustryIfoExportIndustrial,
        self:: IndustryIfoExportForestAndFishing,
        self:: IndustryIfoExportBuild,
        self:: IndustryIfoExportTradeAndRepair,
        self:: IndustryIfoExportLogistic,
        self:: IndustryIfoExportAccommodationAndFood,
        self:: IndustryIfoExportInformAndCommunication,
        self:: IndustryIfoExportFinanceAndInsurance,
        self:: IndustryIfoExportRealEstate,
        self:: IndustryIfoExportScience,
        self:: IndustryIfoExportAdministrateAndSupport,
        self:: IndustryIfoExportGovernmentAndDefence,
        self:: IndustryIfoExportEducation,
        self:: IndustryIfoExportHealthCare,
        self:: IndustryIfoExportArtsAndEntertainment,
        self:: IndustryIfoExportOther,
        self:: IndustryIfoExportHouseHold,
        //        self:: IndustryIfoExportExtraterritorial,
        //        self:: IndustryIfoExportMining,
        //        self:: IndustryIfoExportManufacture,
        //        self:: IndustryIfoExportSupply,
        //        self:: IndustryIfoExportWaste,
    ];

    public const Top5InvestList = [
        self:: Top5IndustryInvestIndustrial,
        self:: Top5IndustryInvestForestAndFishing,
        self:: Top5IndustryInvestBuild,
        self:: Top5IndustryInvestTradeAndRepair,
        self:: Top5IndustryInvestLogistic,
        self:: Top5IndustryInvestAccommodationAndFood,
        self:: Top5IndustryInvestInformAndCommunication,
        self:: Top5IndustryInvestFinanceAndInsurance,
        self:: Top5IndustryInvestRealEstate,
        self:: Top5IndustryInvestScience,
        self:: Top5IndustryInvestAdministrateAndSupport,
        self:: Top5IndustryInvestGovernmentAndDefence,
        self:: Top5IndustryInvestEducation,
        self:: Top5IndustryInvestHealthCare,
        self:: Top5IndustryInvestArtsAndEntertainment,
        self:: Top5IndustryInvestOther,
        self:: Top5IndustryInvestHouseHold,
        //        self:: Top5IndustryInvestExtraterritorial,
        //        self:: Top5IndustryInvestMining,
        //        self:: Top5IndustryInvestManufacture,
        //        self:: Top5IndustryInvestSupply,
        //        self:: Top5IndustryInvestWaste,
    ];

    public const ApiRatios = [
        self::NonResourceExportGrowthFact,
        self::MainCapitalInvestmentsFact,
        self::IfoProcessingIndustrialDynamic,
        self::MainCapitalInvestmentsInvestmentsDynamic,

        self::IndustryIfoIndustryIndustrial,
        self::IndustryIfoIndustryForestAndFishing,
        self::IndustryIfoIndustryBuild,
        self::IndustryIfoIndustryTradeAndRepair,
        self::IndustryIfoIndustryLogistic,
        self::IndustryIfoIndustryAccommodationAndFood,
        self::IndustryIfoIndustryInformAndCommunication,
        self::IndustryIfoIndustryFinanceAndInsurance,
        self::IndustryIfoIndustryRealEstate,
        self::IndustryIfoIndustryScience,
        self::IndustryIfoIndustryAdministrateAndSupport,
        self::IndustryIfoIndustryGovernmentAndDefence,
        self::IndustryIfoIndustryEducation,
        self::IndustryIfoIndustryHealthCare,
        self::IndustryIfoIndustryArtsAndEntertainment,
        self::IndustryIfoIndustryOther,
        self::IndustryIfoIndustryHouseHold,
        //        self::IndustryIfoIndustryExtraterritorial,
        //        self::IndustryIfoIndustryMining,
        //        self::IndustryIfoIndustryManufacture,
        //        self::IndustryIfoIndustrySupply,
        //        self::IndustryIfoIndustryWaste,

        self::IndustryIfoExportIndustrial,
        self::IndustryIfoExportForestAndFishing,
        self::IndustryIfoExportBuild,
        self::IndustryIfoExportTradeAndRepair,
        self::IndustryIfoExportLogistic,
        self::IndustryIfoExportAccommodationAndFood,
        self::IndustryIfoExportInformAndCommunication,
        self::IndustryIfoExportFinanceAndInsurance,
        self::IndustryIfoExportRealEstate,
        self::IndustryIfoExportScience,
        self::IndustryIfoExportAdministrateAndSupport,
        self::IndustryIfoExportGovernmentAndDefence,
        self::IndustryIfoExportEducation,
        self::IndustryIfoExportHealthCare,
        self::IndustryIfoExportArtsAndEntertainment,
        self::IndustryIfoExportOther,
        self::IndustryIfoExportHouseHold,
        //        self::IndustryIfoExportExtraterritorial,
        //        self::IndustryIfoExportMining,
        //        self::IndustryIfoExportManufacture,
        //        self::IndustryIfoExportSupply,
        //        self::IndustryIfoExportWaste,

        self::Top5IndustryInvestIndustrial,
        self::Top5IndustryInvestForestAndFishing,
        self::Top5IndustryInvestBuild,
        self::Top5IndustryInvestTradeAndRepair,
        self::Top5IndustryInvestLogistic,
        self::Top5IndustryInvestAccommodationAndFood,
        self::Top5IndustryInvestInformAndCommunication,
        self::Top5IndustryInvestFinanceAndInsurance,
        self::Top5IndustryInvestRealEstate,
        self::Top5IndustryInvestScience,
        self::Top5IndustryInvestAdministrateAndSupport,
        self::Top5IndustryInvestGovernmentAndDefence,
        self::Top5IndustryInvestEducation,
        self::Top5IndustryInvestHealthCare,
        self::Top5IndustryInvestArtsAndEntertainment,
        self::Top5IndustryInvestOther,
        self::Top5IndustryInvestHouseHold,
        //        self::Top5IndustryInvestExtraterritorial,
        //        self::Top5IndustryInvestMining,
        //        self::Top5IndustryInvestManufacture,
        //        self::Top5IndustryInvestSupply,
        //        self::Top5IndustryInvestWaste,
    ];

    public const RatioNames = [
        self::PhysicalVolumeIndexProcessingIndustrialPlan => 'report.PRT.fields.PhysicalVolumeIndexProcessingIndustrialPlan',
        self::PhysicalVolumeIndexProcessingIndustrialFact => 'report.PRT.fields.PhysicalVolumeIndexProcessingIndustrialFact',
        self::NonResourceExportGrowthPlan                 => 'report.PRT.fields.NonResourceExportGrowthPlan',
        self::NonResourceExportGrowthFact                 => 'report.PRT.fields.NonResourceExportGrowthFact',
        self::MainCapitalInvestmentsPlan                  => 'report.PRT.fields.MainCapitalInvestmentsPlan',
        self::MainCapitalInvestmentsPlanAmount            => 'report.PRT.fields.MainCapitalInvestmentsPlanAmount',
        self::MainCapitalInvestmentsFact                  => 'report.PRT.fields.MainCapitalInvestmentsFact',
        self::IfoProcessingIndustrialDynamic              => 'report.PRT.fields.IfoProcessingIndustrialDynamic',
        self::NonResourceExportDynamic                    => 'report.PRT.fields.NonResourceExportDynamic',
        self::MainCapitalInvestmentsInvestmentsDynamic    => 'report.PRT.fields.MainCapitalInvestmentsInvestmentsDynamic',
        self::Top5IndustryIfoUp                           => 'report.PRT.fields.Top5IndustryIfoUp',
        self::Top5IndustryIfoDown                         => 'report.PRT.fields.Top5IndustryIfoDown',
        self::IndustryIfoIndustryIndustrial               => 'report.PRT.fields.IndustryIfoIndustryIndustrial',
        self::IndustryIfoIndustryForestAndFishing         => 'report.PRT.fields.IndustryIfoIndustryForestAndFishing',
        self::IndustryIfoIndustryBuild                    => 'report.PRT.fields.IndustryIfoIndustryBuild',
        self::IndustryIfoIndustryTradeAndRepair           => 'report.PRT.fields.IndustryIfoIndustryTradeAndRepair',
        self::IndustryIfoIndustryLogistic                 => 'report.PRT.fields.IndustryIfoIndustryLogistic',
        self::IndustryIfoIndustryAccommodationAndFood     => 'report.PRT.fields.IndustryIfoIndustryAccommodationAndFood',
        self::IndustryIfoIndustryInformAndCommunication   => 'report.PRT.fields.IndustryIfoIndustryInformAndCommunication',
        self::IndustryIfoIndustryFinanceAndInsurance      => 'report.PRT.fields.IndustryIfoIndustryFinanceAndInsurance',
        self::IndustryIfoIndustryRealEstate               => 'report.PRT.fields.IndustryIfoIndustryRealEstate',
        self::IndustryIfoIndustryScience                  => 'report.PRT.fields.IndustryIfoIndustryScience',
        self::IndustryIfoIndustryAdministrateAndSupport   => 'report.PRT.fields.IndustryIfoIndustryAdministrateAndSupport',
        self::IndustryIfoIndustryGovernmentAndDefence     => 'report.PRT.fields.IndustryIfoIndustryGovernmentAndDefence',
        self::IndustryIfoIndustryEducation                => 'report.PRT.fields.IndustryIfoIndustryEducation',
        self::IndustryIfoIndustryHealthCare               => 'report.PRT.fields.IndustryIfoIndustryHealthCare',
        self::IndustryIfoIndustryArtsAndEntertainment     => 'report.PRT.fields.IndustryIfoIndustryArtsAndEntertainment',
        self::IndustryIfoIndustryOther                    => 'report.PRT.fields.IndustryIfoIndustryOther',
        self::IndustryIfoIndustryHouseHold                => 'report.PRT.fields.IndustryIfoIndustryHouseHold',
        self::IndustryIfoIndustryExtraterritorial         => 'report.PRT.fields.IndustryIfoIndustryExtraterritorial',
        self::IndustryIfoIndustryMining                   => 'report.PRT.fields.IndustryIfoIndustryMining',
        self::IndustryIfoIndustryManufacture              => 'report.PRT.fields.IndustryIfoIndustryManufacture',
        self::IndustryIfoIndustrySupply                   => 'report.PRT.fields.IndustryIfoIndustrySupply',
        self::IndustryIfoIndustryWaste                    => 'report.PRT.fields.IndustryIfoIndustryWaste',
        self::Top5IndustryExportIfoUp                     => 'report.PRT.fields.Top5IndustryExportIfoUp',
        self::Top5IndustryExportIfoDown                   => 'report.PRT.fields.Top5IndustryExportIfoDown',
        self::IndustryIfoExportIndustrial                 => 'report.PRT.fields.IndustryIfoExportIndustrial',
        self::IndustryIfoExportForestAndFishing           => 'report.PRT.fields.IndustryIfoExportForestAndFishing',
        self::IndustryIfoExportBuild                      => 'report.PRT.fields.IndustryIfoExportBuild',
        self::IndustryIfoExportTradeAndRepair             => 'report.PRT.fields.IndustryIfoExportTradeAndRepair',
        self::IndustryIfoExportLogistic                   => 'report.PRT.fields.IndustryIfoExportLogistic',
        self::IndustryIfoExportAccommodationAndFood       => 'report.PRT.fields.IndustryIfoExportAccommodationAndFood',
        self::IndustryIfoExportInformAndCommunication     => 'report.PRT.fields.IndustryIfoExportInformAndCommunication',
        self::IndustryIfoExportFinanceAndInsurance        => 'report.PRT.fields.IndustryIfoExportFinanceAndInsurance',
        self::IndustryIfoExportRealEstate                 => 'report.PRT.fields.IndustryIfoExportRealEstate',
        self::IndustryIfoExportScience                    => 'report.PRT.fields.IndustryIfoExportScience',
        self::IndustryIfoExportAdministrateAndSupport     => 'report.PRT.fields.IndustryIfoExportAdministrateAndSupport',
        self::IndustryIfoExportGovernmentAndDefence       => 'report.PRT.fields.IndustryIfoExportGovernmentAndDefence',
        self::IndustryIfoExportEducation                  => 'report.PRT.fields.IndustryIfoExportEducation',
        self::IndustryIfoExportHealthCare                 => 'report.PRT.fields.IndustryIfoExportHealthCare',
        self::IndustryIfoExportArtsAndEntertainment       => 'report.PRT.fields.IndustryIfoExportArtsAndEntertainment',
        self::IndustryIfoExportOther                      => 'report.PRT.fields.IndustryIfoExportOther',
        self::IndustryIfoExportHouseHold                  => 'report.PRT.fields.IndustryIfoExportHouseHold',
        self::IndustryIfoExportExtraterritorial           => 'report.PRT.fields.IndustryIfoExportExtraterritorial',
        self::IndustryIfoExportMining                     => 'report.PRT.fields.IndustryIfoExportMining',
        self::IndustryIfoExportManufacture                => 'report.PRT.fields.IndustryIfoExportManufacture',
        self::IndustryIfoExportSupply                     => 'report.PRT.fields.IndustryIfoExportSupply',
        self::IndustryIfoExportWaste                      => 'report.PRT.fields.IndustryIfoExportWaste',
        self::Top5IndustryInvestUp                        => 'report.PRT.fields.Top5IndustryInvestUp',
        self::Top5IndustryInvestDown                      => 'report.PRT.fields.Top5IndustryInvestDown',
        self::Top5IndustryInvestIndustrial                => 'report.PRT.fields.Top5IndustryInvestIndustrial',
        self::Top5IndustryInvestForestAndFishing          => 'report.PRT.fields.Top5IndustryInvestForestAndFishing',
        self::Top5IndustryInvestBuild                     => 'report.PRT.fields.Top5IndustryInvestBuild',
        self::Top5IndustryInvestTradeAndRepair            => 'report.PRT.fields.Top5IndustryInvestTradeAndRepair',
        self::Top5IndustryInvestLogistic                  => 'report.PRT.fields.Top5IndustryInvestLogistic',
        self::Top5IndustryInvestAccommodationAndFood      => 'report.PRT.fields.Top5IndustryInvestAccommodationAndFood',
        self::Top5IndustryInvestInformAndCommunication    => 'report.PRT.fields.Top5IndustryInvestInformAndCommunication',
        self::Top5IndustryInvestFinanceAndInsurance       => 'report.PRT.fields.Top5IndustryInvestFinanceAndInsurance',
        self::Top5IndustryInvestRealEstate                => 'report.PRT.fields.Top5IndustryInvestRealEstate',
        self::Top5IndustryInvestScience                   => 'report.PRT.fields.Top5IndustryInvestScience',
        self::Top5IndustryInvestAdministrateAndSupport    => 'report.PRT.fields.Top5IndustryInvestAdministrateAndSupport',
        self::Top5IndustryInvestGovernmentAndDefence      => 'report.PRT.fields.Top5IndustryInvestGovernmentAndDefence',
        self::Top5IndustryInvestEducation                 => 'report.PRT.fields.Top5IndustryInvestEducation',
        self::Top5IndustryInvestHealthCare                => 'report.PRT.fields.Top5IndustryInvestHealthCare',
        self::Top5IndustryInvestArtsAndEntertainment      => 'report.PRT.fields.Top5IndustryInvestArtsAndEntertainment',
        self::Top5IndustryInvestOther                     => 'report.PRT.fields.Top5IndustryInvestOther',
        self::Top5IndustryInvestHouseHold                 => 'report.PRT.fields.Top5IndustryInvestHouseHold',
        self::Top5IndustryInvestExtraterritorial          => 'report.PRT.fields.Top5IndustryInvestExtraterritorial',
        self::Top5IndustryInvestMining                    => 'report.PRT.fields.Top5IndustryInvestMining',
        self::Top5IndustryInvestManufacture               => 'report.PRT.fields.Top5IndustryInvestManufacture',
        self::Top5IndustryInvestSupply                    => 'report.PRT.fields.Top5IndustryInvestSupply',
        self::Top5IndustryInvestWaste                     => 'report.PRT.fields.Top5IndustryInvestWaste',
    ];

    public const PlainRatios = [
        self::PhysicalVolumeIndexProcessingIndustrialFact => 'physicalVolumeIndexIndustrialProductionFact',
        self::PhysicalVolumeIndexProcessingIndustrialPlan => 'physicalVolumeIndexIndustrialProductionPlan',
        self::NonResourceExportGrowthFact                 => 'physicalVolumeIndexExportVolumeFact',
        self::NonResourceExportGrowthPlan                 => 'physicalVolumeIndexExportVolumePlan',
        self::MainCapitalInvestmentsPlan                  => 'physicalVolumeIndexInvectPlan',
    ];

}
