<hr class="text-black my-4 "/>
<div class="mt-4 row">
    <div class="col-lg-6">
        <img class="w-100" src="{{asset('/images/financingSelection/4.png')}}" alt="">
    </div>
    <div class="col-lg-6">
        <div class="font-bold font-xl w-75">
        @lang('messages.pages.financingPrograms.programConcessionalLendingUpTo58MillionTenge')</span>
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
            <button class="btn primary text-white w-50 me-4">@lang('messages.action.toGetConsultation')</button>
        </div>
    </div>
</div>
<nav>
    <div class="survey__tab_sm mt-4 pt-3 d-flex nav " role="tablist">
        <div id="uTextOperatorTab" class="active me-4" data-bs-toggle="tab" data-bs-target="#uTextOperatorTabContent"
             type="button" role="tab" aria-controls="uTextOperatorTabContent" aria-selected="true">
             @lang('messages.pages.financingPrograms.operator')
        </div>
        <div id="uTextTabDescriptionTab" class="me-4" data-bs-toggle="tab" data-bs-target="#uTextTabDescriptionContent"
             type="button"
             role="tab" aria-controls="uTextTabDescriptionContent" aria-selected="false">
             @lang('messages.pages.financingPrograms.description')
        </div>
    </div>
</nav>
<hr class="text-black mb-5"/>
<div class="tab-content">
    <div id="uTextOperatorTabContent" role="tabpanel" aria-labelledby="uTextOperatorTab"
         class="font-md  tab-pane fade show active">
        <div class="font-md">
        @lang('messages.pages.financingPrograms.MicrofinanceOrganizationAlmaty')
        </div>
    </div>
    <div id="uTextTabDescriptionContent" role="tabpanel" aria-labelledby="uTextTabDescriptionTab"
         class="font-md tab-pane fade ">
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
                <b>Кредитование под залог движимого и недвижимого имущества</b></br>
                </br>
                Ставка вознаграждения
                <ul>
                    <li>2% — для многодетных малообеспеченных семей, инвалидов I и II группы, семей воспитывающих детей-инвалидов и резидентов промышленных парков;</li>
                    <li>6% — для всех других категорий заемщиков </li>
                </ul>

                Срок кредитования
                <ul>
                    <li>до 7 лет — финансирование, направленное на инвестиции; </li>
                    <li>на 3 года — финансирование, направленное на пополнение оборотных средств </li>
                </ul>

                Целевое назначение займа
                <ul>
                    <li>приобретение основных средств; </li>
                    <li>пополнение оборотных средств </li>
                </ul>
                Сумма кредита
                <ul> 
                    <li>от 500 000 тенге до 20 000 МРП </li>
                </ul>

    </div>
</div>


<div class="text-end mt-5">
    <a class="btn  opacity-primary text-primary" href='{{ route('services', ['types_appeal' => '-', 'service_groups' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b']) }}'>@lang('messages.action.ViewAllFinancialServices')</a>
</div>
