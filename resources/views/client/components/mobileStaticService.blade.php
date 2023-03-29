<a href="{{route('services', ['types_appeal' => '262525f7-452d-4fc9-a90f-b7938dd7add1'])}}" target="_blank" class="mobile-service text-decoration-none">
    <div class="static-service card" id="staticService_1">
        <div class="static-service__title card-title pe-5">@lang('messages.pages.staticServices.AlmatyBusinessPortal')</div>
        <div class="static-service__text card-text ">@lang('messages.pages.staticServices.onlineServicesForTheAspiringEntrepreneurOfAlmatyCity')
        </div>
        <button
            class="static-service__link btn text-center opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')
        </button>
    </div>
</a>

<a href="{{route('services', ['types_appeal' => \App\Repositories\Enums\TypesAppealEnum::ForExisting])}}" target="_blank"
   class="text-decoration-none mobile-service">
    <div class="static-service card" id="staticService_2">
        <div class="static-service__title card-title">@lang('messages.pages.staticServices.BusinessNavigator')</div>
        <div class="static-service__text card-text"> @lang('messages.pages.staticServices.forCurrentEntrepreneur')</div>
        <button
            class="static-service__link text-center btn opacity-white mt-2 mt-auto ms-auto">@lang('messages.action.moreDetails')
        </button>
    </div>
</a>

<a href="{{route('servicesInfrastructure')}}" class="text-decoration-none mobile-service">
    <div class="static-service card" id="staticService_4">
        <div class="static-service__title static-service__title_sm card-title">
             @lang('messages.pages.servicesInfrastructure.servicesInfrastructure')
        </div>
        <div class="static-service__text card-text">@lang('messages.pages.servicesInfrastructure.weWillHelpYouFindSolutionToAllPressingProblems')</div>
        <button class="static-service__link text-center btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')</button>
    </div>
</a>

<a href="https://edu.almatybusiness.gov.kz/" class="text-decoration-none mobile-service">
    <div class="static-service card" id="staticService_3">
        <div class="static-service__title static-service__title_sm card-title">@lang('messages.pages.tax.TaxTrafficLights')
        </div>
        <div class="static-service__text card-text">@lang('messages.pages.tax.FindOutHowTheTxAuthorities')</div>
        <button
            class="static-service__link text-center btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')
        </button>
    </div>
</a>
