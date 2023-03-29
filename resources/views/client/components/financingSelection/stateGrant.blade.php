<hr class="text-black my-4 "/>
<div class="mt-4 row">
    <div class="col-lg-6">
        <img class="w-100" src="{{asset('/images/financingSelection/1.png')}}" alt="">
    </div>
    <div class="col-lg-6">
        <div class="font-bold font-xl mt-3">
        @lang('messages.pages.financingPrograms.innovativeGrantsWithinTheFrameworkOfTheStateBusinessSupportAndDevelopmentProgramBusinessRoadmap2025')
        </div>
        <div class="font-md mt-3 pt-1">
            <div class="font-bold">@lang('messages.pages.financingPrograms.stateGrantAmount')</div>
            <ul class="mb-0">
                <li>@lang('messages.pages.financingPrograms.from2To5MillionTenge') </li>
            </ul>
            <div class="font-bold">@lang('messages.pages.financingPrograms.businessProjectImplementationPeriod') </div>
            <ul class="mb-0">
                <li>@lang('messages.pages.financingPrograms.noMoreThan18Months')</li>
            </ul>
        </div>

        <div class="text-end mt-4 pt-2">
            <a class="btn primary text-white" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
        </div>
    </div>
</div>

<div class="survey__tab_sm mt-4 pt-3 d-flex nav">
    <div id="qTextTabCondition" class="active me-4" data-bs-toggle="tab" data-bs-target="#qTextTabConditionContent"
         type="button" role="tab" aria-controls="qTextTabConditionContent" aria-selected="true">
         @lang('messages.pages.financingPrograms.conditions')
    </div>
    <div id="qTextTabDocument" data-bs-toggle="tab" data-bs-target="#qTextTabDocumentContent"
         type="button"
         role="tab" aria-controls="qTextTabDocumentContent" aria-selected="false">
         @lang('messages.pages.financingPrograms.documents')
    </div>
</div>

<hr class="text-black mb-5"/>

<div class="tab-content">
    <div id="qTextTabConditionContent" role="tabpanel" aria-labelledby="qTextTabCondition"
         class="font-md  tab-pane fade show active">
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

    <div id="qTextTabDocumentContent" role="tabpanel" aria-labelledby="qTextTabDocument" class="font-md tab-pane fade">
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
<div class="text-end">
    <a class="btn opacity-primary text-primary"  href='{{ route('services', ['types_appeal' => '-', 'service_groups' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b']) }}'>@lang('messages.action.ViewAllFinancialServices')</a>
</div>
