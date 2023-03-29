<div class="services">
    <div class="row">
        <div class="col-4">
            <a href="{{route('services')}}" target="_blank" class="text-decoration-none">
                <div class="static-service card" id="staticService_1">
                    <div class="static-service__title card-title pe-5">@lang('messages.pages.staticServices.AlmatyBusinessPortal')</div>
                    <div class="static-service__text card-text ">@lang('messages.pages.staticServices.onlineServicesForTheAspiringEntrepreneurOfAlmatyCity')
                    </div>
                    <button class="static-service__link text-end btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')
                    </button>
                </div>
            </a>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <a href="https://navigator.almatybusiness.gov.kz/ru/businesses/place-select/" {{--id="serviceStatic"--}} target="_blank" class="text-decoration-none">
                        <div class="static-service card" id="staticService_2">
                            <div class="static-service__title card-title w-50">@lang('messages.pages.staticServices.BusinessNavigator')</div>
                            <div class="static-service__text card-text">@lang('messages.pages.staticServices.forCurrentEntrepreneur')</div>
                            <button class="static-service__link text-end btn opacity-white mt-2 mt-auto ms-auto">@lang('messages.action.moreDetails')
                            </button>
                        </div>
                    </a>
                </div>

                <div class="col-6">
                    <a href="{{route('banks',['action_type'=>'openAccount'])}}" target="_blank" class="text-decoration-none">
                        <div class="static-service card" id="staticService_4">
                            <div class="static-service__title static-service__title_sm card-title">@lang('messages.pages.onlineBank.OnlineOeningBankAccounts')
                            </div>
                            <div class="static-service__text card-text">@lang('messages.pages.onlineBank.OpenBankAccountWithoutLeavingHome')</div>
                            <button class="static-service__link text-end btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')</button>
                        </div>
                    </a>
                </div>

                <div class="col-6">
                    <a href="{{route('online.checkingBusinessForRisk')}}" target="_blank" class="text-decoration-none">
                        <div class="static-service " id="staticService_3_frame">
                            <div class="static-service card" id="staticService_3">
                                <div class="static-service__title static-service__title_sm card-title">@lang('messages.pages.tax.TaxTrafficLights')
                                </div>
                                <div class="static-service__text card-text">@lang('messages.pages.tax.FindOutHowTheTxAuthorities')</div>
                                <button class="static-service__link text-end btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-6">--}}
                {{-- <a href="{{route('servicesInfrastructure')}}" target="_blank" class="text-decoration-none">--}}
                {{-- <div class="static-service card" id="staticService_4">--}}
                {{-- <div class="static-service__title static-service__title_sm card-title">@lang('messages.pages.servicesInfrastructure.servicesInfrastructure')--}}
                {{-- </div>--}}
                {{-- <div class="static-service__text card-text">@lang('messages.pages.servicesInfrastructure.weWillHelpYouFindSolutionToAllPressingProblems')</div>--}}
                {{-- <button class="static-service__link text-end btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')</button>--}}
                {{-- </div>--}}
                {{-- </a>--}}
                {{-- </div>--}}

                {{-- <div class="col-6">--}}
                {{-- <a href="https://edu.almatybusiness.gov.kz/" target="_blank" class="text-decoration-none">--}}
                {{-- <div class="static-service " id="staticService_3_frame">--}}
                {{-- <div class="static-service card" id="staticService_3">--}}
                {{-- <div class="static-service__title static-service__title_sm card-title">@lang('messages.pages.staticServices.accelerationProgramAlmatyBusinessBoostYourBusiness')--}}
                {{-- </div>--}}
                {{-- <div class="static-service__text card-text">@lang('messages.pages.staticServices.upgradeYourBusinessAndForgetAboutTheCrisis')</div>--}}
                {{-- <button class="static-service__link text-end btn opacity-white mt-auto ms-auto">@lang('messages.action.moreDetails')--}}
                {{-- </button>--}}
                {{-- </div>--}}
                {{-- </div>--}}
                {{-- </a>--}}
                {{-- </div>--}}
            </div>
        </div>
    </div>
</div>
