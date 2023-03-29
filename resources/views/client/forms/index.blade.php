@extends('client.layouts.app')

@section('content')

    <div class="container">
        <div class="survey pb-5">
            @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.staticServices.selectionOfFinancing'])
            <div class="header pb-3"> @lang('messages.pages.staticServices.selectionOfFinancing')</div>


            <div class="survey__tab w-100 d-flex align-items-center text-center pt-2 mt-3">
                <div id="questionnaire" class="active pb-4 pt-2 w-100">
                    @lang('messages.pages.financingPrograms.viaAQuestionnaire')
                </div>
                <!-- <div id="ident" class=" pb-4 pt-2 w-100">
                    @lang('messages.pages.financingPrograms.ViaIINBIN')
                </div> -->
            </div>
            <div id="questionnaireContent">
                <div id="stepOne" class="survey__block mt-5">

                    <div class="header text-green"> @lang('messages.pages.financingPrograms.step1')</div>
                    <div
                            class="font-xl font-bold"> @lang('messages.pages.financingPrograms.chooseWhatInterestsYou')</div>
                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="stepone_1" class="radio " name="stepOne" value="0"/>
                        <label for="stepone_1"
                               class="ms-3"> @lang('messages.pages.financingPrograms.iWantToGetPreferentialLoans')</label>
                    </div>

                    <div class="mt-4 pb-3 d-flex align-items-center">
                        <input type="radio" id="stepone_2" class="radio" name="stepOne" value="1"/>
                        <label for="stepone_2"
                               class="ms-3"> @lang('messages.pages.financingPrograms.iWantToReceiveStateGrant')</label>
                    </div>
                    <div id="stateGrant">
                        @include('client.components.financingSelection.stateGrant')
                    </div>
                </div>
                <div id="stepTwo" class="survey__block mt-5 ">
                    <div class="header text-green"> @lang('messages.pages.financingPrograms.step2')</div>
                    <div class="font-xl font-bold"> @lang('messages.pages.financingPrograms.doYouHaveDeposit')</div>
                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="step_2_1" class="radio " name="stepTwo" value="0"/>
                        <label for="step_2_1"
                               class="ms-3"> @lang('messages.pages.financingPrograms.thereIsPledge')</label>
                    </div>
                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="step_2_2" class="radio " name="stepTwo" value="1"/>
                        <label for="step_2_2"
                               class="ms-3"> @lang('messages.pages.financingPrograms.noCollateral')</label>
                    </div>

                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="step_2_3" class="radio " name="stepTwo" value="2"/>
                        <label for="step_2_3"
                               class="ms-3"> @lang('messages.pages.financingPrograms.notEnoughCollateral')</label>
                    </div>
                    <div id="noCollateral">
                        @include('client.components.financingSelection.noCollateral')
                    </div>
                    <div id="notEnoughCollateral">
                        @include('client.components.financingSelection.notEnoughCollateral')
                    </div>
                </div>
                <div id="stepThree" class="survey__block mt-5">
                    <div class="header text-green"> @lang('messages.pages.financingPrograms.step3')</div>
                    <div class="font-xl font-bold"> @lang('messages.pages.financingPrograms.whatAmountAreYouInterestedIn')</div>
                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="step_3_1" class="radio " name="stepThree" value="0"/>
                        <label for="step_3_1"
                               class="ms-3"> @lang('messages.pages.financingPrograms.upToMillionTenge')</label>
                    </div>

                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="step_3_2" class="radio " name="stepThree" value="1"/>
                        <label for="step_3_2"
                               class="ms-3"> @lang('messages.pages.financingPrograms.fromMillionToMillionTenge')</label>
                    </div>
                    <div id="upToMillion">
                        @include('client.components.financingSelection.upToMillion')
                    </div>
                    <div id="fromMillion">
                        @include('client.components.financingSelection.fromMillion')
                    </div>
                </div>
            </div>

        </div>

        <!-- <div id="identContent">
            <div class="survey__block mt-5 w-100">
                <div class="row w-100">
                    <div class="col-7">
                        <div class="w-75">
                            <label for="phone"
                                   class="form-label form-label_line text-green "> @lang('messages.pages.financingPrograms.viaAQuestionnaire')
                                Введите
                                ИИН</label>
                            @if(!isset($fail))
                                @if(!isset($response))
                                    @if(isset($iin))
                                        <input class="red font-md form-control input input_line is-invalid" type="text"
                                               name="iinbin"
                                               id="iinbin" @if(isset($iin)) value="{{$iin}}"
                                               @endif placeholder="####-####-####">
                                        <div class="invalid-feedback">
                                            Не корректный ИИН
                                        </div>
                                    @else
                        <input class="green font-md form-control input input_line" type="text" name="iinbin" id="iinbin" @if(isset($iin)) value="{{$iin}}" @endif placeholder="####-####-####">
                        <span id="iinbin_error" class="invalid-feedback text-start d-block form_item--hidden" role="alert"> Не корректный ИИН</span>
                                    @endif
                                @else
                                    <input class="green font-md form-control input input_line" type="text" name="iinbin"
                                           id="iinbin" @if(isset($iin)) value="{{$iin}}"
                                           @endif placeholder="####-####-####">
                                @endif
                            @else
                                <input class="red font-md form-control input input_line is-invalid" type="text"
                                       name="iinbin"
                                       id="iinbin" @if(isset($iin)) value="{{$iin}}"
                                       @endif placeholder="####-####-####">
                                <div class="invalid-feedback">
                                    {{ $fail }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="d-flex align-items-center">
                            <img class="w-100 px-3" src="{{asset('/images/qicons/1.png')}}" alt="">
                            <img class="w-100 px-3" src="{{asset('/images/qicons/2.png')}}" alt="">
                            <img class="w-100 px-3" src="{{asset('/images/qicons/3.png')}}" alt="">
                        </div>

                        <div class="text-center font-md my-4 py-2">
                            @lang('messages.pages.financingPrograms.supportedBy')

                        </div>
                        <div class="text-center">
                            <button class="w-75 btn primary text-white" id="btnAction">
                                @lang('messages.action.pickUp')
                            </button>
                        </div>
                    </div>
                </div>


            </div>

            <div id="template">
                @if(isset($response))
                    @include('client.forms.survey', ['response' => $response])
                @endif
            </div>

        </div> -->

    </div>

    <div class="modal fade" id="anketa-modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-block anketa-modal__wrapper">
                    <div class="ankaeta-headline">Оставить заявку</div>
                    <div class="anketa-small">Оставьте Ваши данные и наши менеджера Вам перезвонят</div>
                    <form class="modal__form">
                        <div class="modal__form--hidden">
                        </div>
                        <label>
                            <input type="text" name="name" placeholder="Введите ваше имя" required>
                        </label>
                        <label>
                            <input type="tel" id="applicationPhone" name="phone" placeholder="Введите ваш телефон"
                                   required>
                        </label>
                        <label>
                            <input
                                    class="number-without-controls"
                                    type="number"
                                    id="applicationAmount"
                                    name="amount"
                                    placeholder="Введите сумму"
                                    required
                            >
                        </label>
                        <label>
                            <input
                                    class="number-without-controls"
                                    type="number"
                                    id="applicationTurnover"
                                    name="turnover"
                                    placeholder="Оборот компании"
                                    required
                            >
                        </label>
                        <div class="program-selected">
                            <div class="title">Выбранная программа</div>
                            <ul class="program-modal__select">
                            </ul>
                        </div>
                        <div class="program-selected">
                            <div class="title">Выбранные банки</div>
                            <ul class="bank-modal__select">
                            </ul>
                        </div>
                        <div class="btn-wrapper d-block w-100 mt-5 mb-5">
                            <button class="btn btn-primary text-center w-100 d-block" type="submit">Оставить заявку
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-block">
                    <div class="appeals-text text-center">
                        <div class="appeals-text__title font-bold mb-2">
                            Ваша заявка принята
                        </div>
                        <div class="appeals-text__description font-weight-medium mt-0">
                            С вами обязательно свяжется оператор в течение 3 дней
                        </div>
                    </div>
                    <div class="appeals-img m-auto">
                        <img src="/images/appels-modal-img.png" alt="Appels Img">
                    </div>

                    <div class="appeal-action text-center">
                        <button class="btn btn-primary w-100" id="modal-close">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="failModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-block">
                    <div class="appeals-text text-center">
                        <div class="appeals-text__title-fail font-bold mb-2">
                            К сожалению заявка не принята
                        </div>
						<div id="modal-fail-text" class="appeals-text__description font-weight-medium mt-0">
						</div>
                    </div>
                    <div class="appeals-img m-auto mt-5 mb-5">
                        <img src="/images/appels-modal-img-fail.png" alt="Appels Img">
                    </div>

                    <div class="appeal-action text-center">
                        <button class="btn btn-primary w-100" id="modal-fail-close">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
		(function ($) {
			$.fn.inputFilter = function (inputFilter) {
				return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
					if (inputFilter(this.value)) {
						this.oldValue = this.value;
						this.oldSelectionStart = this.selectionStart;
						this.oldSelectionEnd = this.selectionEnd;
					} else if (this.hasOwnProperty("oldValue")) {
						this.value = this.oldValue;
						this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
					} else {
						this.value = "";
					}
					$(this).val(this.value);
				});
			};
		}(jQuery));

		$(document).ready(function () {

			const myModal = new bootstrap.Modal(document.getElementById('anketa-modal'));
			const successModal = new bootstrap.Modal(document.getElementById('successModal'));
			const failModal = new bootstrap.Modal(document.getElementById('failModal'));

			$('#modal-close').on('click', function (e) {
				e.preventDefault();
				successModal.hide();
			})
			$('#modal-fail-close').on('click', function (e) {
				e.preventDefault();
				failModal.hide();
			})

			$('#btnAction').on('click', function () {
				var iin = $('#iinbin').val();
            if ((iin).length != 12 || !/^\d+$/.test(iin)) {
                $('#iinbin').addClass('is-invalid')
                    .removeClass('red')
                    .removeClass('green');
                $('#iinbin_error').removeClass('form_item--hidden');
                return false;
            } else {

                $('#iinbin_error').addClass('form_item--hidden');
				window.location.href = '{{route('financingFormIin')}}' + `/${iin}`;
            }
			});

			$('#iinbin').keydown(function () {
				$('#iinbin').removeClass('is-invalid')
					.removeClass('red')
					.addClass('green');
			});

			$('.btn-readmore').on('click', function (e) {
				e.preventDefault();
				const infoWrapper = $(this).parent().parent().parent();
				const description = infoWrapper.find('.program__info');
				description.toggleClass('active');
				if (description.hasClass('active')) {
					$(this).text('Скрыть подробнее');
				} else {
					$(this).text('Подробнее о программе');
				}
			});
			$('#applicationPhone').inputmask("+79999999999");
			$("#applicationAmount").inputFilter(function (value) {
				return /^\d*$/.test(value);
			});
			$("#applicationTurnover").inputFilter(function (value) {
				return /^\d*$/.test(value);
			});

			$('.select-program').on('submit', function (e) {
				e.preventDefault();

				const programType = $(this).find($('input[name^="program-type"]'));
				const programId = $(this).find($('input[name^="program-id"]'));
				const programName = $(this).find($('input[name^="program-name"]'));
				const programMinAmount = $(this).find($('input[name^="program-min-amount"]'));
				const programMaxAmount = $(this).find($('input[name^="program-max-amount"]'));
				$('#applicationAmount')
					.attr('min', programMinAmount.val())
					.attr('max', programMaxAmount.val());


				const banks = $(this).find($('input[name="banks"]:checked'));
				const banksArray = Array.from(banks);

				if (!banks.length) {
					return alert('Выберите банк');
				}

				myModal.show();


				const modalProgram = document.querySelector('.program-modal__select');
				const bankProgram = document.querySelector('.bank-modal__select');

				modalProgram.innerHTML = '';
				bankProgram.innerHTML = '';

				const liEl = document.createElement('li');
				liEl.textContent = programName.val();
				modalProgram.appendChild(liEl)

				const modalForm = document.querySelector('.modal__form--hidden');

				modalForm.innerHTML = '';

				const inputProgramType = document.createElement('input');
				inputProgramType.setAttribute('type', 'hidden');
				inputProgramType.setAttribute('name', 'program_type');
				inputProgramType.setAttribute('value', programType.val());
				modalForm.insertAdjacentElement('afterbegin', inputProgramType)

				const inputProgramId = document.createElement('input');
				inputProgramId.setAttribute('type', 'hidden');
				inputProgramId.setAttribute('name', 'program_id');
				inputProgramId.setAttribute('value', programId.val());
				modalForm.insertAdjacentElement('afterbegin', inputProgramId)

				const bin = $('#iinbin').val();
				const binEl = document.createElement('input');
				binEl.setAttribute('type', 'hidden');
				binEl.setAttribute('name', 'bin');
				binEl.setAttribute('value', bin);
				modalForm.insertAdjacentElement('afterbegin', binEl);

				banksArray.map(function (item) {
					const bank = document.createElement('input');
					bank.setAttribute('type', 'hidden');
					bank.setAttribute('name', 'banks[]');
					bank.setAttribute('value', item.value);

					const liEl = document.createElement('li');
					liEl.textContent = $(item).data('name');
					bankProgram.appendChild(liEl)

					modalForm.insertAdjacentElement('afterbegin', bank);
				})

			});

			$('.modal__form').on('submit', function (e) {
				e.preventDefault()
				const formData = $(this).serialize();
				console.dir(formData);

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				$.ajax({
					method: 'POST',
					url: '{{ route('api.msb.sendApplication') }}',
					data: formData,
					success: function (response) {
						if (response.status === 'ok') {
							myModal.hide();
							successModal.show();
						} else {
							$('#modal-fail-text').text(response.message);
							myModal.hide();
							failModal.show();
						}
					}
				})
			});

			$('#identContent').hide()
			$('#stateGrant').hide()
			$('#noCollateral').hide()
			$('#notEnoughCollateral').hide()
			$('#upToMillion').hide()
			$('#fromMillion').hide()
			$('#stepTwo').hide()
			$('#stepThree').hide()
            $('input[type=radio][name=stepOne]').prop('checked',false)
            $('input[type=radio][name=stepTwo]').prop('checked',false)
            $('input[type=radio][name=stepThree]').prop('checked',false)

            @if(isset($iin))
			$('#questionnaire').removeClass('active')
			$('#questionnaireContent').hide()
			$('#identContent').show()
			$('#ident').addClass('active')
            @endif

			$('#ident').click(function () {
				$('#questionnaire').removeClass('active')

				$('#questionnaireContent').hide()
				$('#identContent').show()
				$(this).addClass('active')
			})

			$('#questionnaire').click(function () {
				$('#ident').removeClass('active')

				$('#identContent').hide()
				$('#questionnaireContent').show()
				$(this).addClass('active')
			})


			$('input[type=radio][name=stepOne]').change(function () {
				if (this.value == 0) {
					$('#stateGrant').hide()
					$('#stepTwo').show()
				} else if (this.value == 1) {
					$('#stateGrant').show()
					$('#stepTwo').hide()
					$('#stepThree').hide()
				}
			});

			$('input[type=radio][name=stepTwo]').change(function () {
				if (this.value == 0) {
					$('#noCollateral').hide()
					$('#notEnoughCollateral').hide()
					$('#stepThree').show()
				} else if (this.value == 1) {
					$('#noCollateral').show()
					$('#notEnoughCollateral').hide()
					$('#stepThree').hide()
				} else if (this.value == 2) {
					$('#noCollateral').hide()
					$('#notEnoughCollateral').show()
					$('#stepThree').hide()
				}
			});
			$('input[type=radio][name=stepThree]').change(function () {
				if (this.value == 0) {
					$('#upToMillion').show()
					$('#fromMillion').hide()
				} else if (this.value == 1) {
					$('#upToMillion').hide()
					$('#fromMillion').show()
				}
			});

			if (window.location.hash) {
				switch (window.location.hash) {
					case ('#stateGrant'):
						$('input[type=radio][name=stepOne][value="1"]').prop('checked', true)
						$('#stateGrant').show()
						break
					case ('#noCollateral'):
						$('input[type=radio][name=stepOne][value="0"]').prop('checked', true)
						$('input[type=radio][name=stepTwo][value="1"]').prop('checked', true)
						$('#stepTwo').show()
						$('#noCollateral').show()
						break
					case ('#notEnoughCollateral'):
						$('input[type=radio][name=stepOne][value="0"]').prop('checked', true)
						$('input[type=radio][name=stepTwo][value="2"]').prop('checked', true)
						$('#stepTwo').show()
						$('#notEnoughCollateral').show()
						break
					case ('#upToMillion'):
						$('input[type=radio][name=stepOne][value="0"]').prop('checked', true)
						$('input[type=radio][name=stepTwo][value="0"]').prop('checked', true)
						$('input[type=radio][name=stepThree][value="0"]').prop('checked', true)
						$('#stepTwo').show()
						$('#stepThree').show()
						$('#upToMillion').show()
						break
					case ('#fromMillion'):
						$('input[type=radio][name=stepOne][value="0"]').prop('checked', true)
						$('input[type=radio][name=stepTwo][value="0"]').prop('checked', true)
						$('input[type=radio][name=stepThree][value="1"]').prop('checked', true)
						$('#stepTwo').show()
						$('#stepThree').show()
						$('#fromMillion').show()
						break
					default:
						break
				}
				$('html, body').animate({
					scrollTop: 0
				}, 0);
				$('html, body').animate({
					scrollTop: $(window.location.hash).offset().top - 120
				}, 1000);

			}
		})
    </script>

@endsection