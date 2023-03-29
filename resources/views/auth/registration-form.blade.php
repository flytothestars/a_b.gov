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
		window.registrationValidationMessages = {
			invalidPhone: "{{trans('messages.pages.auth.invalidPhoneNumber')}}",
			insertCodeFromSMS: "{{trans('messages.pages.auth.insertCodeFromSMS')}}",
			invalidCode: "{{trans('messages.pages.auth.invalidCode')}}",
			cantCheckPhone: "{{trans('messages.pages.auth.cantCheckPhone')}}",
		};
		window.registrationRoute = "{{route('register')}}"
    </script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js" type="text/javascript" language="javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js" type="text/javascript" language="javascript"></script>
    <script src="{{ asset('js/firebase.js') }}" type="text/javascript" language="javascript"></script>
    <script src="{{ asset('js/sms-code-input.js') }}" type="text/javascript" language="javascript"></script>
    <script src="{{ asset('js/otpAndRegister.js') }}" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" language="javascript">
		$(document).ready(function () {
			if(!window.registration){
				window.registration = {};
            }
			var form = window.registration.form;

			window.registration.firebaseVerification = $('#recaptchaContainer')
                .firebaseVerification($.extend({}, window.firebaseConfig, {
					'phoneErrorCallback': form.handlePhoneVerificationFail,
					'phoneSuccessCallback': form.handlePhoneVerification,
					'smsCodeErrorCallback': form.handleSmsCodeFailed,
					'smsCodeSuccessCallback': form.handleSmsCode,
                }));

            window.registration.smsCodeManager = $('#oneTimeCodeInput')
                .smsCodeInput({
                    'countdownValue': 60,
                    'onSuccessFilledCallback': function (code, ref) {
						form.submitRegisterForm();
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

            $('#otcCountdownReset').click(function (){
				window.registration.smsCodeManager.startCountdown();
				var code = $('#otc-full').val();
				window.registration.firebaseVerification.smsCodeVerify(code);
            });
		});
    </script>
@endsection

<form class="form form_auth text-center h-100 d-none d-lg-block"
      autocomplete="off"
      method="post"
      action="{{ route('register') }}"
      id="registerForm"
>

@csrf

    <input type="hidden" name="sign_register" value="">

    <div class="form__title d-none d-lg-block pb-1">@lang('messages.pages.auth.notRegistered')</div>
    <div class="d-flex d-lg-none row">
        <div class="col-5 text-center">
            <div class="form__title d-inline pb-1" onclick="showLoginForm()">@lang('messages.pages.auth.toComeIn')</div>
        </div>
        <div class="col-7">
            <div class="form__title d-inline pb-1 form__title_active">@lang('messages.pages.auth.registration')</div>
        </div>
    </div>
    <div class="form__sub-title mt-4 pt-2 pt-lg-0 mt-lg-2">@lang('messages.pages.auth.toUseAllServicesAndCapabilitiesOfThePortalYouNeedToRegister')
    </div>
    <div class="mt-4 pt-2 text-start" id="registerPhoneNumberControl">
        <label for="phoneNumber" class="form-label form-label_line form-label_icon-prepend text-green">@lang('messages.pages.auth.phoneNumber')</label>
        <div class="position-relative">
            <input
                   type="tel"
                   id="phoneNumber"
                   class="form-control input input_line input_icon-prepend phone-mask green"
                   placeholder="@lang('messages.pages.auth.enterPhoneNumber')"
                   autocomplete="nope"
                   name="register-phone"
            >
            <i class="fas fa-phone input__icon text-green"></i>
        </div>
        <span id="registrationPhoneError" class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
    </div>

    <div class="mt-4 pt-2 stage-sms form_item--hidden">
        <div class="position-relative" id="oneTimeCodeInput"></div>
        <p class="form__sub-title mt-3" id="otcCountdownControl">
            {{trans('messages.pages.auth.canBeSentAgainAfter')}} <span id="otcCountDown">**</span> {{trans('messages.pages.auth.second')}}
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
                   id="registerPasswordInput"
                   class="form-control input input_line input_icon-prepend green"
                   placeholder="@lang('messages.pages.auth.enterPassword')"
                   name="register-password"
            >
            <i class="fas fa-unlock input__icon text-green"></i>
            <img class="input__icon input__icon_append"
                 src="{{asset('/images/closed-eye.svg')}}" id="registerEyeIcon"/>
        </div>

        <span id="registerPasswordError" class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
    </div>
    <div class="mt-4 pt-2 stage-confirm form_item--hidden">

        <div class="position-relative">
            <input
                   type="password"
                   id="registerPasswordConfirmationInput"
                   class="form-control input input_line input_icon-prepend green"
                   placeholder="@lang('messages.pages.auth.confirmPassword')"
                   name="register-confirm-password"
            >
            <i class="fas fa-unlock input__icon text-green"></i>
            <img class="input__icon input__icon_append"
                 src="{{asset('/images/closed-eye.svg')}}" id="registerConfirmationEyeIcon"/>
        </div>
        <span id="registerPasswordConfirmationError" class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
    </div>

    <div class="stage-phone">  
        <button
                id="registerPhoneSubmit"
                type="submit"
                class="btn btn_lg green text-white mt-4 w-100"
                data-bs-toggle="modal" data-bs-target="#exampleModal"
        >
            <span id="registerPhoneSubmitLoad" class="spinner-border spinner-border-sm form_item--hidden" role="status" aria-hidden="true"></span>
            @lang('messages.action.verifyPhone')
        </button>
        <!-- <button type="button" class="btn btn_lg green text-white mt-4 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
        @lang('messages.general.userAccess')
        </button> -->
    </div>
    <div class="stage-confirm form_item--hidden">
        <button
                id="registerConfirmSubmit"
                type="submit"
                class="btn btn_lg green text-white mt-4 w-100"
        >
            <span id="registerConfirmLoad" class="spinner-border spinner-border-sm form_item--hidden" role="status" aria-hidden="true"></span>
            @lang('messages.action.confirm')
        </button>   
    </div>
    
    <input id="csrf" type="hidden" value="{{csrf_token()}}">

    <a class="nav-link" id="pills-profile-tab" 
                    data-toggle="pill" href="#pills-profile" role="tab" id="selectP12File"  
                    onclick="selectKey2('PKCS12');"  aria-controls="pills-profile" aria-selected="false">Регистрация по ЭЦП</a>
        
</form>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">@lang('messages.general.userAccess')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
            @lang('messages.general.userAccessText')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Не согласен</button>
              <button 
                id="registerPhoneSubmit"
                type="submit"
                class="btn btn-primary" data-bs-dismiss="modal">Согласен</button>
            </div>
          </div>
        </div>
      </div>
<!-- 
      <script type="text/javascript">
                console.log("begin");
                let btnFalse = document.getElementById("falseDisabled");
                let input1 = document.getElementById("phoneNumber");
                let input2 = document.getElementById("registerPhoneSubmit");
                    function disabledInput(param){
                        input1.enable = param
                        input2.enable = param
                    };
                    disabledInput(true)

                    function falseDisabledInput(param2){
                        input1.enable = param2
                        input2.enable = param2
                    };
              </script> -->