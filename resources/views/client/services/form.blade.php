@extends('client.layouts.app')

@section('content')
@if($serviceGroup->id != \App\Repositories\Enums\ServiceGroupEnum::IndustrialZone && $serviceGroup->id !=
\App\Repositories\Enums\ServiceGroupEnum::SmallIndustrialPark)
<div class="service-form-page py-4">
    <div class="container pt-5">
        <div class="row d-flex flex-wrap">
            <div class="col-12 col-md-6 mx-auto">
                <form class="form text-center form_contains-phone" autocomplete="off" method="post"
                    action="{{route('appeals.store')}}">
                    @csrf
                    <div class="form__title pb-1">{{$serviceGroup->getTranslationContent('name')}}</div>

                    <div class="form__sub-title pb-1">{{$serviceGroup->getTranslationContent('description')}}</div>
                    <input type="hidden" name="category_id" value="{{$serviceGroup->id}}" />


                    <div class="my-4 text-start">
                        <label for="question"
                            class="form-label form-label_line mb-2 font-bold text-primary">@lang('messages.pages.serviceForm.whatAreYouInterestedIn')</label>
                        <textarea class="form-control textarea" id="question" name="content"
                            rows="10">{{old('question')}}</textarea>
                        @error('question')
                        <span class="invalid-feedback text-start d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button class="btn btn_lg primary text-white w-100" type="submit"
                        {{(!Auth::user()->email || (Auth::user()->phone == Auth::user()->name))?  'disabled' :  ''}}>
                        @lang('messages.action.send')
                    </button>
                    @if(!Auth::user()->email || (Auth::user()->phone == Auth::user()->name))
                    <div class="invalid-feedback d-block mt-2">
                        @lang('messages.pages.serviceForm.PleaseFillInYourProfileInformation')
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="service-form-page py-4">
    <div class="container pt-5">
        <form class="form text-center form_contains-phone" enctype="multipart/form-data" autocomplete="off"
            method="post" action="{{route('appeals.store')}}">

            <div class="row d-flex flex-wrap">
                @csrf
                <div class="form__title pb-1">{{$serviceGroup->getTranslationContent('name')}}</div>

                <div class="form__sub-title pb-1">{{$serviceGroup->getTranslationContent('description')}}</div>
                <input type="hidden" name="category_id" value="{{$serviceGroup->id}}" />

                <div class="col-4 mx-auto">



                    <div class="my-4 text-start">
                        <textarea placeholder="Введите сообщение" class="form-control textarea" id="question"
                            name="content" rows="10">{{old('question')}}</textarea>
                        @error('question')
                        <span class="invalid-feedback text-start d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button class="btn btn_lg primary text-white w-100" type="submit"
                        {{(!Auth::user()->email || (Auth::user()->phone == Auth::user()->name))?  'disabled' :  ''}}>
                        @lang('messages.action.send')
                    </button>
                    @if(!Auth::user()->email || (Auth::user()->phone == Auth::user()->name))
                    <div class="invalid-feedback d-block mt-2">
                        @lang('messages.pages.serviceForm.PleaseFillInYourProfileInformation')
                    </div>
                    @endif
                </div>
                <div class="col-8 mx-auto">
                    <div class="my-4 text-start"><br>
                        <p><b><i>пример - "Удостоверение личности"</i></b></p>
                        @if($serviceGroup->id == 'b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67')
                        <ol class="list-marker">
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.firstSection.description.five')</label>
                                <input type="file" class="form-control" id="customFile" name="file1" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.firstSection.description.six')</label>
                                <input type="file" class="form-control" id="customFile" name="file2" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.firstSection.description.seven')</label>
                                <input type="file" class="form-control" id="customFile" name="file3" />
                            </li><br>
                        </ol>
                        @else
                        <ol class="list-marker">
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.three')</label>
                                <input type="file" class="form-control" id="customFile" name="file1" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.four')</label>
                                <input type="file" class="form-control" id="customFile" name="file2" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.five')</label>
                                <input type="file" class="form-control" id="customFile" name="file3" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.six')</label>
                                <input type="file" class="form-control" id="customFile" name="file4" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.seven')</label>
                                <input type="file" class="form-control" id="customFile" name="file5" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.eight')</label>
                                <input type="file" class="form-control" id="customFile" name="file6" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.nine')</label>
                                <input type="file" class="form-control" id="customFile" name="file7" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.ten')</label>
                                <input type="file" class="form-control" id="customFile" name="file8" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.eleven')</label>
                                <input type="file" class="form-control" id="customFile" name="file9" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.twelve')</label>
                                <input type="file" class="form-control" id="customFile" name="file10" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.thirteen')</label>
                                <input type="file" class="form-control" id="customFile" name="file11" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.fourteen')</label>
                                <input type="file" class="form-control" id="customFile" name="file12" />
                            </li><br>
                            <li>
                                <label class="form-label"
                                    for="customFile">@lang('messages.pages.industrialEnterprise.secondSection.description.fifteen')</label>
                                <input type="file" class="form-control" id="customFile" name="file13" />
                            </li><br>

                        </ol>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection