<div class="banner">
    <div class="pt-4">
        <div class="container">
            <div class=" row ">
                @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.financingPrograms.financingPrograms'])

                <div class="service-banner text-decoration-none text-dark mt-4 w-150 FinancialServicesStyle ">
                    <div class="col-lg-6 service-banner__info col-12">
                        <div class="service-banner__title">
                        <h3>
                        @lang('messages.pages.financingPrograms.innovativeGrantsWithinTheFrameworkOfTheStateBusinessSupportAndDevelopmentProgramBusinessRoadmap2025')
                        </h3>
                        </div>
                        <div class="service-banner__text mt-3 ">
                            <div class="font-bold">@lang('messages.pages.financingPrograms.stateGrantAmount')</div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.from2To5MillionTenge') </li>
                            </ul>
                            <div class="font-bold">@lang('messages.pages.financingPrograms.businessProjectImplementationPeriod') </div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.noMoreThan18Months')</li>
                            </ul>
                        </div>
                        <div class="pt-5">
                            <a class="btn primary text-white" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
                        </div>
                    </div>
                    <div class="service-banner__image col-lg-6 col-12" >
                        <img class=""  width="664" src="{{asset('/images/financingSelection/1.png')}}" alt="">
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
        <div class="header">@lang('messages.pages.financingPrograms.conditions')</div>
        <div class="font-md">
            <div class="font-bold">@lang('messages.pages.financingPrograms.conditionsForReceiving') </div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.innovativenessOfTheProjectFromTheListOfPrioritySectorsOfTheEconomyTheRequirement')
                </li>
                <li>@lang('messages.pages.financingPrograms.coFinancingOfProjectImplementationCostsInTheAmountOfAtLeast10OfTheVolumeOfTheStateGrantProvided')
                </li>
                <li>@lang('messages.pages.financingPrograms.creationOfNewJobs') </li>
                <li>@lang('messages.pages.financingPrograms.thePresenceOfABusinessProjectOfAnEntrepreneur') </li>
            </ul>

            <div class="font-bold">@lang('messages.pages.financingPrograms.purposeOfUsingStateGrantFunds')</div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.purchaseOfFixedAssetsRawMaterialsAndMaterials') а товаров
                    или оказания услуг;
                </li>
                <li>@lang('messages.pages.financingPrograms.acquisitionOfIntangibleAssets') </li>
                <li>@lang('messages.pages.financingPrograms.technologyAcquisition') </li>
                <li>@lang('messages.pages.financingPrograms.acquisitionOfRightsToAComplexEntrepreneurialLicenseFranchising') </li>
                <li>@lang('messages.pages.financingPrograms.costsAssociatedWithResearchAndOrTheIntroductionOfNewTechnologies')
                </li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="no-overflow pt-4 pb-4">
        <div class="header"> @lang('messages.pages.financingPrograms.documents')</div>
        <div class=" pt-4 font-md">
            <div class="font-bold">@lang('messages.pages.financingPrograms.listOfDocuments')</div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.copyOfTheApplicantSIdentityDocument') </li>
                <li>@lang('messages.pages.financingPrograms.applicationForParticipationInTheCompetitiveSelectionForTheProvisionOfStateGrants')
                </li>
                <li>@lang('messages.pages.financingPrograms.businessProjectPreparedInTheFormOfABusinessPlan') </li>
                <li>@lang('messages.pages.financingPrograms.certificateOfAbsenceOfArrearsOnObligatoryPaymentsToTheBudgetIssuedNoLaterThan30CalendarDays')
                </li>
                <li>@lang('messages.pages.financingPrograms.certificateOfTheAverageNumberOfEmployeesAtTheTimeOfFilingTheApplication')
                </li>
                <li>@lang('messages.pages.financingPrograms.aDocumentConfirmingThatTheApplicantHasAStatusOfAttributionToSociallyVulnerableGroupsOfThePopulation')
                </li>
                <li>@lang('messages.pages.financingPrograms.aCopyOfADocumentConfirmingThatTheEntrepreneurHasCompletedTrainingUnderTheProgramAndOr')

                <li>@lang('messages.pages.financingPrograms.powerOfAttorneyForTheRightToSubmitAnApplicationOnBehalfOfAnEntrepreneurACopyOfAnAttorneySCertificate')
                </li>
                <li>@lang('messages.pages.financingPrograms.aCopyOfTheCertificateOfStateRegistrationOfALegalEntityNotificationOfRegistrationOfAnIndividualEntrepreneurDocumentsConfirmingTheAvailabilityOfCoFinancingCashMovable')
                </li>
            </ul>
        </div>
    </div>
</div>