<?php
setlocale(LC_TIME, 'ru_RU.utf8');
?>

@foreach (array_chunk($newsList->all(), 4) as $newsChunk)
    <a href="{{ route('news', ['news_code' => $newsChunk[0]->code]) }}" class="card news-block__card">
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newsChunk[0]->files->firstWhere('file_type', 'thumbnail')->path) }}"
            class="card-img-top " alt="{{ $newsChunk[0]->header }}">
        <div class="card-body d-flex pb-2 flex-column">
            <h5 class="card-title">{{ $newsChunk[0]->header }}</h5>
            {{-- <div class="card-text mt-auto pb-1 date">{{\Carbon\Carbon::parse($newsChunk[0]->create_date)->translatedFormat('d F, y | H:i')}}</div> --}}
            <div class="card-text mt-auto pb-1 date"></div>
        </div>
    </a>

    <a href="{{ route('news', ['news_code' => $newsChunk[1]->code]) }}" class="card news-block__card h-100">
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newsChunk[1]->files->firstWhere('file_type', 'thumbnail')->path) }}"
            class="card-img-top" alt="{{ $newsChunk[1]->header }}">
        <div class="card-body pb-2">
            <h5 class="card-title mb-0">{{ $newsChunk[1]->header }}</h5>
            {{-- <div class="card-text pb-1 pt-1 mt-auto date">{{\Carbon\Carbon::parse($newsChunk[1]->create_date)->translatedFormat('d F, y | H:i')}}</div> --}}
            <div class="card-text pb-1 pt-1 mt-auto date"></div>
        </div>
    </a>

    <a href="{{ route('news', ['news_code' => $newsChunk[2]->code]) }}" class="card news-block__card">
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newsChunk[2]->files->firstWhere('file_type', 'thumbnail')->path) }}"
            class="card-img-top" alt="{{ $newsChunk[2]->header }}">
        <div class="card-body">
            <h5 class="card-title mb-0">{{ $newsChunk[2]->header }}</h5>
            {{-- <div class="card-text mt-auto pb-1 pt-1 date">{{\Carbon\Carbon::parse($newsChunk[2]->create_date)->translatedFormat('d F, y | H:i')}}</div> --}}
            <div class="card-text mt-auto pb-1 pt-1 date"></div>
        </div>
    </a>

    <a href="{{ route('news', ['news_code' => $newsChunk[3]->code]) }}" class="card news-block__card">
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newsChunk[3]->files->firstWhere('file_type', 'thumbnail')->path) }}"
            class="card-img-top" alt="{{ $newsChunk[3]->header }}">
        <div class="card-body">
            <h5 class="card-title mb-0">{{ $newsChunk[3]->header }}</h5>
            {{-- <div class="card-text pb-1 mt-2 date">{{\Carbon\Carbon::parse($newsChunk[2]->create_date)->translatedFormat('d F, y | H:i')}}</div> --}}
            <div class="card-text pb-1 mt-2 date"></div>
        </div>
    </a>

@endforeach
