<hr class="text-black my-4 " />
<div class="mt-4 row">
    <div class="col-lg-6">
        <img class="w-100" src="{{asset('/images/financingSelection/2.png')}}" alt="">
    </div>
    <div class="col-lg-6">
        <div class="font-bold font-xl">
            @lang('messages.pages.financingPrograms.unsecuredLending')
        </div>
        <div class="font-md mt-3 pt-1">
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

        <div class="text-end mt-5 pt-5">
            <a class="btn primary text-white w-50 me-4" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
        </div>
    </div>
</div>
<nav>
    <div class="survey__tab_sm mt-4 pt-3 d-flex nav " role="tablist">
        <div id="nTextOperatorTab" class="active me-4" data-bs-toggle="tab" data-bs-target="#nTextOperatorTabContent" type="button" role="tab" aria-controls="nTextOperatorTabContent" aria-selected="true">
            @lang('messages.pages.financingPrograms.operator')
        </div>
        <div id="nTextTabDescriptionTab" class="me-4" data-bs-toggle="tab" data-bs-target="#nTextTabDescriptionContent" type="button" role="tab" aria-controls="nTextTabDescriptionContent" aria-selected="false">
            @lang('messages.pages.financingPrograms.description')
        </div>
        <div id="nTextTabDocumentTab" data-bs-toggle="tab" data-bs-target="#nTextTabDocumentContent" type="button" role="tab" aria-controls="nTextTabDocumentContent" aria-selected="false">
            @lang('messages.pages.financingPrograms.documents')
        </div>
    </div>
</nav>
<hr class="text-black mb-5" />
<div class="tab-content">
    <div id="nTextOperatorTabContent" role="tabpanel" aria-labelledby="nTextOperatorTab" class="font-md  tab-pane fade show active">
        <div class="font-md">
            @lang('messages.pages.financingPrograms.MicrofinanceOrganizationAlmaty')
        </div>
    </div>
    <div id="nTextTabDescriptionContent" role="tabpanel" aria-labelledby="nav-profile-tab" class="font-md tab-pane fade ">
        <div> @lang('messages.pages.financingPrograms.territorialAffiliationTheCityOfAlmaty')</div>
        <div> @lang('messages.pages.financingPrograms.collateralNotRequired') </div>
        <div> @lang('messages.pages.financingPrograms.subjectsOfCreditingOperatingSMEsIEInAlmatyWithAPeriodOfRegistrationAndEntrepreneurialActivityOfAtLeast6Months')
        </div>
        <b>Ставка вознаграждения:</b> 9% годовых</br>
        <b>Сумма кредита:</b> от 100 000 до 6 000 000 тенге</br>
        <b>Срок кредитования:</b> от 3х до 24х месяцев<</br>
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
    <div id="nTextTabDocumentContent" role="tabpanel" aria-labelledby="nTextTabDocumentTab" class="font-md tab-pane  fade">
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




<div class="text-end">
    <a class="btn  opacity-primary text-primary" href='{{ route('services', ['types_appeal' => '-', 'service_groups' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b']) }}'>@lang('messages.action.ViewAllFinancialServices')</a>
</div>