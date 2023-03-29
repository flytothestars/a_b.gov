@extends('client.layouts.app')

@section('content')
<?php
$unicArrayPull = [];
?>
<div class="freeEducations">
    <div class="banner">
        <div class="">
            <div class="pt-4">
                <div class="container h-100">
                    @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.staticServices.freeEducation'])
                    <!-- test -->
                    <div class="service-banner text-decoration-none text-dark mt-4 w-100 FinancialServicesStyle ">
                        <div class="col-lg-6 service-banner__info col-12">
                            <div class="service-banner__title">{{$freeEducations->getTranslationContent('header')}}</div>
                            <div class="service-banner__text mt-3 ">
                                <p>{{$freeEducations->getTranslationContent('lead')}}</p>
                                <p></p>
                            </div>
                            <div class="banner-info_cost font-bold font-md">
                                @lang('messages.pages.freeEducation.Cost'):
                                <span class="banner-info_count "> @lang('messages.pages.freeEducation.Money') </span>
                                <a href="{{ route('login') }}" class="banner-info_link text-end btn opacity-white mt-2"> @lang('messages.pages.freeEducation.ViewCourse') </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12" >
                        <img style="    width: -webkit-fill-available;" src="{{\Illuminate\Support\Facades\Storage::url($freeEducations->categoryAppeal->files->firstWhere('file_type', 'thumbnail')->path)}}" class="card-img-top" alt="{{$freeEducations->categoryAppeal->name}}">

                            <!-- <div class="col-12" id="FreeEducation">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pt-4 h-100">
        <div class="no-overflow pt-4 pb-4">
            <div class="header">@lang('messages.general.description')</div>
            <div class=" pt-4 font-md">
                {!!$freeEducations->getTranslationContent('description')!!}
            </div>
        </div>
        <hr>
        @if(count($freeEducations->lessons))
        <div class="no-overflow pt-4">
            <div class="header">@lang('messages.pages.freeEducation.Lessons')</div>
            <div class="no-overflow pt-4">
                @foreach($freeEducations->lessons as $lesson)
                <div class="free-lessons font-md">
                    <!-- <a href="{{$lesson->remote_url }}"> -->
                        <p class="font-bold">{{$lesson->getTranslationContent('name') }}</p>
                        <!-- <i class="fa fa-thin fa-angle-right"></i> -->
                    <!-- </a> -->

                </div>
                @endforeach
            </div>
        </div>
        @endif
        <br>
        @include('client.components.blockHeader', ['blockName' => 'messages.links.also', 'showAllUrl'=>
        route('services')])

        <div class=" pt-4 pb-4">
            <div id="education-carousel" class="  owl-carousel carousel  owl-theme">
                @foreach($otherEducations as $program)
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
                    items: 2,
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