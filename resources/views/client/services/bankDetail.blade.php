@extends('client.layouts.app')

@section('content')
<?php
$unicArrayPull = array();
$href = route('banks', ['action_type' => $action_type]);
$breadcrumb = trans('messages.pages.banks.header.' . $action_type);


?>
<div class="banks pt-4">

    <div class="container">

        <div class=" row ">
            @include('client.components.breadcrumb', ['currentLocationName'=>'<a href="'.$href.'">'.$breadcrumb .'</a>/'.$bankData->translate('header')])
            <div class="col-lg-6 banks-info d-none d-sm-block">

                <div class="font-bold header ">{{$bankData->translate('header')}} </div>

                <div class="no-overflow pt-4 pb-4">
                    {!! $bankData->translate('content') !!}
                </div>

                <div class="no-overflow pt-4 pb-4 banks-info__buttons">
                    <a class="btn primary text-white w-50 me-4" href="{{$bankData->url}}">@lang('messages.pages.banks.action.'.$action_type)</a>
                </div>


            </div>
            <div class="col-lg-6 d-none d-sm-block">
                <div class="banks-banner">
                    <img class="banks-banner__header mt-3" src="/images/banks/{{$bankData->bank_code}}_header.png" alt="">
                    <img class="banks-banner__core mt-3" src="/images/banks/{{$bankData->bank_code}}_{{$action_type}}.png" alt="centercredit Img">

                </div>
            </div>

            <div class="col-lg-6 d-block d-sm-none">
                <div class="banks-banner">
                    <img class="banks-banner__header mt-3" src="/images/banks/{{$bankData->bank_code}}_header.png" alt="centercredit Img">
                    <img class="banks-banner__core mt-3" src="/images/banks/{{$bankData->bank_code}}_{{$action_type}}.png" alt="centercredit Img">

                </div>

            </div>

            <div class="col-lg-6 banks-info mt-4 d-block d-sm-none">

                <div class="font-bold header ">{{$bankData->translate('header')}} </div>

                <div class="no-overflow pt-4 pb-4">
                    {!! $bankData->translate('content') !!}
                </div>



                <div class="no-overflow pt-4 pb-4 banks-info__buttons">
                    <a class="btn primary text-white w-100 me-4" href="{{$bankData->url}}">@lang('messages.pages.banks.action.'.$action_type)</a>
                </div>


            </div>
        </div>
        <br>
        @include('client.components.blockHeader', ['blockName' => 'messages.links.also', 'showAllUrl'=>
        route('services')])
        <div class=" pt-4 pb-4">
            <div id="education-carousel" class="  owl-carousel carousel  owl-theme">
                @foreach($otherPrograms as $program)
                @if(!in_array($program->name ,$unicArrayPull))
                <div class="col-12 mb-3 pb-2">
                    @include('client.components.programItem', ['program' => $program])
                </div>
                @php
                array_push($unicArrayPull, $program->name)
                @endphp

                @endif
                @endforeach

            </div>
            <div class="owl-theme pb-4">
                <div class="owl-controls">
                    <div class="custom-nav owl-nav"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script>
    $(document).ready(() => {
        $('#education-carousel').owlCarousel({

            loop: false,

            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: true,
                    dots: true,
                },
                768: {
                    items: 3,
                    margin: 25,
                    mouseDrag: false,
                    touchDrag: false,
                    pullDrag: false,
                    nav: true,
                    dots: true,
                },
            },

        });

        $(".next").click(function() {
            owl.trigger("owl.next");
        });
        $(".prev").click(function() {
            owl.trigger("owl.prev");
        });

    })
</script>
@endsection