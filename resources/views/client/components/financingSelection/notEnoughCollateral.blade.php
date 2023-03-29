<hr class="text-black my-4 "/>
<div class="mt-4 row">
    <div class="col-lg-6">
        <img class="w-100" src="{{asset('/images/financingSelection/3.png')}}" alt="">
    </div>
    <div class="col-lg-6 pt-4">
        <div class="font-bold font-xl">
        @lang('messages.pages.financingPrograms.partialGuaranteeWithinTheFrameworkOfTheStateProgramForSupportAndDevelopmentOfBusinessBusinessRoadmap2025')
        </div>
        <div class="font-md mt-3 pt-1">
            <div class="font-bold">@lang('messages.pages.financingPrograms.maximumGuaranteeAmount')</div>
            <ul class="mb-0">
                <li>@lang('messages.pages.financingPrograms.upTo85OfTheLoanAmount')</li>
            </ul>
        </div>

        <div class="text-end mt-5 pt-5">
            <a class="btn primary text-white" href='{{route('services.form', ['service_groups_id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b'])}}'>@lang('messages.action.toGetConsultation')</a>
        </div>
    </div>
</div>

<div class="survey__tab_sm mt-4 pt-3 d-flex nav">
    <div id="qTextTabOperator" class="active me-4" data-bs-toggle="tab" data-bs-target="#eTextTabOperatorContent"
         type="button" role="tab" aria-controls="eTextTabOperatorContent" aria-selected="true">
         @lang('messages.pages.financingPrograms.operator')
    </div>
    <div id="qTextTabDescription" data-bs-toggle="tab" data-bs-target="#eTextTabDescriptionContent"
         type="button"
         role="tab" aria-controls="eTextTabDescriptionContent" aria-selected="false">
         @lang('messages.pages.financingPrograms.description')
    </div>
</div>

<hr class="text-black mb-5"/>

<div class="tab-content">
    <div id="eTextTabOperatorContent" role="tabpanel" aria-labelledby="qTextTabCondition"
         class="font-md  tab-pane fade show active">

        @lang('messages.pages.financingPrograms.since2015DamuFundHasBeenAFinancialAgentImplementingAndMonitoringFinancialSupport')
    </div>

    <div id="eTextTabDescriptionContent" role="tabpanel" aria-labelledby="qTextTabDocument"
         class="font-md tab-pane fade">
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
<div class="text-end">
    <a class="btn opacity-primary text-primary" href='{{ route('services', ['types_appeal' => '-', 'service_groups' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b']) }}'>@lang('messages.action.ViewAllFinancialServices')</a>
</div>
