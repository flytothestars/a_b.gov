@extends('client.layouts.app')

@section('content')

<div class="appeals-create">
    @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.Profile.view'])
    {{--<h1>@lang('messages.pages.Profile.view') </h1>--}}

    <ul class="nav nav-pills mb-3 appeal_tabs" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                @lang('messages.pages.Profile.view')
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                @lang('messages.pages.Profile.replyToTheAppeal')
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form action="{{route('appeals.update',['appeals_code'=>$appeal->id])}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class=" row">
                    <div class="col-12 px-0 col-md-6 pb-3 ">

                        <label for="first_name"
                            class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.appeals.distributor')
                        </label>
                        @if($appeal->distributor)
                        <p> @if($appeal->distributor->profile)
                            {{ $appeal->distributor->profile->first_name }}
                            @endif
                        </p>
                        @else
                        <p>Не назначен</p>
                        @endif
                        <label for="first_name"
                            class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.Profile.content')
                        </label>
                        <p>{{$appeal->content}}</p>
                        <label for="first_name"
                            class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.Profile.category')
                        </label>
                        <p>{{$appeal->category->name}}</p>
                        <label for="first_name"
                            class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.Profile.statutes')
                        </label>
                        <p>{{$appeal->clientAppealStatus->name}}</p>
                        <label for="first_name"
                            class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.Profile.dateOfCreation')
                        </label>

                        <p>{{$appeal->createDate}}</p>


                    </div>

                    <div class="col-12 px-0 col-md-6 pb-3 attached">
                        @if($iefiles)
                        <label for="first_name"
                            class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.appeals.attachedFiles')</label>

                        <ol>
                            @if($iefiles->file4)
                            <li><a href="{{url('storage/'.$iefiles->file1)}}" class="file" download>Форма заявки</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file2)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.four')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file3)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.five')</a><br>
                            </li>

                            <li><a href="{{url('storage/'.$iefiles->file4)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.six')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file5)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.seven')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file6)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.eight')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file7)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.nine')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file8)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.ten')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file9)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.eleven')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file10)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.twelve')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file11)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.thirteen')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file12)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.fourteen')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file13)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.secondSection.description.fifteen')</a><br>
                            </li>
                            @else
                            <li><a href="{{url('storage/'.$iefiles->file1)}}" class="file" download>Форма заявки</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file2)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.firstSection.description.six')</a><br>
                            </li>
                            <li><a href="{{url('storage/'.$iefiles->file3)}}" class="file"
                                    download>@lang('messages.pages.industrialEnterprise.firstSection.description.seven')</a><br>
                            </li>

                            @endif
                        </ol>
                        @else

                        <div class="row ">
                            <label for="first_name"
                                class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.appeals.attachedImages')
                            </label>
                            <div class="col-12 px-0 col-md-3 pb-3 ">

                                {{-- @foreach($appeal->files as $file)--}}
                                {{--   <img src="{{url('storage/'.$file->path)}}" class="__image" alt="alt">--}}
                                {{--@endforeach--}}
                                <img src="{{url('storage/appeals/1629654716_06443b5dabb95d911c641f06a98b3718_thumb.png')}}"
                                    class="attached__image" alt="alt">
                                <img src="{{url('storage/appeals/1629654866_e3bee88298aaa89be4189eaff1cb5214_thumb.png')}}"
                                    class="attached__image" alt="alt">
                            </div>
                            <div class="col-12 px-0 col-md-8 pb-3 " id="DisplayImg">

                            </div>
                        </div>

                        <div class="row appeals-create__file">
                            <label for="first_name"
                                class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang('messages.pages.appeals.attachedFiles')</label>
                            <a href="{{url('storage/appeals/1629694201_Документ Microsoft Word.docx')}}" class="file">
                                <div class="file__icon"><img src="/images/appeals/word-icon.png" alt="Wordpad"></div>
                                <div class="file__title">Документ Microsoft Word.docx</div>
                                <div class="file__download"><img src="/images/appeals/download-icon.svg"
                                        alt="Download icon"></div>
                            </a>
                            <a href="{{url('storage/appeals/1629694201_Документ Microsoft Word.docx')}}" class="file">
                                <div class="file__icon"><img src="/images/appeals/zip-icon.png" alt="Wordpad"></div>
                                <div class="file__title">4a0f09c8ddced8058458a799495ed9da.zip</div>
                                <div class="file__download"><img src="/images/appeals/download-icon.svg"
                                        alt="Download icon"></div>
                            </a>
                        </div>
                        @endif


                    </div>
                </div>
                <div class="row btn-draft-actions">

                    <button class="btn secondary" type="button" onclick="location.href='{{route('appeals.index')}}';"><i
                            class="fa fa-reply"></i>@lang('messages.action.comeBack') </button>
                    @if($appeal->clientAppealStatus->id==$draft)
                    <button class="btn secondary" type="button"
                        onclick="location.href='{{ route('appeals.edit',['appeals_code' => $appeal->id]) }}';"><i
                            class="fa fa-pen"></i>@lang('messages.action.change') </button>
                    <button class="btn secondary text-red" type="button"
                        onclick="location.href='{{ route('appeals.delete',['appeals_code' => $appeal->id]) }}';"><i
                            class="fa fa-trash"></i>@lang('messages.action.delete') </button>
                    <button type="button" class="btn primary me-0 text-white"
                        onclick="location.href='{{ route('appeals.send',['appeals_code' => $appeal->id]) }}';"><i
                            class="fa fa-paper-plane"></i>@lang('messages.action.send') </button>
                    @endif
                </div>


            </form>
        </div>


        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
                <div class="col-md-6">
                    <img style="margin-right: 20px;" width="60" src="{{ asset('images/appeals/user.png') }}"
                        align="left" alt="">
                    <p style="margin-bottom: 0px;">
                        <strong>{{ $appeal->distributor->profile->last_name . " " . $appeal->distributor->profile->first_name }}</strong>
                        (менеджер компании)
                    </p>
                    <p style="color: #ccc;">{{ $appeal->distributor->email }}</p>
                </div>

                <div class="col-md-6" style="text-align: right">
                    @if(is_null($appeal->updated_at))
                    <span style="color: #ccc;">{{ $appeal->updated_at }}</span>
                    @else
                    <span style="color: #ccc;">{{ optional($appeal->updated_at)->format('d.m.Y | H:i') }}</span>
                    @endif
                </div>

                <div class="col-md-6 mt-4">
                    @if($appeal->clientAppealStatus->id == \App\Repositories\Enums\ClientAppealStatusEnum::Completed)
                    <p>Ответ: <span class="success_answer">@lang('messages.pages.appeals.approved')</span></p>
                    @endif

                    @if($appeal->clientAppealStatus->id == \App\Repositories\Enums\ClientAppealStatusEnum::Rejected)
                    <p>Ответ: <span class="failed_answer">@lang('messages.pages.appeals.denied')</span></p>
                    @endif


                    <br>
                    <p style="overflow: auto;">
                        {{ $appeal->comment }}
                    </p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <strong>@lang('messages.pages.appeals.attachedFiles'):</strong>

                    @if(count($appeal->appealDocuments) > 0)
                    <div class="row appeals-create__file">
                        @foreach($appeal->appealDocuments as $appDoc)
                        <a href="{{url('storage/'.$appDoc->getFilePathAttribute())}}" class="file">
                            <div class="file__icon"><img src="/images/appeals/word-icon.png" alt="Wordpad"></div>
                            <div class="file__title">{{ $appDoc->description }}</div>
                            <div class="file__download"><img src="/images/appeals/download-icon.svg"
                                    alt="Download icon"></div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
document.querySelectorAll("img").forEach((item) => {
    item.addEventListener("click", (event) => {
        $('.attached__image').removeClass('active');
        const image = event.target.getAttribute("src");
        event.target.classList.toggle("active");
        console.log(image);
        $('#DisplayImg').html('<div class="thumbs-img" >  <img name="" src="' + image + '"/></div> ')
        //event.target.setAttribute("src", image);
    });
});
</script>
@stop