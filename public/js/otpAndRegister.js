if(!window.registration){
	window.registration = {};
}
if(!window.registration.form){
	window.registration.form = {
		registerStage: 'phone', // phone, sms, confirm
	};
}
var phoneNumberMask = "+7 999 999 99 99";
var dupeFailCount = 0;



$(document).ready(function () {
	window.registration.form.renderRegisterFormStage();
	$('#registerForm').submit(function (event) {
		const is_eds =  $('input[name="sign_register"]').val();
		if(is_eds.length==0){
			event.preventDefault();
			window.registration.form.submitRegisterForm();
		}
	});

	$('#otpCountdownReset').click(function (event) {
		event.preventDefault();
		var phoneInput = $('#phoneNumber');
		var phone = window.registration.form.getInputValue(phoneInput);
		window.registration.firebaseVerification.phoneVerify(phone);
	});

	$('#phoneNumber').keyup(function () {
		$('#registrationPhoneError').addClass('form_item--hidden');
		var phone = $('#phoneNumber').val();
		if (phone.length === 10 && $('#registerPhoneSubmitLoad').hasClass('form_item--hidden')) {
			$('#registerPhoneSubmit').removeAttr('disabled');
		} else {
			$('#registerPhoneSubmit').attr('disabled', 'disabled');
		}

	});

	$('#registerPasswordConfirmationInput').change(function (){
		$('#registerPasswordConfirmationError').addClass('form_item--hidden');
	});
	$('#registerPasswordInput').change(function (){
		$('#registerPasswordError').addClass('form_item--hidden');
	});
});
window.registration.form.renderRegisterFormStage = function () {
	var stagePhone = $('.stage-phone');
	var stageSms = $('.stage-sms');
	var stageConfirm = $('.stage-confirm');

	stagePhone.addClass('form_item--hidden');
	stageSms.addClass('form_item--hidden');
	stageConfirm.addClass('form_item--hidden');

	if (window.registration.form.registerStage === 'phone') {
		stagePhone.removeClass('form_item--hidden');
	}
	if (window.registration.form.registerStage === 'sms') {
		stageSms.removeClass('form_item--hidden');

		$('#otpCountdownControl').removeClass('form_item--hidden');
		$('#otpCountdownReset').addClass('form_item--hidden');
	}
	if (window.registration.form.registerStage === 'confirm') {
		stageConfirm.removeClass('form_item--hidden');
	}

	$('.phone-mask').inputmask(phoneNumberMask, {
		autoUnmask: true,
	});
}

window.registration.form.getInputValue = function(input) {
	input.inputmask("+79999999999");
	var value = input.val();
	input.inputmask(phoneNumberMask, {
		autoUnmask: true,
	});
	return value;
}

window.registration.form.handlePhoneVerification = function () {
	$('#registerPhoneSubmit').removeAttr('disabled');
	$('#registerPhoneSubmitLoad').addClass('form_item--hidden');
	var phoneInput = $('#phoneNumber');
	var phoneControl = $('#registerPhoneNumberControl');

	phoneInput.attr('readonly', 'readonly');
	phoneControl.addClass('input-control-disabled');
	window.registration.form.registerStage = 'sms';
	window.registration.form.renderRegisterFormStage();
	window.registration.smsCodeManager.startCountdown();
}

window.registration.form.handlePhoneVerificationFail = function (error) {
	$('#registerPhoneSubmit').removeAttr('disabled');
	$('#registerPhoneSubmitLoad').addClass('form_item--hidden')
	var phoneFail = $('#registrationPhoneError');
	phoneFail.removeClass('form_item--hidden');
	if (
		error.code && error.code === 'auth/invalid-phone-number'
	) {
		if (window.registrationValidationMessages) {
			phoneFail.text(window.registrationValidationMessages.invalidPhone);
		} else {
			phoneFail.text(error.message);
			console.dir(error);
		}
	} else {
		if (window.registrationValidationMessages) {
			phoneFail.text(window.registrationValidationMessages.cantCheckPhone);
		} else {
			phoneFail.text(error.message);
			console.dir(error);
		}
		throw error;
	}
}

window.registration.form.handleSmsCode = function () {
	window.registration.form.registerStage = 'confirm';
	window.registration.form.renderRegisterFormStage();
}


window.registration.form.handleSmsCodeFailed= function (fail) {
	if (
		fail.code === 'auth/invalid-verification-code'
		|| fail.code === 'auth/missing-verification-code'
	) {
		window.registration.smsCodeManager.changeState('fail');
	} else if (fail.message === 'Recaptcha verification failed - DUPE') {
		if (dupeFailCount < 3) {
			var phone = window.registration.form.getInputValue($('#phoneNumber'));
			window.registration.firebaseVerification.phoneVerify(phone);
			window.registration.form.handleSmsCode();
			dupeFailCount += 1;
		} else {
			console.error(fail);
			window.registration.smsCodeManager.changeState('failed');
		}
	} else {
		console.error(fail);
		window.registration.smsCodeManager.changeState('failed');
	}
}

window.registration.form.submitRegisterForm = function () {
	var phoneInput = $('#phoneNumber');
	var phoneControl = $('#registerPhoneNumberControl');
	var phone = window.registration.form.getInputValue(phoneInput);

	if (window.registration.form.registerStage === 'phone') {
		phoneInput.removeAttr('disabled');
		phoneControl.removeClass('input-control-disabled');

		if (phone.length === 12) {
			$('#registerPhoneSubmit').attr('disabled', 'disabled');
			$('#registerPhoneSubmitLoad').removeClass('form_item--hidden');
			window.registration.firebaseVerification.phoneVerify(phone);
		} else {
			var phoneFail = $('#registrationPhoneError');
			phoneFail.removeClass('form_item--hidden');
			phoneFail.text(window.registrationValidationMessages.invalidPhone);
		}
		return;
	}
	if (window.registration.form.registerStage === 'sms') {
		var code = $('#otc-full').val();

		window.registration.firebaseVerification.smsCodeVerify(code);
		return;
	}
	if (window.registration.form.registerStage === 'confirm') {
		var password = $('#registerPasswordInput').val();
		var passwordConfirmation = $('#registerPasswordConfirmationInput').val();
		var token = $('#csrf').val();

		$.ajax(window.registrationRoute, {
			method: 'POST',
			data: {
				'_token': token,
				'register-phone': phone,
				'register-token': window.registration.firebaseVerification.getUserToken(),
				'register-password': password,
				'register-confirm-password': passwordConfirmation
			},
			dataType: 'json',
			error: function (response){
				if(
					response.status === 422
					&& response.responseJSON
					&& response.responseJSON.errors
				)
				{
					var fails = response.responseJSON.errors;
					if(fails['register-confirm-password'] && fails['register-confirm-password'].length) {
						$('#registerPasswordConfirmationError').text(fails['register-confirm-password'].shift()).removeClass('form_item--hidden');
					}
					if(fails['register-password'] && fails['register-password'].length) {
						$('#registerPasswordError').text(fails['register-password'].shift()).removeClass('form_item--hidden');
					}
					if(fails['register-phone'] && fails['register-phone'].length) {
						$('#registrationPhoneError').text(fails['register-phone'].shift()).removeClass('form_item--hidden');
					}
				}
			},
			success: function (){
				window.location = '/profile';
			}
		});
	}
}
