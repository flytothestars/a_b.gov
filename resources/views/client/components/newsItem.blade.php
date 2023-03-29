<a href="{{route('news', ['news_code' => $news->code])}}" class="card news-block__card mb-3 h-100 border-0">

    <?php
    setlocale(LC_TIME, 'ru_RU.utf8');
    ?>
    <img
            src="{{\Illuminate\Support\Facades\Storage::url($news->files->firstWhere('file_type', 'thumbnail')->path)}}"
            class="card-img-top" alt="{{$news->translate('header')}}">
    <div class="card-body ">

        <div class="card__item news-item">
            <p class="card-text "><small class="text-green">{{$news->newsCategory->name}}</small></p>
            <p class="card-text float-end ms-auto text-muted">{{\Carbon\Carbon::parse($news->create_date)->translatedFormat('d F, y')}}</p>

        </div>
        <div class="card__item">
            <div class="card-title mb-4">{{$news->translate('header')}}</div>
        </div>
        <div class="card__item">
            <p class="card-text">{{$news->translate('lead')}}</p>
        </div>
        <div class="card__item mt-auto align-items-end">
            <span class="text-blue text-decoration-none"><p class="font-md font-bold">@lang('messages.pages.news.readNext')</p></span>
        </div>

    </div>

</a>

