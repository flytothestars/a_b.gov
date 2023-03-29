<?php
//setlocale(LC_TIME, 'ru_RU.utf8');
?>
<div class="news-block">
    <div class="row">
        @foreach(array_chunk($newsList->all(), 4) as $newsChunk)
            <div class="col-6 static align-items-stretch d-flex">
                <a href="{{route('news', ['news_code' => $newsChunk[0]->code])}}" class="card news-block__card">
                    <img src="{{\Illuminate\Support\Facades\Storage::url($newsChunk[0]->files->firstWhere('file_type', 'thumbnail')->path)}}" class="card-img-top " alt="{{$newsChunk[0]->header}}">
                    <div class="card-body d-flex pb-2 flex-column">
                        <h5 class="card-title">{{($newsChunk[0])->translate('header')}}</h5>
                        <p class="card-text">{{($newsChunk[0])->translate('lead')}}</p>
                        <div class="card-text mt-auto pb-1 date">{{\Carbon\Carbon::parse($newsChunk[0]->create_date)->translatedFormat('d F, y')}}</div>
                        <div class="card-text mt-auto pb-1 date"></div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <div class="row ">
                    <div class="col-6 d-flex flex-column">
                        <a href="{{route('news', ['news_code' => $newsChunk[1]->code])}}" class="card news-block__card h-100 mb-3">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($newsChunk[1]->files->firstWhere('file_type', 'thumbnail')->path)}}" class="card-img-top" alt="{{$newsChunk[1]->header}}">
                            <div class="card-body pb-2 d-flex flex-column">
                                <h5 class="card-title mb-0">{{($newsChunk[1])->translate('header')}}</h5>
                                <div class="card-text pb-1 pt-1 mt-auto date">{{\Carbon\Carbon::parse($newsChunk[1]->create_date)->translatedFormat('d F, y')}}</div>
                                <div class="card-text pb-1 pt-1 mt-auto date"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 d-flex flex-column">
                        <a href="{{route('news', ['news_code' => $newsChunk[2]->code])}}"  class="card news-block__card mb-3">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($newsChunk[2]->files->firstWhere('file_type', 'thumbnail')->path)}}" class="card-img-top" alt="{{$newsChunk[2]->header}}">
                            <div class="card-body pb-2 d-flex flex-column">
                                <h5 class="card-title mb-0">{{($newsChunk[2])->translate('header')}}</h5>
                                <div class="card-text mt-auto pb-1 pt-1 date">{{\Carbon\Carbon::parse($newsChunk[2]->create_date)->translatedFormat('d F, y')}}</div>
                                <div class="card-text mt-auto pb-1 pt-1 date"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('news', ['news_code' => $newsChunk[3]->code])}}"  class="card news-block__card news-block__card-last">
                            <div class="card-body pb-2 d-flex flex-column">
                                <h5 class="card-title mb-0">{{($newsChunk[3])->translate('header')}}</h5>
                                <div class="card-text pb-1 mt-2 date">{{\Carbon\Carbon::parse($newsChunk[3]->create_date)->translatedFormat('d F, y')}}</div>
                                <div class="card-text pb-1 mt-2 date"></div>
                            </div>
                            <div class="card-img-wrapper">
                             <img src="{{\Illuminate\Support\Facades\Storage::url($newsChunk[3]->files->firstWhere('file_type', 'thumbnail')->path)}}" class="card-img-top" alt="{{$newsChunk[3]->header}}">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
