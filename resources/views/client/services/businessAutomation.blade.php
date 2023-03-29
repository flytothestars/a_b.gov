@extends('client.layouts.app')

@section('content')

<div class="container pt-4">
    <div class="banks pb-5">
        <div class="header pb-3">@lang('messages.pages.businessAutomation.businessAutomationTitle')</div>
        <div class="banks-block">
            <div class="font-xl font-bold"> Выберите услугу:</div>
            <div class="row mt-4">
                @foreach ($services as $service)
                <!-- <div class="col-12 col-sm-4 mb-3 pb-2">

                    <div class="banks__card">
                        <div class="card-body">
                            <img class="" src="{{ asset('/images/front/appealType/' . $service->id . '.png')}}" alt="">
                            <div class="item-card__header mt-2">
                                {!!$service->getTranslationContent('name')!!}
                            </div>
                            <div class="item-card__lead">
                                {!!$service->getTranslationContent('description')!!}
                            </div>
                            <a class="btn opacity-primary text-primary w-100 mt-3"
                                href="{{$service->remote_url ? $service->remote_url : route('services.form', ['service_groups_id' => $service->service_group_id])}}">@lang('messages.action.moreDetails')</a>
                        </div>
                    </div>

                </div> -->
                <div class="col-12 col-sm-4 mb-3 pb-2">
                    <div class="card  item-card item-card_financing-program mb-3 border rounded">

                        <img src="{{ asset('/images/front/appealType/' . $service->id . '.png')}}" class="card-img-top"
                            style="object-fit: cover" alt="">
                        <div class="card-body">
                            <div class="item-card__header mt-2">
                                {{$service->getTranslationContent('name')}}
                            </div>
                            <div class="item-card__lead mt-3">
                                {!!$service->getTranslationContent('description')!!}
                            </div>
                            <div class="mt-auto align-items-end btn-wrapper">
                                <a class="btn opacity-primary text-primary w-100 mt-3"
                                    href="{{$service->remote_url ? $service->remote_url : route('services.form', ['service_groups_id' => $service->service_group_id])}}">@lang('messages.action.moreDetails')</a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    @endsection