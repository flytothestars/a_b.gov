@extends('client.layouts.app')

@section('content')
    <?php
    $unicArrayPull = [];
    ?>
    <div class="pt-4">
        <div class="container">
            @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.financingPrograms.financingPrograms'])
            <div class="row pb-3">
                <div class="block-header col-lg-4 align-items-center ">
                    <div class="header">@lang('messages.pages.financingPrograms.financingPrograms')
                    </div>
                </div>
                <form class="pt-2 col-lg-8">
                    <div class="position-relative">
                        <input class="form-control input input_lg input_icon-prepend opacity-primary me-2" type="search"
                               placeholder="@lang('messages.general.search')"
                               aria-label="Поиск">
                        <i class="fas fa-search font-md input__icon text-primary input__icon_lg"></i>
                    </div>

                </form>
            </div>
            <a href="{{route('financingForm')}}" class="service-banner text-decoration-none mt-4 w-100 green"
               id="serviceBanner2">
                <div class="col-lg-4">
                    <div class="service-banner__title">
                    @lang('messages.pages.financingPrograms.onlineSelectionOfFinancing')
                    </div>
                    <div class="service-banner__text mt-3 ">
                    @lang('messages.pages.financingPrograms.weWillSelectFinancingProgramsForYourBusiness')
                    </div>
                    <div class="service-banner__action mt-4 pt-3">
                        <button class="btn text-white opacity-white">
                        @lang('messages.action.pickUp')
                        </button>
                    </div>
                </div>
            </a>
            <ul class="nav nav_tab mt-4 pt-3">
                <li class="nav-item me-2">
                    <a class="nav-link  {{$currentTypesAppeal == null ? 'active' : '' }}  py-0"
                       href="{{route('financingPrograms')}}"
                       title="@lang('messages.pages.financingPrograms.allPrograms')">
                    @lang('messages.pages.financingPrograms.allPrograms')
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link py-0 {{$currentTypesAppeal ==  \App\Repositories\Enums\TypesAppealEnum::ForBeginner ? 'active' : '' }}"
                       href="{{route('financingPrograms', ['types_appeal' => \App\Repositories\Enums\TypesAppealEnum::ForBeginner])}}"
                       title=" @lang('messages.pages.financingPrograms.forBeginners')">
                    @lang('messages.pages.financingPrograms.forBeginners')
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link py-0 {{$currentTypesAppeal ==  \App\Repositories\Enums\TypesAppealEnum::ForExisting ? 'active' : '' }}"
                       href="{{route('financingPrograms', ['types_appeal' => \App\Repositories\Enums\TypesAppealEnum::ForExisting])}}"
                       title="@lang('messages.pages.financingPrograms.forExisting')">
                    @lang('messages.pages.financingPrograms.forExisting')
                    </a>
                </li>
            </ul>
            <div class="row py-5">
                @foreach($financingPrograms as $program)
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
