@extends('client.layouts.app')
@section('title', 'Поиск')
@section('content')
<div class="about">
        <div class="container ">    
            <div class="header mb-1 mt-4">
            @lang('messages.pages.search.search')
            </div>
            @foreach ($searchLists as $search)
            <div class="search-group">
                <a
                    href="{{ $search->remote_url}}"
                    >
                    <div class="mb-1">
                        <div class="py-0 pt-3">
                            <div class="mt-auto">{{ $search->name }}</div>
                        </div>
                        
                    </div>
                </a>
                <div class="py-0">
                    <div class="text-md">{{ $search->description }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
