function Generator() {
};

Generator.prototype.rand = Math.floor(Math.random() * 26) + Date.now();

Generator.prototype.getId = function () {
	return this.rand++;
};

var idGen = new Generator();

(function ($) {
	$.fn.smsCodeInput = function (options) {

		var defaults = {
			'numbersCount': 6,
			'countdownActive': true,
			'countdownValue': 60,
			'state': 'initial', // success | fail | initial

			'onSuccessFilledCallback': null,
			'numberText': 'number',
			'legendText': 'enter sms code',
			'invalidCodeMessage': 'invalid sms code',

			'countdownContainerId': null,
			'countdownSecondsControlId': null,
			'resetCountdownControlId': null,
			'inputFullValuedId': null,

			'hiddenClass': 'hidden',
			'containerClass': 'sms-code__container',
			'inputClass': 'sms-code__input',
			'labelClass': 'sms-code__label',
			'inputContainerClass': 'sms-code__input-container',
		};

		var settings = $.extend({}, defaults, options);

		if (this.length > 1) {
			this.each(function () {
				$(this).smsCodeInput(options)
			});
			return this;
		}

		var $this = this;
		var id = idGen.getId();
		var code = '';
		var ref;
		var timerActive = false;

		var buildControl = function () {
			$this.addClass('sms-code__container');
			var fiedset = $('<fieldset />');

			var labelContainer = $('<div>');
			var inputContainer = $('<div id="'
				+ 'sms-code__input-container-'
				+ id
				+ '" class="sms-code__input-container">');

			for (var i = 1; i <= settings.numbersCount; i++) {
				var inputId = 'sms-code__input-' + id + '-' + i;
				var input = $(
					'<input type="number" pattern="[0-9]*" value="" inputtype="numeric" maxlength="1"  class="'
					+ settings.inputClass
					+ '" id="' + inputId
					+ '" />'
				)

				inputContainer.append(input);

				var label = $(
					'<label class="sms-code__label" for="'
					+ input + '" >'
					+ settings.numberText + ' ' + i
					+ '</label>')

				labelContainer.append(label);
			}

			fiedset
				.append(
					$('<legend />').attr('id', 'legend-' + id).text(settings.legendText)
				)
				.append(
					labelContainer
				)
				.append(
					inputContainer
				)
			;

			$this.append(fiedset);
		}

		var subscribeInputEvents = function () {
			var inputs = $('#sms-code__input-container-' + id).children('input');
			var firstInputId = 'sms-code__input-' + id + '-1';
			var lastInputId = 'sms-code__input-' + id + '-' + settings.numbersCount;
			var firstInput = $('#' + firstInputId);
			var hiddenInput = $('#' + settings.inputFullValuedId);


			var lastKeyCode = 86;

			inputs
				.keydown(function (e) {
					var $this = $(this);

					var keyCode = e.originalEvent.keyCode;

					if (keyCode === 86 && lastKeyCode === 17) {
						return;
					}

					lastKeyCode = keyCode;

					if (keyCode === 16 || keyCode === 9 || keyCode === 224 || keyCode === 18 || keyCode === 17) {
						return;
					}

					if (keyCode === 46 && $this.attr('id') === lastInputId) {
						$this.val('');
					}

					if ((keyCode === 8 || keyCode === 37) && $this.prev().length && $this.prev().get(0).tagName === "INPUT") {
						$this.prev().select();
						if (keyCode === 8 && $this.attr('id')) {
							e.preventDefault();
							$this.val('');
						}
					} else if (keyCode !== 8 && $this.next()) {
						$this.next().select();
					}

					if ($this.val().length > 1) {
						var symbol = $this.val().split('').slice(0, 1).concat();
						$this.val(symbol);
						$this.next().select();
					}
				})
				.keyup(function () {
					var $this = $(this);

					if ($this.val().length > 1) {
						var symbol = $this.val().split('').slice(0, 1).concat();
						$this.val(symbol);
					}

					code = '';
					inputs.each(function () {
						if ($(this).val()) {
							code += $(this).val();
						} else {
							code += '*';
						}
					});

					ref.changeState('initial');

					if (hiddenInput.length) {
						hiddenInput.val(code);
					}

					if (
						code.indexOf('*') === -1
						&& code.length === settings.numbersCount
						&& settings.onSuccessFilledCallback
					) {
						settings.onSuccessFilledCallback(code, ref);
					}
				})
				.focus(function () {
					var $this = $(this);

					if ($this.attr('id') === firstInputId) {
						return;
					}

					if (!firstInput.val()) {
						firstInput.focus();
					}

					if (!$this.prev().val()) {
						$this.prev().focus();
					}
				});

			firstInput.get(0).addEventListener('input', function (e) {
				var data = e.data || this.value;
				if (!data) {
					return
				}
				if (data.length === 1) {
					return
				}

				for (var i = 0; i < data.length; i++) {

					var inputId = '#sms-code__input-' + id + '-' + (i + 1);

					if ($(inputId).length) {
						$(inputId).val(data[i]).select();
					}
				}
			});
		}

		this.startCountdown = function () {

			var control = $('#' + settings.countdownContainerId);
			var controlSeconds = $('#' + settings.countdownSecondsControlId);
			var controlReset = $('#' + settings.resetCountdownControlId);

			if (settings.countdownActive) {
				controlReset.addClass(settings.hiddenClass);
				control.removeClass(settings.hiddenClass);

				var countdownTime = settings.countdownValue;
				controlSeconds.text(countdownTime);


				var delayTime = new Date();
				delayTime.setSeconds(delayTime.getSeconds() + countdownTime);

				var timer;
				timer = setInterval(function () {
					var now = new Date().getTime();
					var distance = delayTime.getTime() - now;
					var countdown = Math.floor((distance % (1000 * 60)) / 1000);

					if (countdown === 0) {
						clearInterval(timer);
						controlReset.removeClass(settings.hiddenClass);
						control.addClass(settings.hiddenClass);
					}
					if (countdown >= 1) {
						controlSeconds.text(countdown);
					}

				}, 1000)
			} else {
				control.addClass(settings.hiddenClass);
				controlSeconds.addClass(settings.hiddenClass);
				controlReset.addClass(settings.hiddenClass);
			}
		}

		// public methods
		this.initialize = function () {

			ref = this;

			var initialized = $this.data('initialized');

			if (!initialized) {
				buildControl();
				subscribeInputEvents();
				$('#' + settings.countdownSecondsControlId).text(settings.countdownValue);
				$this.data('initialized', 'true');
			} else {
				console.error('sms-code-input already initialized!');
			}

			return this;
		};

		this.changeState = function (state) {
			settings.state = state;
			if (state === 'initial') {
				$this.find('#sms-code__input-container-' + id)
					.removeClass('failed')
					.removeClass('success')

				$this.find('#legend-' + id)
					.removeClass('failed')
					.text(settings.legendText);
			}
			if (state === 'success') {
				$this.find('#sms-code__input-container-' + id)
					.removeClass('failed')
					.addClass('success');

				$this.find('#legend-' + id)
					.removeClass('failed')
					.text(settings.legendText);
			}
			if (state === 'fail') {
				$this.find('#sms-code__input-container-' + id)
					.addClass('failed')
					.removeClass('success');

				$this.find('#legend-' + id)
					.text(settings.invalidCodeMessage)
					.addClass('failed');
			}

		};

		return this.initialize();
	}
})(jQuery);
