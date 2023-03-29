@extends('client.layouts.app')
@section('title', 'Документы')
@section('content')
<div class="docs">
        <div class="container my-4"> 
        <div class=" pt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('docs')}}">@lang('messages.general.main')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('messages.pages.docs.docs')</li>
                    </ol>
                </nav>
            </div>
              
        <div class="container-fluid mt-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="first-tab" data-bs-toggle="tab" data-bs-target="#first" type="button" role="tab" aria-controls="first" aria-selected="true">@lang('messages.pages.docs.landRelations')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="second-tab" data-bs-toggle="tab" data-bs-target="#second" type="button" role="tab" aria-controls="second" aria-selected="false">@lang('messages.pages.docs.licensesAndOtherPermits')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="third-tab" data-bs-toggle="tab" data-bs-target="#third" type="button" role="tab" aria-controls="third" aria-selected="false">@lang('messages.pages.docs.networkEngineering')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fourth-tab" data-bs-toggle="tab" data-bs-target="#fourth" type="button" role="tab" aria-controls="fourth" aria-selected="false">@lang('messages.pages.docs.building')</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row py-5">
                                @foreach ($files as $file)
                                    @if($file->type == 'landRelations')  
                                    <div class="col-12 col-sm-4 mb-3 pb-2">
                                        <a href="{{route('download', ['type' => $file->type, 'file' => $file->name]) }}" >    
                                            {{ substr($file->name, 0, -5) }}
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                        <div class="row py-5">
                                @foreach ($files as $file)
                                    @if($file->type == 'licensesAndOtherPermits')  
                                    <div class="col-12 col-sm-4 mb-3 pb-2">
                                    <a href="{{route('download', ['type' => $file->type, 'file' => $file->name]) }}" >    
                                            {{ substr($file->name, 0, -5) }}
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                        <div class="row py-5">
                                @foreach ($files as $file)
                                    @if($file->type == 'networkEngineering')  
                                    <div class="col-12 col-sm-4 mb-3 pb-2">
                                    <a href="{{route('download', ['type' => $file->type, 'file' => $file->name]) }}" >    
                                            {{ substr($file->name, 0, -5) }}
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                        <div class="row py-5">
                                @foreach ($files as $file)
                                    @if($file->type == 'building')  
                                    <div class="col-12 col-sm-4 mb-3 pb-2">
                                    <a href="{{route('download', ['type' => $file->type, 'file' => $file->name]) }}" >    
                                            {{ substr($file->name, 0, -5) }}
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
