@extends('client.layouts.app')
@section('title', 'Услуги')
@section('content')

    <div class="pt-4">
        <div class="container">
            @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.services.services'])
            <!-- <div class="row pb-3">
                <div class="block-header col-lg-3 col-12 align-items-center ">
                    <div class="header">@lang('messages.pages.services.services')
                    </div>
                </div>
            </div> -->
            <div class="service-banner text-decoration-none mt-4 w-100 {{$currentServiceGroupName}} ">
                <div class="col-lg-6 service-banner__info col-12">
                    <div class="service-banner__title">
                        @lang('messages.pages.services.types.'.$currentServiceGroupName)
                    </div>
                    <div class="service-banner__text mt-3 ">
                        @lang('messages.pages.services.inThisSectionYouWillGetEverythingYouNeedForYourBusiness')
                    </div>
                </div>
                <div class="service-banner__image col-lg-6 col-12" >
                    <div class="col-12" id="{{$currentServiceGroupName}}">
                    </div>
                </div>
            </div>
            <!-- <ul class="nav nav_tab mt-4 pt-3 mt-5">
                <li class="nav-item me-2 mb-3">
                    <a class="nav-link text-center py-0 {{ $currentServiceGroup == '' ? 'active' : '' }}"
                        href="{{ route('services', ['types_appeal' => $currentTypesAppeal]) }}"
                        title="@lang('messages.pages.services.allServices')">
                        @lang('messages.pages.services.allServices')
                    </a>
                </li>
                @foreach ($serviceGroupList as $service)
                    <li class="nav-item me-2">
                        <a class="nav-link py-0 {{ $currentServiceGroup == $service->id ? 'active' : '' }}"
                            href="{{ route('services', ['types_appeal' => $currentTypesAppeal ?? '-', 'service_groups' => $service->id ?? null]) }}"
                            title="{{ $service->getTranslationContent('name') }}">
                            {{ $service->getTranslationContent('name') }}
                        </a>
                    </li>
                @endforeach
            </ul> -->
            @if($currentServiceGroupName == 'FinancialServices')
                <div class="container-fluid mt-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">@lang('messages.pages.services.tab.gosprogram')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">@lang('messages.pages.services.tab.bankservices')</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row py-5">
                                @foreach ($services as $service)
                                    @if($service->order_no != 30 && $service->order_no != 31)
                                    <div class="col-12 col-sm-4 mb-3 pb-2">
                                        @include('client.components.programItem', ['program' => $service])
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row py-5">
                                @foreach ($services as $service)
                                    @if($service->order_no == 30 || $service->order_no == 31)
                                    <div class="col-12 col-sm-4 mb-3 pb-2">
                                        @include('client.components.programItem', ['program' => $service])
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row py-5">
                    @foreach ($services as $service)
                    @if($service->order_no != 100)      
                        <div class="col-12 col-sm-4 mb-3 pb-2 {{$service->group_code}}">
                            @include('client.components.programItem', ['program' => $service])
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
            
        </div>
    </div>
@endsection
