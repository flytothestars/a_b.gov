<?php
$links = ['about', 'news_list', 'services', 'docs']
?>

<div class="collapse navbar-collapse multi-collapse collapse flex-grow-0" id="navbarNav">
    <ul class="navbar-nav">
        @foreach($links as $link)
            @if($link != 'docs')
            <li class="nav-item px-2">
                <a class="nav-link py-0 {{ (Route::currentRouteName() == $link) ? 'active' : '' }}"
                   title="@lang('messages.links.'.$link)"
                   href="{{ route($link) }}">@lang('messages.links.'.$link)</a>
            </li>
            @endif
        @endforeach
    </ul>
</div>

