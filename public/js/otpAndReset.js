if(!window.resetPassword){
	window.resetPassword = {};
}
if(!window.resetPassword.form){
	window.resetPassword.form = {
		resetStage: 'phone', // phone, sms, confirm
	};
}
var phoneNumberMask = "+7 999 999 99 99";
var dupeFailCount = 0;



$(document).ready(function () {
	window.resetPassword.form.renderResetFormStage();
	$('#resetForm').submit(function (event) {
		event.preventDefault();
		window.resetPassword.form.submitResetForm();
	});

	$('#otpCountdownReset').click(function (event) {
		event.preventDefault();
		var phoneInput = $('#phoneNumber');
		var phone = window.resetPassword.form.getInputValue(phoneInput);
		window.resetPassword.firebaseVerification.phoneVerify(phone);
	});

	$('#phoneNumber').keyup(function () {
		$('#resetPhoneError').addClass('form_item--hidden');
		var phone = $('#phoneNumber').val();
		if (phone.length === 10 && $('#resetPhoneSubmitLoad').hasClass('form_item--hidden')) {
			$('#resetPhoneSubmit').removeAttr('disabled');
		} else {
			$('#resetPhoneSubmit').attr('disabled', 'disabled');
		}
	});

	$('#resetPasswordConfirmationInput').change(function (){
		$('#resetPasswordConfirmationError').addClass('form_item--hidden');
	});
	$('#resetPasswordInput').change(function (){
		$('#resetPasswordError').addClass('form_item--hidden');
	});
});
window.resetPassword.form.renderResetFormStage = function () {
	var stagePhone = $('.stage-phone');
	var stageSms = $('.stage-sms');
	var stageConfirm = $('.stage-confirm');

	stagePhone.addClass('form_item--hidden');
	stageSms.addClass('form_item--hidden');
	stageConfirm.addClass('form_item--hidden');

	if (window.resetPassword.form.resetStage === 'phone') {
		stagePhone.removeClass('form_item--hidden');
	}
	if (window.resetPassword.form.resetStage === 'sms') {
		stageSms.removeClass('form_item--hidden');

		$('#otpCountdownControl').removeClass('form_item--hidden');
		$('#otpCountdownReset').addClass('form_item--hidden');
	}
	if (window.resetPassword.form.resetStage === 'confirm') {
		stageConfirm.removeClass('form_item--hidden');
	}

	$('.phone-mask').inputmask(phoneNumberMask, {
		autoUnmask: true,
	});
}

window.resetPassword.form.getInputValue = function(input) {
	input.inputmask("+79999999999");
	var value = input.val();
	input.inputmask(phoneNumberMask, {
		autoUnmask: true,
	});
	return value;
}

window.resetPassword.form.handlePhoneVerification = function () {
	$('#resetPhoneSubmit').removeAttr('disabled');
	$('#resetPhoneSubmitLoad').addClass('form_item--hidden');
	var phoneInput = $('#phoneNumber');
	var phoneControl = $('#resetPhoneNumberControl');

	phoneInput.attr('readonly', 'readonly');
	phoneControl.addClass('input-control-disabled');
	window.resetPassword.form.resetStage = 'sms';
	window.resetPassword.form.renderResetFormStage();
	window.resetPassword.smsCodeManager.startCountdown();
}

window.resetPassword.form.handlePhoneVerificationFail = function (error) {
	$('#resetPhoneSubmit').removeAttr('disabled');
	$('#resetPhoneSubmitLoad').addClass('form_item--hidden')
	var phoneFail = $('#resetPhoneError');
	phoneFail.removeClass('form_item--hidden');
	if (
		error.code && error.code === 'auth/invalid-phone-number'
	) {
		if (window.resetPasswordValidationMessages) {
			phoneFail.text(window.resetPasswordValidationMessages.invalidPhone);
		} else {
			phoneFail.text(error.message);
			console.dir(error);
		}
	} else {
		if (window.resetPasswordValidationMessages) {
			phoneFail.text(window.resetPasswordValidationMessages.cantCheckPhone);
		} else {
			phoneFail.text(error.message);
			console.dir(error);
		}
		throw error;
	}
}

window.resetPassword.form.handleSmsCode = function () {
	window.resetPassword.form.renderResetFormStage();

	var token = $('#csrf').val();
	var phone = window.resetPassword.form.getInputValue($('#phoneNumber'));

	$.ajax(window.resetPasswordRoute, {
			method: 'POST',
			data: {
				'_token': token,
				'phone': phone,
				'reset-token': window.resetPassword.firebaseVerification.getUserToken(),
			},
			dataType: 'json',
			error: function (response) {
				if (
					response.status === 422
					&& response.responseJSON
					&& response.responseJSON.errors
				) {
					var fails = response.responseJSON.errors;
					if (fails['phone'] && fails['phone'].length) {
						$('#resetPhoneError').text(fails['phone'].shift()).removeClass('form_item--hidden');
					}
				}
			},
			success: function (response) {
				console.dir(response);
				window.resetPassword.form.resetStage = 'confirm';
				window.resetPassword.form.userId = response.userId;
				window.resetPassword.form.renderResetFormStage();
			},
		}
	);
}


window.resetPassword.form.handleSmsCodeFailed = function (fail) {
	if (
		fail.code === 'auth/invalid-verification-code'
		|| fail.code === 'auth/missing-verification-code'
	) {
		window.resetPassword.smsCodeManager.changeState('fail');
	} else if (fail.message === 'Recaptcha verification failed - DUPE') {
		if (dupeFailCount < 3) {
			var phone = window.resetPassword.form.getInputValue($('#phoneNumber'));
			window.resetPassword.firebaseVerification.phoneVerify(phone);
			window.resetPassword.form.handleSmsCode();
			dupeFailCount += 1;
		} else {
			console.error(fail);
			window.resetPassword.smsCodeManager.changeState('failed');
		}
	} else {
		console.error(fail);
		window.resetPassword.smsCodeManager.changeState('failed');
	}
}

window.resetPassword.form.submitResetForm = function () {
	var phoneInput = $('#phoneNumber');
	var phoneControl = $('#resetPhoneNumberControl');
	var phone = window.resetPassword.form.getInputValue(phoneInput);

	if (window.resetPassword.form.resetStage === 'phone') {
		phoneInput.removeAttr('disabled');
		phoneControl.removeClass('input-control-disabled');

		if (phone.length === 12) {
			$('#resetPhoneSubmit').attr('disabled', 'disabled');
			$('#resetPhoneSubmitLoad').removeClass('form_item--hidden');
			window.resetPassword.firebaseVerification.phoneVerify(phone);
		} else {
			var phoneFail = $('#resetPasswordPhoneError');
			phoneFail.removeClass('form_item--hidden');
			phoneFail.text(window.resetPasswordValidationMessages.invalidPhone);
		}
		return;
	}
	if (window.resetPassword.form.resetStage === 'sms') {
		var code = $('#otc-full').val();

		window.resetPassword.firebaseVerification.smsCodeVerify(code);
		return;
	}
	if (window.resetPassword.form.resetStage === 'confirm') {
		var password = $('#resetPasswordInput').val();
		var passwordConfirmation = $('#resetPasswordConfirmationInput').val();
		var token = $('#csrf').val();

		$.ajax(window.resetPasswordConfirmRoute, {
			method: 'POST',
			data: {
				'_token': token,
				'reset-password': password,
				'reset-confirm-password': passwordConfirmation,
				'userId': window.resetPassword.form.userId,
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
					if(fails['reset-confirm-password'] && fails['reset-confirm-password'].length) {
						$('#resetPasswordConfirmationError').text(fails['reset-confirm-password'].shift()).removeClass('form_item--hidden');
					}
					if(fails['reset-password'] && fails['reset-password'].length) {
						$('#resetPasswordError').text(fails['reset-password'].shift()).removeClass('form_item--hidden');
					}
				}
			},
			success: function (response){
				window.location = response.redirect;
			}
		});


	}
}
