<header class="">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white py-4 pt-1 pb-1">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}"></a>
            @include('client.components.navigation')
            <form class="ms-2 d-flex flex-grow-1" method="GET" action="{{ route('search') }}">
                <div class="position-relative w-100 me-2">
                    <input class="form-control input opacity-primary input_icon-prepend"
                           type="search"
                           name="searchStr"
                           id="search"
                           placeholder="@lang('messages.general.search')"
                           aria-label="Поиск">
                    <i class="fas fa-search font-md input__icon text-primary"></i>
                    <div class="drop__search">
                    </div>
                    <!-- /.drop__search -->
                </div>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse"
                aria-controls="navbarNav_btns navbarNav " aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar__btn collapse multi-collapse" id="navbarNav_btns">
                @if (\Illuminate\Support\Facades\Auth::check())
                    <a class="btn  opacity-primary text-primary me-2"
                            href='{{ route('profile.index') }}'>@lang('messages.headerBtn.profile')
                    </a>

                    <button class="btn primary  text-white"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       @lang('messages.headerBtn.exit')
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <a class="btn  opacity-primary text-primary me-2"
                            href='{{ route('login') }}'>@lang('messages.headerBtn.registration')
                    </a>
                    <a class="btn  primary text-white" href='{{ route('login') }}'>@lang('messages.headerBtn.enter')
                    </a>
                @endif
                <div class="ms-1">
                    @include('client.components.switchLanguage')
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="mt-5">
</div>
