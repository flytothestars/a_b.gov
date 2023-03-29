@extends('client.layouts.app')

@section('content')
    <?php
    $unicArrayPull = [];
    ?>
    <div class="pt-4">
        <div class="container">
            @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.staticServices.freeEducation'])
            <div class="row pb-3">
                <div class="block-header col-lg-4 align-items-center ">
                    <div class="header">@lang('messages.pages.staticServices.freeEducation')
                    </div>
                </div>
                <form class="pt-2 col-lg-8">
                    <div class="position-relative">
                        <input class="form-control input input_lg input_icon-prepend opacity-primary me-2" type="search"
                               placeholder="@lang('messages.general.search')"
                               aria-label="@lang('messages.general.search')">
                        <i class="fas fa-search font-md input__icon text-primary input__icon_lg"></i>
                    </div>

                </form>
            </div>
            <div class="service-banner text-decoration-none mt-4 w-100 green"
               id="serviceBanner4">
                <div class="col-lg-4">
                    <img src="{{asset('/images/freeEducationIcon.svg')}}">
                    <div class="service-banner__title pt-3">
                        @lang('messages.pages.staticServices.freeEducation')
                    </div>
                </div>
            </div>
            <div class="nav nav_tab nav_lg mt-5">
                <li class="nav-item w-50 text-center">
                    <a class="nav-link {{$currentTypesAppeal == \App\Repositories\Enums\TypesAppealEnum::ForBeginner ? 'active' : '' }}  w-100 py-0" href="{{route('freeEducation', ['types_appeal' => \App\Repositories\Enums\TypesAppealEnum::ForBeginner])}}" title="Для начинающих">
                        @lang('messages.pages.financingPrograms.forBeginners')
                    </a>
                </li>
                <li class="nav-item  w-50 ">
                    <a class="nav-link  py-0 w-100 text-center {{$currentTypesAppeal == \App\Repositories\Enums\TypesAppealEnum::ForExisting ? 'active' : '' }} " href="{{route('freeEducation', ['types_appeal' => \App\Repositories\Enums\TypesAppealEnum::ForExisting])}}" title="Для действующих">
                        @lang('messages.pages.financingPrograms.forExisting')
                    </a>
                </li>
                <hr class="w-100 "/>
            </div>
            <div class="row py-5">
                @foreach($freeEducations as $program)
                    @if(!in_array($program->name ,$unicArrayPull))
                        <div class="col-12 col-sm-4 mb-3 pb-2">
                            @include('client.components.programItem', ['program' => $program])
                        </div>
                        @php
                            array_push($unicArrayPull, $program->name)
                        @endphp

                    @endif
                @endforeach
            </div>

        </div>
    </div>
@endsection
