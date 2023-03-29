@extends('client.layouts.app')


@section('js')
    <script type="text/javascript" language="javascript">
		window.firebaseConfig = {
			apiKey: "{{config('firebase.frontend.apiKey')}}",
			authDomain: "{{config('firebase.frontend.authDomain')}}",
			projectId: "{{config('firebase.frontend.projectId')}}",
			storageBucket: "{{config('firebase.frontend.storageBucket')}}",
			messagingSenderId: "{{config('firebase.frontend.messagingSenderId')}}",
			appId: "{{config('firebase.frontend.appId')}}",
			measurementId: "{{config('firebase.frontend.measurementId')}}",
		};
		window.phoneNumberMask = "+7 999 999 99 99";
		window.resetPasswordValidationMessages = {
			invalidPhone: "{{trans('messages.pages.auth.invalidPhoneNumber')}}",
			insertCodeFromSMS: "{{trans('messages.pages.auth.insertCodeFromSMS')}}",
			invalidCode: "{{trans('messages.pages.auth.invalidCode')}}",
			cantCheckPhone: "{{trans('messages.pages.auth.cantCheckPhone')}}",
		};
		window.resetPasswordRoute = "{{route('password.validateToken')}}"
		window.resetPasswordConfirmRoute = "{{route('password.confirm')}}"
    </script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js" type="text/javascript"
            language="javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js" type="text/javascript"
            language="javascript"></script>
    <script src="{{ asset('js/firebase.js') }}" type="text/javascript" language="javascript"></script>
    <script src="{{ asset('js/sms-code-input.js') }}" type="text/javascript" language="javascript"></script>
    <script src="{{ asset('js/otpAndReset.js') }}" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" language="javascript">
		$(document).ready(function () {
			if (!window.resetPassword) {
				window.resetPassword = {};
			}
			var form = window.resetPassword.form;

			window.resetPassword.firebaseVerification = $('#recaptchaContainer')
				.firebaseVerification($.extend({}, window.firebaseConfig, {
					'phoneErrorCallback': form.handlePhoneVerificationFail,
					'phoneSuccessCallback': form.handlePhoneVerification,
					'smsCodeErrorCallback': form.handleSmsCodeFailed,
					'smsCodeSuccessCallback': form.handleSmsCode,
				}));

			window.resetPassword.smsCodeManager = $('#oneTimeCodeInput')
				.smsCodeInput({
					'countdownValue': 60,
					'onSuccessFilledCallback': function (code, ref) {
						form.submitResetForm();
					},
					'numberText': "{{trans('messages.pages.auth.number')}}",
					'legendText': "{{trans('messages.pages.auth.insertCodeFromSMS')}}",
					'invalidCodeMessage': "{{trans('messages.pages.auth.invalidCode')}}",

					'countdownContainerId': 'otcCountdownControl',
					'countdownSecondsControlId': 'otcCountDown',
					'resetCountdownControlId': 'otcCountdownReset',
					'inputFullValuedId': 'otc-full',

					'hiddenClass': 'hidden',
					'containerClass': 'sms-code__container',
					'inputClass': 'sms-code__input',
					'labelClass': 'sms-code__label',
					'inputContainerClass': 'sms-code__input-container',
				});

			$('#otcCountdownReset').click(function () {
				window.resetPassword.smsCodeManager.startCountdown();
				var code = $('#otc-full').val();
				window.resetPassword.firebaseVerification.smsCodeVerify(code);
			});

			var isResetPasswordConfirmationShowed = false;
			var isResetPasswordShowed = false;

			$('#resetConfirmationEyeIcon').click(function () {
				if (isResetPasswordConfirmationShowed) {
					$('#resetConfirmationEyeIcon').attr('src', '{{asset('/images/closed-eye.svg')}}');
					$('#resetPasswordConfirmationInput').prop('type', 'password');
					isResetPasswordConfirmationShowed = false
				} else {
					$('#resetConfirmationEyeIcon').attr('src', '{{asset('/images/eye.svg')}}');
					$('#resetPasswordConfirmationInput').prop('type', 'text');
					isResetPasswordConfirmationShowed = true
				}
			});

			$('#resetEyeIcon').click(function () {
				if (isResetPasswordShowed) {
					$('#resetEyeIcon').attr('src', '{{asset('/images/closed-eye.svg')}}');
					$('#resetPasswordInput').prop('type', 'password');
					isResetPasswordShowed = false
				} else {
					$('#resetEyeIcon').attr('src', '{{asset('/images/eye.svg')}}');
					$('#resetPasswordInput').prop('type', 'text');
					isResetPasswordShowed = true
				}
			});
		});
    </script>
@endsection



@section('content')
    <div class="auth-page py-4">
        <div class="container pt-5">
            <div class="row d-flex flex-wrap justify-content-center">
                <div class="col-12 col-lg-6">
                    <form class="form form_auth text-center h-100 d-none d-lg-block"
                          autocomplete="off"
                          id="resetForm"
                    >
                        <div class="form__title d-none d-lg-block pb-1">@lang('messages.pages.auth.forgotYourPassword')</div>
                        <div class="mt-4 pt-2 text-start" id="resetPhoneNumberControl">
                            <label for="phoneNumber"
                                   class="form-label form-label_line form-label_icon-prepend text-green">@lang('messages.pages.auth.phoneNumber')</label>
                            <div class="position-relative">
                                <input
                                        type="tel"
                                        id="phoneNumber"
                                        class="form-control input input_line input_icon-prepend phone-mask green"
                                        placeholder="@lang('messages.pages.auth.enterPhoneNumber')"
                                        autocomplete="nope"
                                        name="reset-phone"
                                >
                                <i class="fas fa-phone input__icon text-green"></i>
                            </div>
                            <span id="resetPhoneError" class="invalid-feedback text-start d-block form_item--hidden"
                                  role="alert"></span>
                        </div>

                        <div class="mt-4 pt-2 stage-sms form_item--hidden">
                            <div class="position-relative" id="oneTimeCodeInput"></div>
                            <p class="form__sub-title mt-3" id="otcCountdownControl">
                                {{trans('messages.pages.auth.canBeSentAgainAfter')}} <span
                                        id="otcCountDown">**</span> {{trans('messages.pages.auth.second')}}
                            </p>
                            <div id="otcCountdownReset" class="mt-3">
                                <a href="#" class="text-decoration-none">{{trans('messages.action.resend-sms')}}</a>
                            </div>
                            <input type="hidden" value="" id="otc-full">
                        </div>

                        <div class="mt-4 pt-2 stage-confirm form_item--hidden">
                            <div class="position-relative">
                                <input
                                        type="password"
                                        id="resetPasswordInput"
                                        class="form-control input input_line input_icon-prepend green"
                                        placeholder="@lang('messages.pages.auth.enterPassword')"
                                        name="reset-password"
                                >
                                <i class="fas fa-unlock input__icon text-green"></i>
                                <img class="input__icon input__icon_append"
                                     src="{{asset('/images/closed-eye.svg')}}" id="resetEyeIcon"/>
                            </div>
                            <span id="resetPasswordError"
                                  class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
                        </div>
                        <div class="mt-4 pt-2 stage-confirm form_item--hidden">
                            <div class="position-relative">
                                <input
                                        type="password"
                                        id="resetPasswordConfirmationInput"
                                        class="form-control input input_line input_icon-prepend green"
                                        placeholder="@lang('messages.pages.auth.confirmPassword')"
                                        name="reset-confirm-password"
                                >
                                <i class="fas fa-unlock input__icon text-green"></i>
                                <img class="input__icon input__icon_append"
                                     src="{{asset('/images/closed-eye.svg')}}" id="resetConfirmationEyeIcon"/>
                            </div>
                            <span id="resetPasswordConfirmationError"
                                  class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
                        </div>

                        <div class="stage-phone">
                            <button
                                    id="resetPhoneSubmit"
                                    type="submit"
                                    class="btn btn_lg green text-white mt-4 w-100"
                                    disabled
                            >
                                <span id="resetPhoneSubmitLoad"
                                      class="spinner-border spinner-border-sm form_item--hidden" role="status"
                                      aria-hidden="true"></span>
                                @lang('messages.action.verifyPhone')
                            </button>
                        </div>
                        <div class="stage-confirm form_item--hidden">
                            <button
                                    id="resetConfirmSubmit"
                                    type="submit"
                                    class="btn btn_lg green text-white mt-4 w-100"
                            >
                                <span id="resetConfirmLoad" class="spinner-border spinner-border-sm form_item--hidden"
                                      role="status" aria-hidden="true"></span>
                                @lang('messages.action.confirm')
                            </button>
                        </div>
                        <input id="csrf" type="hidden" value="{{csrf_token()}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
