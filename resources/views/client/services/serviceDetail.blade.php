@extends('client.layouts.app')

@section('content')
    <div class="pt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.businessAutomation.businessAutomationTitle','urlCurrentLocationName' => 'business.automation'])
            </nav>
            <div class="row mb-5">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div>
                        <div class="header"> {{$header->title}}</div>
                    </div>
                    <div class="font-md mt-4 pt-2">
                    {!!  $content->content !!}
                    <div class="pt-3 font-bold">
                        @lang('messages.pages.startBusiness.forFreeConsultationAndSupport')
                        </div>
                    </div>

                    <div class="btn primary mt-5 text-white font-bold btn-wrapper"
                        onclick="location.href='{{ route('services.form', ['service_groups_id' => \App\Repositories\Enums\ServiceGroupEnum::BusinessAutomation]) }}'">
                        @lang('messages.action.Apply')
                    </div>
                </div>

                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="services-img">
                        <img width="509" height="351" src="{{ asset('/images/front/' . $service->files->firstWhere('file_type', 'thumbnail')->path)}}" alt="Открыть бизнес">
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
