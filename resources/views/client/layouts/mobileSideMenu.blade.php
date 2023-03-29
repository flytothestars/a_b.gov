<div class="navbar navbar-dark navbar-expand-lg navbar-light dark-blue py-4 mobile-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/light-logo.svg') }}"></a>
        <button class="navbar-toggler" id="mobile-btn" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</div>


<div class="d-flex side-menu__wrapper flex-column text-white">
    <div class="d-flex flex-column side-menu side-menu_profile dark-blue">
        <a href="{{route('home')}}" class="d-flex mx-auto py-4 ">
            <img src="{{asset('images/light-logo.svg')}}"/>
        </a>
        <hr class="side-menu__hr my-0">
        <div class="account-info mt-4 mb-3 pt-2 d-flex align-items-center">
            <img class="account-info__avatar me-3" src="{{asset('images/avatar.png')}}" alt="" width="46" height="46"
                 class=" me-3">
            <div>
                @if(\Illuminate\Support\Facades\Auth::user()->profile)
                    <div class="account-info__full-name">{{\Illuminate\Support\Facades\Auth::user()->profile->first_name}} {{\Illuminate\Support\Facades\Auth::user()->profile->last_name}}</div>
                @else
                    <div class="account-info__full-name">Имя Фамилия</div>
                @endif
                <div class="account-info__email">{{\Illuminate\Support\Facades\Auth::user()->email}}</div>
            </div>
        </div>
        <ul class="side-menu__nav nav nav-pills flex-column">
            <li class="side-menu__nav-item nav-item ">
                <a href="{{route('profile.info')}}" class="side-menu__nav-link nav-link {{isset($prof_active) && $prof_active==true? 'active':''}}" aria-current="page">
                    <i class="icon fas fa-briefcase"></i>
                    Мой профиль
                </a>
            </li>
            <li class="side-menu__nav-item nav-item ">
                <a href="{{route('appeals.index')}}" class="side-menu__nav-link nav-link text-white {{isset($appeal_active) && $appeal_active==true? 'active':''}} " aria-current="page">
                    <i class="icon fas fa-envelope-open-text"></i>
                    Обращения
                </a>
            </li>
{{--            <li class="side-menu__nav-item nav-item ">--}}
{{--                <a href="#" class="side-menu__nav-link nav-link text-white" aria-current="page">--}}
{{--                    <i class="icon fas fa-headphones-alt"></i>--}}
{{--                    Услуги--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <hr>
        <div class="dropdown pb-3">
            <ul class="side-menu__nav nav nav-pills flex-column mb-auto">
                <li class="side-menu__nav-item nav-item mb-1 ">
                    <a href="{{route('home')}}" class="side-menu__nav-link nav-link text-white " aria-current="page">
                        <i class="icon fa fa-home"></i>
                        На главную
                    </a>
                </li>
                <li class="side-menu__nav-item nav-item ">
                    <a href="#" class="side-menu__nav-link nav-link text-white " aria-current="page"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="icon fa fa-sign-out-alt"></i>
                        Выйти
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>


        </div>
    </div>
</div>
