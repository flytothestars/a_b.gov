<div class="mt-4 row text-center">
    <div class="">
        <div class="font-bold font-xl mt-3">
            @lang('messages.pages.service_tax.special_treatment.title')
        </div>
        <div class="font-md mt-3 pt-1">
            <div class="">
                @lang('messages.pages.service_tax.special_treatment.description')
            </div>

        </div>

    </div>
</div>

<div class="survey__tab_sm mt-4 pt-3 d-flex nav">
    <div id="qTextTabCondition" class="active me-4" data-bs-toggle="tab" data-bs-target="#qTextTabConditionContent"
        type="button" role="tab" aria-controls="qTextTabConditionContent" aria-selected="true">
        @lang('messages.pages.financingPrograms.conditions')
    </div>
</div>

<hr class="text-black mb-5" />

<div class="tab-content">
    <div id="qTextTabConditionContent" role="tabpanel" aria-labelledby="qTextTabCondition"
        class="font-md  tab-pane fade show active">
        <div class="font-bold">@lang('messages.pages.service_tax.special_treatment.firstContentTitle')</div>
        @lang('messages.pages.service_tax.special_treatment.firstContent')
        <br>
        <div class="font-bold">@lang('messages.pages.service_tax.special_treatment.secondContentTitle')</div>
        @lang('messages.pages.service_tax.special_treatment.secondContent')
    </div>
</div>
<div class="text-end"></div>