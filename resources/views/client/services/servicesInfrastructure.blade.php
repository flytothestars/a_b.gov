@extends('client.layouts.app')


@section('content')
    <div class="pt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                @include('client.components.breadcrumb', ['currentLocationName'=> __('messages.pages.servicesInfrastructure.servicesInfrastructure')])
            </nav>
            <div class="row mb-5">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div>
                        <div class="header">
                            @lang('messages.pages.servicesInfrastructure.utilityInfrastructureSupport')</div>
                    </div>
                    <div class="font-md mt-4 pt-2">
                        @lang('messages.pages.servicesInfrastructure.thisSectionProvidesInformationMaterialForIndividualsLegalEntitiesFieldCommunalInfrastructure')
                        <div class="pt-3 font-bold">
                            @lang('messages.pages.startBusiness.forFreeConsultationAndSupport')
                        </div>
                    </div>

                    <div class="btn primary mt-5 text-white font-bold btn-wrapper"
                        onclick="location.href='{{ route('services.form', ['service_groups_id' => \App\Repositories\Enums\ServiceGroupEnum::CommunalInfrastructure]) }}'">
                        @lang('messages.action.Apply')
                    </div>
                </div>

                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="services-img">
                        <img src="{{ asset('images/serviceGroupBanner/7.png') }}" alt="@lang('messages.pages.servicesInfrastructure.servicesInfrastructure')">
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
