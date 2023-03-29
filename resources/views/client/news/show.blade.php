@extends('client.layouts.app')

@section('content')
    <?php
    setlocale(LC_TIME, 'ru_RU.utf8');
    ?>
    <div class="container news pt-3">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$news->translate('header')}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-8">
                <h1 class="news__header pt-3">{{$news->translate('header')}}</h1>
                <div class="news__thumbnail pt-3">
                    <img src="{{\Illuminate\Support\Facades\Storage::url($news->files->firstWhere('file_type', 'thumbnail')->path)}}" alt="{{$news->header}}"/>
                </div>
                <div class="news__date pt-3">{{\Carbon\Carbon::parse($news->create_date)->translatedFormat('d F, y')}}</div>
                <div class="news__content pt-3">
                    {!! $news->translate('content') !!}
                </div>
            </div>
            <div class="col-4">
{{--                {{$recommendedNewsList}}--}}
            </div>
        </div>
    </div>
@endsection
