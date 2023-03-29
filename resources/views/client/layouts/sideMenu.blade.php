<div class="d-flex side-menu__wrapper flex-column flex-shrink-0  text-white " id="sidebar" role="navigation">
    <div class="d-flex flex-column side-menu side-menu_profile dark-blue">
        <a href="{{route('home')}}" class="d-flex align-items-center mx-auto py-4 ">
            <img src="{{asset('images/light-logo.svg')}}" id="sideLogo" class="side-menu__logo"/>
        </a>
        <hr class="side-menu__hr my-0">
        <div class="account-info mt-4 pt-2">
            <img class="account-info__avatar me-3" src="{{asset('images/avatar.png')}}" alt="" width="46" height="46"
                 class=" me-3">
            <div class="account-info__data">
                @if(\Illuminate\Support\Facades\Auth::user()->profile)
                    <div
                        class="account-info__full-name">{{\Illuminate\Support\Facades\Auth::user()->profile->first_name}} {{\Illuminate\Support\Facades\Auth::user()->profile->last_name}}</div>
                @else
                    <div
                        class="account-info__full-name">@lang('messages.pages.Profile.name') @lang('messages.pages.Profile.surname')</div>
                @endif
                <div class="account-info__email">{{\Illuminate\Support\Facades\Auth::user()->email}}</div>
            </div>
        </div>
        <ul class="side-menu__nav nav nav-pills flex-column mb-auto mt-2 pt-1">
            <li class="side-menu__nav-item nav-item ">
                <a href="{{route('profile.info')}}"
                   class="side-menu__nav-link nav-link {{isset($prof_active) && $prof_active==true? 'active':''}}"
                   aria-current="page">
                    <i class="icon fas fa-briefcase"></i>
                    @lang('messages.pages.Profile.myProfile')
                </a>
            </li>
            <li class="side-menu__nav-item nav-item ">
                <a href="{{route('appeals.index')}}"
                   class="side-menu__nav-link nav-link text-white {{isset($appeal_active) && $appeal_active==true? 'active':''}} "
                   aria-current="page">
                    <i class="icon fas fa-envelope-open-text"></i>
                    @lang('messages.pages.Profile.requests')
                </a>
            </li>
            {{--            <li class="side-menu__nav-item nav-item ">--}}
            {{--                <a href="#" class="side-menu__nav-link nav-link text-white" aria-current="page">--}}
            {{--                    <i class="icon fas fa-headphones-alt"></i>--}}
            {{--                     Услуги--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
        <hr>
        <div class="dropdown ">
            <ul class="side-menu__nav nav nav-pills flex-column mb-auto">
                <li class="side-menu__nav-item nav-item mb-1 ">
                    <a href="{{route('home')}}" class="side-menu__nav-link nav-link text-white " aria-current="page">
                        <i class="icon fa fa-home"></i>
                        @lang('messages.pages.Profile.toMain')
                    </a>
                </li>
                <li class="side-menu__nav-item nav-item ">
                    <a href="#" class="side-menu__nav-link nav-link text-white " aria-current="page"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="icon fa fa-sign-out-alt"></i>
                        @lang('messages.pages.Profile.exit')
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                <li class="side-menu__nav-item nav-item side-menu__toogle">
                    <a href="#" class="side-menu__nav-link nav-link text-white " id="hamburger" aria-current="page">
                        Свернуть меню
                        <i class="icon fa fa-arrow-left" id="toogle_arrow"></i>
                    </a>
                </li>
            </ul>


        </div>
    </div>
</div>

