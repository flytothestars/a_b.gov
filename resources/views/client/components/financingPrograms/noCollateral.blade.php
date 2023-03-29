<div class="banner">
    <div class="pt-4">
        <div class="container">
            <div class=" row ">
                @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.financingPrograms.financingPrograms'])

                <div class="service-banner text-decoration-none text-dark mt-4 w-150 FinancialServicesStyle ">
                    <div class="col-lg-6 service-banner__info col-12">
                        <div class="service-banner__title">
                        <h3>
                            @lang('messages.pages.financingPrograms.unsecuredLending')
                        </h3>
                        </div>
                        <div class="service-banner__text mt-3 ">
                            <div class="font-bold">@lang('messages.pages.financingPrograms.loanAmount')</div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.from100000To6000000Tenge')
                                </li>
                            </ul>
                            <div class="font-bold">@lang('messages.pages.financingPrograms.loanTerms')</div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.from3To24Months')
                                </li>
                            </ul>
                            <div class="font-bold">@lang('messages.pages.financingPrograms.remunerationRate')</div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.12PerAnnum')
                                </li>
                            </ul>
                        </div>
                        <div class="pt-5">
                            <a class="btn primary text-white w-50 me-4" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
                        </div>
                    </div>
                    <div class="service-banner__image col-lg-6 col-12" >
                    <img class=""  width="664" src="{{asset('/images/financingSelection/2.png')}}" alt="">
                    <!-- <div class="col-12" id="FinancialServices">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <div class="no-overflow pt-4 pb-4">
        <div class="header">@lang('messages.pages.financingPrograms.operator')</div>
        <div class=" pt-4 font-md">
            <div class="font-md">
                @lang('messages.pages.financingPrograms.MicrofinanceOrganizationAlmaty')
            </div>
        </div>
    </div>
    <hr>

    <div class="no-overflow pt-4 pb-4">
        <div class="header">@lang('messages.pages.financingPrograms.description')</div>
        <div class=" pt-4 font-md">
            <div> @lang('messages.pages.financingPrograms.territorialAffiliationTheCityOfAlmaty')</div>
            <div> @lang('messages.pages.financingPrograms.collateralNotRequired') </div>
            <div> @lang('messages.pages.financingPrograms.subjectsOfCreditingOperatingSMEsIEInAlmatyWithAPeriodOfRegistrationAndEntrepreneurialActivityOfAtLeast6Months')
            </div>
            @lang('messages.pages.financingPrograms.content6')
<!-- test -->
            <div class="font-bold mt-4">@lang('messages.pages.financingPrograms.specialPurpose')</div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.forThePurchaseOfFixedAssets') </li>
                <li>@lang('messages.pages.financingPrograms.toReplenishWorkingCapital')</li>
                <li>@lang('messages.pages.financingPrograms.refinancingOfExistingLiabilitiesInOtherFinancialInstitutionsIsProhibited') </li>
            </ul>

            <div class="font-bold mt-4">@lang('messages.pages.financingPrograms.MFOAlmatyDoesNotFinance')</div>
            <div>@lang('messages.pages.financingPrograms.purchaseOfNewOrUsedLightVehiclesWithTheExceptionOfVehiclesWithAVanTypeBody')

                <br>@lang('messages.pages.financingPrograms.acquisitionOfRealEstateAndLandPlotsConstructionOfResidentialRealEstateThePurposeOfWhichIsNotRelatedToEntrepreneurialActivity') <br>
                @lang('messages.pages.financingPrograms.acquisitionOfAnOperatingBusiness')
            </div>

            <div class="font-bold mt-4">@lang('messages.pages.financingPrograms.additionalConditions')</div>
            <div>
                @lang('messages.pages.financingPrograms.borrowerSLifeInsuranceForTheEntireTermOfTheLoan') <br>
                @lang('messages.pages.financingPrograms.itIsNotAllowedToIssueTwoOrMoreUnsecuredMicrocreditsToOneBorrower')
            </div>
        </div>
    </div>
    <hr>
    <div class="no-overflow pt-4 pb-4">
        <div class="header">@lang('messages.pages.financingPrograms.documents')</div>
        <div class=" pt-4 font-md">
            <div class="font-bold">@lang('messages.pages.financingPrograms.primaryListOfDocuments')
            </div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.legalStatusDocumentsConfirmingTheIdentityAndRegistrationOfAnIndividualEntrepreneur')
                </li>
                <li>@lang('messages.pages.financingPrograms.certificatesFromServicingBanksAboutTheAvailabilityOfBankAccountsAndAboutMonthlyTurnoverForTheLastTwelveMonths')
                </li>
                <li>@lang('messages.pages.financingPrograms.incomeTaxReturns')
                </li>
                <li>@lang('messages.pages.financingPrograms.licensesToCarryOutLicensedActivitiesIfAny')
                </li>
            </ul>
        </div>
    </div>

</div>