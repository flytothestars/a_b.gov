@extends('client.layouts.app')

@section('content')

    <div class="container">
        <div class="survey pb-5">
            @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.industrialEnterprise.IEcrumb'])
            <div class="survey__tab w-100 d-flex align-items-center text-center pt-2 mt-3">
                <div id="questionnaire" class="active pb-4 pt-2 w-100">
                    @lang('messages.pages.industrialEnterprise.headTitle')
                </div>
            </div>
            <div id="questionnaireContent">
                <div id="stepOne" class="survey__block mt-5">

                    <div class="header text-green"> @lang('messages.pages.financingPrograms.step1')</div>
                    <div
                            class="font-xl font-bold"> @lang('messages.pages.industrialEnterprise.chooseWhatInterestsYou')</div>
                    <div class="mt-4 d-flex align-items-center">
                        <input type="radio" id="stepone_1" class="radio " name="stepOne" value="0"/>
                        <label for="stepone_1"
                               class="ms-3"> @lang('messages.pages.industrialEnterprise.firstFromTwoTillOne')</label>
                    </div>

                    <div class="mt-4 pb-3 d-flex align-items-center">
                        <input type="radio" id="stepone_2" class="radio" name="stepOne" value="1"/>
                        <label for="stepone_2"
                               class="ms-3"> @lang('messages.pages.industrialEnterprise.secondFromZeroFive')</label>
                    </div>
                    <div id="firstSelection">
                        @include('client.services.industrialEnterprise.firstSelection')
                    </div>
                    <div id="secondSelection">
                        @include('client.services.industrialEnterprise.secondSelection')
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

			$('#firstSelection').hide()
			$('#secondSelection').hide()
            $('input[type=radio][name=stepOne]').prop('checked',false)


			$('input[type=radio][name=stepOne]').change(function () {
				if (this.value == 0) {
					$('#firstSelection').show()
					$('#secondSelection').hide()
				} else if (this.value == 1) {
					$('#firstSelection').hide()
					$('#secondSelection').show()
				}
			});

			if (window.location.hash) {
				switch (window.location.hash) {
					case ('#firstSelection'):
						$('input[type=radio][name=stepOne][value="0"]').prop('checked', true)
						$('#firstSelection').show()
						break
					case ('#secondSelection'):
						$('input[type=radio][name=stepOne][value="1"]').prop('checked', true)
						$('#secondSelection').show()
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