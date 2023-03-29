@extends('client.layouts.app')
@section('title', 'Новости')
@section('content')
    <div class="container news-list pt-5">
        <div class="row">
            <div class="col-12">
                @include('client.components.breadcrumb' , ['currentLocationName' => 'messages.pages.news.news'])
            </div>
        </div>
        <div class="block-header align-items-center d-md-flex mb-4">
            <div class="header flex-grow-0 w-25">@lang('messages.pages.news.news')</div>
        </div>
{{--        <ul class="nav nav_tab ">--}}
{{--            <li class="nav-item ">--}}
{{--                <a class="nav-link active py-0" title="Все" href="{{route('news_list')}}">--}}
{{--                    Все--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @foreach($newsCategoryList as $newsCategory)--}}
{{--                <li class="nav-item px-2">--}}
{{--                    <a class="nav-link py-0" title="{{$newsCategory->name}}"--}}
{{--                       href="{{route('news_list', ['news_category_code'=>$newsCategory->code])}}">--}}
{{--                        {{$newsCategory->name}}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
        <div class="row filters">

            <!-- <div class="filters__selects">
                <label>Сортировка:</label>
                <select class="form-select no-border font-sm" aria-label=".form-select-sm">
                    <option selected>Сначала новые</option>
                </select>
            </div> -->
        </div>
        <div class="row">
            @foreach($newsList as $news)

                <div class="col-12 col-sm-4 newsItem">
                    @include('client.components.newsItem', ['news' => $news])
                </div>
            @endforeach
        </div>

        {{$newsList->links()}}

{{--        <div class="pagination mb-5">--}}
{{--            <a href="#" class="pagination-prev"><i class="fa fa-angle-left"></i>@lang('messages.action.prev')  </a>--}}
{{--            <ul class="pagination-items">--}}
{{--                <li class="pagination-item pagination-item__active"><a href="#" class="pagination-link">1</a></li>--}}
{{--            </ul>--}}
{{--            <a href="#" class="pagination-next">@lang('messages.action.next') <i class="fa fa-angle-right"></i></a>--}}
{{--        </div>--}}
        <!-- /.pagination -->

    </div>
@endsection
