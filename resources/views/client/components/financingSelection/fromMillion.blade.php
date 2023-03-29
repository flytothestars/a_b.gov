<hr class="text-black my-4 "/>
<div class="mt-4 row">
    <div class="col-lg-6">
        <img class="w-100" src="{{asset('/images/financingSelection/5.png')}}" alt="">
    </div>
    <div class="col-lg-6">
        <div class="font-bold font-xl w-75">
        @lang('messages.pages.financingPrograms.programConcessionalLendingFrom58MillionTengeTo500MillionTenge')</span>
        </div>
        <div class="font-md mt-3 pt-1">
            <div class="font-bold">@lang('messages.pages.financingPrograms.RemunerationRate')</div>
            <ul class="mb-0">
                <li>@lang('messages.pages.financingPrograms.2ForLowIncomeFamiliesWithManyChildrenDisabledPeopleOfIAndIIGroupsFamiliesRaisingDisabledChildrenAndResidentsOfIndustrialParks')
                </li>
                <li>@lang('messages.pages.financingPrograms.6ForAllOtherCategoriesOfBorrowers')
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
        <div id="fTextOperatorTab" class="active me-4" data-bs-toggle="tab" data-bs-target="#fTextOperatorTabContent"
             type="button" role="tab" aria-controls="fTextOperatorTabContent" aria-selected="true">
             @lang('messages.pages.financingPrograms.operator')
        </div>
        <div id="fTextTabDescriptionTab" class="me-4" data-bs-toggle="tab" data-bs-target="#fTextTabDescriptionContent"
             type="button"
             role="tab" aria-controls="fTextTabDescriptionContent" aria-selected="false">
             @lang('messages.pages.financingPrograms.description')
        </div>
    </div>
</nav>
<hr class="text-black mb-5"/>
<div class="tab-content">
    <div id="fTextOperatorTabContent" role="tabpanel" aria-labelledby="fTextOperatorTab"
         class="font-md  tab-pane fade show active">
        <div class="font-md">
            @lang('messages.pages.financingPrograms.AlmatyFinanceLLPIsAYoungCreditOrganizationASubsidiaryOfAlmatySocialAndEntrepreneurialCorporationJSC')
            <br><a href="http://almatyfinance.kz/" target="_blank" class="text-green">http://almatyfinance.kz/</a>
        </div>
    </div>
    <div id="fTextTabDescriptionContent" role="tabpanel" aria-labelledby="fTextTabDescriptionTab"
        class="font-md tab-pane fade ">
        
        @lang('messages.pages.financingPrograms.pogramTitle1')
            <ul>
                <li>2% — проекты, реализуемые в промышленных парках (до 70 млн тенге);</li>
                <li>6% — остальные отрасли кредитования</li>
            </ul>
            @lang('messages.pages.financingPrograms.pogramTitle2')
            <ul>
                <li>до 7 лет — направленные на инвестиции;</li>
                <li>до 3 лет — направленные на пополнение оборотных средств</li>
            </ul>
            @lang('messages.pages.financingPrograms.pogramTitle3')
            <ul>
                <li>инвестиции — строительство, ремонт, приобретение основных средств;</li>
                <li>пополнение оборотных средств (не более 100 млн тенге)</li>
            </ul>
            @lang('messages.pages.financingPrograms.pogramTitle4')    
            <ul>
                <li>движимое и недвижимое имущество (в структуре залогового обеспечения доля недвижимости должна составлять не менее 60% от суммы займа)</li>
            </ul>
            @lang('messages.pages.financingPrograms.pogramTitle5')
            <ul>
                <li>от 20 000 МРП до 500 000 000 тенге</li>
            </ul>

    </div>
</div>


<div class="text-end mt-5">
    <a class="btn  opacity-primary text-primary" href='{{ route('services', ['types_appeal' => '-', 'service_groups' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b']) }}'>@lang('messages.action.ViewAllFinancialServices')</a>
</div>
