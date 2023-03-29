@extends('client.layouts.app')
@section('title', 'О портале')
@section('content')
    <div class="about">
        <div class="container ">
            <div class=" pt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('about')}}">@lang('messages.general.main')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('messages.pages.about.about')</li>
                    </ol>
                </nav>
            </div>
            <div class="header mb-1">
            @lang('messages.pages.about.about')
            </div>
            <div class="about-content-block pt-5 pb-4">
                <div class="row">
                    <div class="col-12 col-md-6"><img src="{{asset('/images/about/1.png')}}" class="w-100"
                                                      alt="about-1"></div>
                    <div class="col-12 col-md-5 pt-4">
                        <div class="about-content-block__header pt-2 pb-5">@lang('messages.pages.about.almatyBusinessPortal')</div>
                        <div class="about-content-block__text">@lang('messages.pages.about.theOfficialResourceOfDepartmentOfEntrepreneurship')
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-content-block pt-5 pb-4">
                <div class="row">
                    <div class="col-12 col-md-5 pt-4">
                        <div class="about-content-block__header pt-2 pb-5">@lang('messages.pages.about.SERVICES')</div>
                        <div class="about-content-block__text">@lang('messages.pages.about.onOurPortalYouCanGetSuchOnlineServicesAsFreeTraining')
                        </div>
                    </div>
                    <div class="col-12 col-md-6"><img src="{{asset('/images/about/2.png')}}" class="w-100"
                                                      alt="about-2"></div>

                </div>
            </div>
            <div class="about-content-block pt-5">
                <div class="row">
                    <div class="col-12 col-md-6"><img src="{{asset('/images/about/3.png')}}" class="w-100 img-shadow"
                                                      alt="about-3"></div>
                    <div class="col-12 col-md-5 pt-4">
                        <div class="about-content-block__header pt-2 pb-5">@lang('messages.pages.about.HELPFUL_INFORMATION')</div>
                        <div class="about-content-block__text">@lang('messages.pages.about.onTheAlmatyBusinessPortalYouWillFindTheFreshest')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
