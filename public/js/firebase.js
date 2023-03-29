(function ($) {
	$.fn.firebaseVerification = function (options) {

		var configs = [
			'apiKey',
			'authDomain',
			'projectId',
			'storageBucket',
			'messagingSenderId',
			'appId',
			'measurementId',
		]

		var defaults = {
			'apiKey': null,
			'authDomain': null,
			'projectId': null,
			'storageBucket': null,
			'messagingSenderId': null,
			'appId': null,
			'measurementId': null,

			'phoneErrorCallback': null,
			'phoneSuccessCallback': null,
			'smsCodeErrorCallback': null,
			'smsCodeSuccessCallback': null,
		};

		var settings = $.extend({}, defaults, options);

		if (this.length > 1) {
			this.each(function () {
				$(this).smsCodeInput(options)
			});
			return this;
		}

		var $this = $(this);
		var phoneVerifyObject;
		var phoneVerified = false;
		var codeVerified = false;
		var idToken = null;

		var initRecaptcha = function () {
			firebase.auth().languageCode = 'ru';

			window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
				$this.attr('id'),
				{
					size: "invisible",
				}
			);
		};

		// public methods

		this.phoneVerify = function (phoneNumber) {
			window
				.firebase
				.auth()
				.signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier)
				.then(function (confirmationResult) {
					phoneVerified = true;
					phoneVerifyObject = confirmationResult;
					if (settings.phoneSuccessCallback) {
						settings.phoneSuccessCallback(confirmationResult);
					} else {
						console.log(confirmationResult);
					}
				})
				.catch(function (error) {
					window.recaptchaVerifier.reset();
					if (settings.phoneErrorCallback) {
						settings.phoneErrorCallback(error);
					} else {
						console.error(error);
					}
				});
		}

		this.smsCodeVerify = function (code) {
			if (phoneVerified) {
				phoneVerifyObject
					.confirm(code)
					.then(function (success) {
						codeVerified = true;
						var user = window.firebase.auth().currentUser;

						if (!user) {
							if (settings.smsCodeErrorCallback) {
								settings.smsCodeErrorCallback({
									code: 'custom/invalid-user',
								});
							} else {
								console.error({ code: 'custom/invalid-user' });
							}
						} else {
							user
								.getIdToken(true)
								.then(function (token) {
									idToken = token
									if (settings.smsCodeSuccessCallback) {
										settings.smsCodeSuccessCallback(success);
									} else {
										console.log(success);
									}
								});
						}
					})
					.catch(function (fail) {
						if (settings.smsCodeErrorCallback) {
							settings.smsCodeErrorCallback(fail);
						} else {
							console.error(fail);
						}
					});
			} else {
				console.error('cant verify sms code without phone verification');
			}
		}

		this.getUserToken = function () {
			if (!idToken) {
				console.error('cant get token without sms code verify');
				return;
			} else {
				return idToken;
			}
		};

		this.initialize = function () {
			if (window.firebaseInitialized) {
				console.error('firebase already initialized!');
				return;
			}

			if (!window.firebase || !window.firebase.auth) {
				console.error('firebase amd firebase.auth required!');
				return;
			}

			for (var i = 0; i < configs.length; i++) {
				var configName = configs[i];
				if (!settings[configName]) {
					console.error('firebase configuration ' + configName + ' required!');
					return;
				}
			}

			window.firebase.initializeApp({
				'apiKey': settings.apiKey,
				'authDomain': settings.authDomain,
				'projectId': settings.projectId,
				'storageBucket': settings.storageBucket,
				'messagingSenderId': settings.messagingSenderId,
				'appId': settings.appId,
				'measurementId': settings.measurementId,
			});

			firebase.auth().languageCode = 'ru';

			if (!window.recaptchaVerifier) {
				// IF you want to hide the recaptcha, use 'invisible' the size
				window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
					"recaptchaContainer",
					{
						size: "invisible",
					}
				);
			}

			window.firebaseInitialized = true;
			ref = this;
			initRecaptcha();

			return this;
		};

		return this.initialize();

	}
})(jQuery);
