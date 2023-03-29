<div class="banner">
    <div class="pt-4">
        <div class="container">
            <div class=" row ">
                @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.financingPrograms.financingPrograms'])


                <div class="service-banner text-decoration-none text-dark mt-4 w-150 FinancialServicesStyle ">
                    <div class="col-lg-6 service-banner__info col-12">
                        <div class="service-banner__title">
                        <h3>
                        @lang('messages.pages.financingPrograms.partialGuaranteeWithinTheFrameworkOfTheStateProgramForSupportAndDevelopmentOfBusinessBusinessRoadmap2025')
                        </h3>
                        </div>
                        <div class="service-banner__text mt-3 ">
                            <div class="font-bold">@lang('messages.pages.financingPrograms.maximumGuaranteeAmount')</div>
                            <ul class="mb-0">
                                <li>@lang('messages.pages.financingPrograms.upTo85OfTheLoanAmount')</li>
                            </ul>
                        </div>
                        <div class="pt-5">
                            <a class="btn primary text-white" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
                        </div>
                    </div>
                    <div class="service-banner__image col-lg-6 col-12" >
                    <img class=""  width="664" src="{{asset('/images/financingSelection/3.png')}}" alt="">
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
        <div class="font-md">
            @lang('messages.pages.financingPrograms.since2015DamuFundHasBeenAFinancialAgentImplementingAndMonitoringFinancialSupport')
        </div>
    </div>
    <hr>
    <div class="no-overflow pt-4 pb-4">
        <div class="header">@lang('messages.pages.financingPrograms.description')</div>
        <div class=" pt-4 font-md">
            <div class="font-bold">@lang('messages.pages.financingPrograms.maximumAmount') </div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.upTo1BillionTenge')</li>
            </ul>
            <div class="font-bold mt-4">@lang('messages.pages.financingPrograms.term')</div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.noMoreThanTheLoanTerm')</li>
            </ul>
            <div class="font-bold mt-4">@lang('messages.pages.financingPrograms.purposeOfTheInvestmentLoan')
            </div>
            <ul>
                <li>@lang('messages.pages.financingPrograms.replenishmentOfWorkingCapitalRefinancing')</li>
            </ul>
        </div>
    </div>
</div>