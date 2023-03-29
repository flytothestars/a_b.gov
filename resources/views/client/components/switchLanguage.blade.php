<div class="switch-language ">
    <div class="dropdown">
        <button class="btn dropdown-toggle switch-language__dropdown-toggle" type="button" id="switchLanguageDropdown"
                aria-expanded="false" data-bs-toggle="dropdown">
            @if(App::currentLocale() == \App\Repositories\Enums\LanguageEnum::RU)
                ru
            @elseif(App::currentLocale() == \App\Repositories\Enums\LanguageEnum::KK)
                kz
            @endif
        </button>
        <ul class="dropdown-menu" aria-labelledby="switchLanguageDropdown">
            <li><a class="dropdown-item" href="{{route('setLocale', ['locale'=>'ru'])}}"> ru</a></li>
            <li><a class="dropdown-item" href="{{route('setLocale', ['locale'=>'kk'])}}"> kz</a></li>
        </ul>
    </div>

</div>
