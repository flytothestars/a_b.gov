@extends('client.layouts.app')

@section('content')
    <div class="auth-page py-4">
        <div class="container pt-5">
            <div class="row d-flex flex-wrap">
                <div class="col-12 col-lg-6">
                    <form class="form form_auth text-center h-100 form_contains-phone" autocomplete="off" method="post"
                        action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <input type="hidden" name="sign" value="">   

                        <div class="form__title d-lg-block d-none pb-1">@lang('messages.pages.auth.toComeIn')</div>
                        <div class="d-flex d-lg-none row">
                            <div class="col-5 text-center">
                                <div class="form__title d-inline pb-1 form__title_active">
                                    @lang('messages.pages.auth.toComeIn')</div>
                            </div>
                            <div class="col-7">
                                <div class="form__title d-inline pb-1" onclick="showRegisterForm()">
                                    @lang('messages.pages.auth.registration')</div>
                            </div>
                        </div>
                        <div class="form__sub-title mt-4 pt-2 pt-lg-0 mt-lg-2">
                            @lang('messages.pages.auth.enterYourPhoneNumberAndPassword')
                        </div>
                        <div class="mt-4 pt-2 text-start">
                            <label for="phone"
                                class="form-label form-label_line  form-label_icon-prepend text-green ">@lang('messages.pages.auth.phoneNumber')</label>
                            <div class="position-relative">
                                <input type="tel" id="phone"
                                    class="form-control input input_line input_icon-prepend green  phone-mask "
                                    placeholder="@lang('messages.pages.auth.enterPhoneNumber')" autocomplete="nope"
                                    name="phone">
                                <i class="fas fa-phone input__icon text-green"></i>
                            </div>
                            @error('phone')
                                <span class="invalid-feedback text-start d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-4 pt-2">

                            <div class="position-relative">
                                <input type="password" id="authPasswordInput"
                                    class="form-control  input input_line input_icon-prepend green "
                                    placeholder="@lang('messages.pages.auth.enterPassword')" autocomplete="new-password"
                                    name="password">
                                <i class="fas fa-unlock input__icon text-green"></i>
                                <img class="input__icon input__icon_append" src="{{ asset('/images/closed-eye.svg') }}"
                                    id="authEyeIcon" />
                            </div>
                            @error('password')
                                <span class="invalid-feedback text-start d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn_lg green text-white mt-4 w-100">
                        @lang('messages.pages.auth.buttonAuth')
                        </button>
                        <div class="mt-4">
                            <a href="{{ route('password.request') }}"
                                class="text-decoration-none">@lang('messages.pages.auth.forgotYourPassword')</a>
                        </div>
                        <a class="nav-link" id="pills-profile-tab" 
                    data-toggle="pill" href="#pills-profile" role="tab" id="selectP12File"  
                    onclick="selectKey('PKCS12');"  aria-controls="pills-profile" aria-selected="false">Авторизация по ЭЦП</a>
                        
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    @include('auth.registration-form')
                </div>
            </div>
        </div>
    </div>


@endsection
