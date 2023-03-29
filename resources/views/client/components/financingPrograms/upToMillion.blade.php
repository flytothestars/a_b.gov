<div class="banner">
    <div class="pt-4">
        <div class="container">
            <div class=" row ">
                @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.financingPrograms.financingPrograms'])

                <div class="service-banner text-decoration-none text-dark mt-4 w-100 FinancialServicesStyle ">
                    <div class="col-lg-6 service-banner__info col-12">
                        <div class="service-banner__title">
                        <h3>
                        @lang('messages.pages.financingPrograms.programConcessionalLendingUpTo58MillionTenge')</span>
</h3>
                        </div>
                        <div class="service-banner__text mt-3 ">
                            <div class="font-bold">@lang('messages.pages.financingPrograms.RemunerationRate')</div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.2ForLowIncomeFamiliesWithManyChildrenDisabledPeopleOfIAndIIGroupsFamiliesRaisingDisabledChildrenAndResidentsOfIndustrialParksSecond')
                                </li>
                                <li>@lang('messages.pages.financingPrograms.6ForAllOtherCategoriesOfBorrowers')
                                </li>
                            </ul>
                        </div>
                        <div class="pt-5">
                            <a class="btn primary text-white" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
                        </div>
                    </div>
                    <div class="service-banner__image col-lg-6 col-12" >
                    <img class="" width="664" src="{{asset('/images/financingSelection/4.png')}}" alt="">
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
            <div class="font-md">
                <div>@lang('messages.pages.financingPrograms.TheMicrocreditingProgramOfMFOAlmatyLLPIsBeingImplementedWithinTheFrameworkOfTheAlmatyBusiness2025')
                </div>

                <div class="font-bold mt-4">
                    @lang('messages.pages.financingPrograms.PrimaryOccupation')
                </div>
                <div>
                    @lang('messages.pages.financingPrograms.ProvidingMicrocreditsForSMEsIndividualsAndLegalEntitiesInTheAmountOfUpTo20000MCI')
                </div>

                    <div class=" mt-4">@lang('messages.pages.financingPrograms.LendingIsProvidedOnTheTermsOfUrgencyRepaymentPaymentSecurityAndTargetedUseForSMEsIndividualsAndLegalEntitiesRegisteredInAlmaty')
                </div>
                </br>
                @lang('messages.pages.financingPrograms.content7')

            </div>
        </div>
    </div>

</div>
