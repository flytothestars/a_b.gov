@extends('client.layouts.app')

@section('content')

<div class="container">
    <div class="survey pb-5">
        @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.service_tax.title'])
        <div class="header pb-3">@lang('messages.pages.service_tax.title')</div>


        <div class="survey__tab_service_first d-flex align-items-center text-center pt-2 mt-3">
            <div id="questionnaire" class="active pb-4 pt-2">
                @lang('messages.pages.service_tax.description')
            </div>
        </div>
        <div id="questionnaireContent">
            <div id="stepOne" class="survey__block mt-5">

                <div class="header text-green">@lang('messages.pages.service_tax.stepOne')</div>
                <div class="font-xl"><span class="font-bold">@lang('messages.pages.service_tax.stepOneTitle')</span><br>

                    <font size="2">
                        @lang('messages.pages.service_tax.stepOneDescription')
                    </font>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="stepone_1" class="radio " name="stepOne" value="0" />
                    <label for="stepone_1" class="ms-3">@lang('messages.pages.service_tax.access')</label>
                </div>

                <div class="mt-4 pb-3 d-flex align-items-center">
                    <input type="radio" id="stepone_2" class="radio" name="stepOne" value="1" />
                    <label for="stepone_2" class="ms-3">@lang('messages.pages.service_tax.reject')</label>
                </div>
                <div id="GeneralTaxFirst">
                    @include('client.services.new_services.general_tax')
                </div>
            </div>
            <div id="stepTwo" class="survey__block mt-5 ">
                <div class="header text-green">@lang('messages.pages.service_tax.stepTwo')</div>
                <div class="font-xl font-bold">@lang('messages.pages.service_tax.stepTwoTitle')</div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_2_1" class="radio " name="stepTwo" value="0" />
                    <label for="step_2_1" class="ms-3">ИП</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_2_2" class="radio " name="stepTwo" value="1" />
                    <label for="step_2_2" class="ms-3">ТОО</label>
                </div>
            </div>
            <div id="stepThreeIP" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepThree')</div>
                <div class="font-xl font-bold">@lang('messages.pages.service_tax.stepThreeTitle') (ИП)
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepThreeIP" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionOne')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_2" class="radio " name="stepThreeIP" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionTwo')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepThreeIP" value="2" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionThree')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepThreeIP" value="3" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionSeven')</label>
                </div>
                <div id="GeneralTaxThreeIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.gen_retail_modal')
                    </div>
                </div>
            </div>
            <div id="stepFourIP" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepFour')</div>
                <div class="font-xl"><span
                        class="font-bold">@lang('messages.pages.service_tax.stepFourTitle')</span><br>
                    <font size="2">@lang('messages.pages.service_tax.stepFourDescription')
                    </font>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepFourIP" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionFour')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFourIP" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionFive')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFourIP" value="2" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionSix')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFourIP" value="3" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionEight')</label>
                </div>
                <div id="SpecialTreatment">
                    @include('client.services.new_services.budget3528mrp')
                </div>
                <div id="SimplifiedTaxFourIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget24038mrp')
                    </div>
                </div>
                <div id="GenFixTaxFourIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget114184mrp')
                    </div>
                </div>
                <div id="GenFixTaxFourIPSecond">
                    @include('client.services.new_services.general_tax')
                </div>
            </div>
            <div id="stepFiveIP" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepFour')</div>
                <div class="font-xl"><span
                        class="font-bold">@lang('messages.pages.service_tax.stepFourTitle')</span><br>
                    <font size="2">
                        @lang('messages.pages.service_tax.stepFourDescription')
                    </font>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepFiveIP" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionFive')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFiveIP" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionSix')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFiveIP" value="2" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionEight')</label>
                </div>
                <div id="SimplifiedTaxFiveIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget24038mrp')
                        @include('client.services.new_services.retail_modal')
                    </div>
                </div>
                <div id="GenFixTaxFiveIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget114184mrp')
                        @include('client.services.new_services.retail_modal')
                    </div>
                </div>
                <div id="GeneralTaxFiveIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.gen_retail_modal')
                    </div>
                </div>
            </div>
            <div id="stepSixIP" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepFour')</div>
                <div class="font-xl"><span
                        class="font-bold">@lang('messages.pages.service_tax.stepFourTitle')</span><br>
                    <font size="2">
                        @lang('messages.pages.service_tax.stepFourDescription')
                    </font>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepSixIP" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionSix')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepSixIP" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionEleven')</label>
                </div>
                <div id="budget114184mrpSixIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget114184mrp')
                        @include('client.services.new_services.retail_modal')
                    </div>
                </div>
                <div id="GeneralTaxSixIP">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.gen_retail_modal')
                    </div>
                </div>
            </div>
            <div id="stepThreeTOO" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepThree')</div>
                <div class="font-xl font-bold">@lang('messages.pages.service_tax.stepThreeTitle') (ТОО)
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepThreeTOO" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionTwo')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepThreeTOO" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionThree')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepThreeTOO" value="2" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionSeven')</label>
                </div>
                <div id="GeneralTaxThreeTOO">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.gen_retail_modal')
                    </div>
                </div>
            </div>
            <div id="stepFourTOO" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepFour')</div>
                <div class="font-xl"><span
                        class="font-bold">@lang('messages.pages.service_tax.stepFourTitle')</span><br>
                    <font size="2">
                        @lang('messages.pages.service_tax.stepFourDescription')
                    </font>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepFourTOO" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionFive')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFourTOO" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionNine')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFourTOO" value="2" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionEight')</label>
                </div>
                <div id="SimplifiedFourTOO">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget24038mrp')
                        @include('client.services.new_services.retail_modal')
                    </div>
                </div>
                <div id="GeneralTaxFourTOO">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget114184mrp')
                        @include('client.services.new_services.retail_modal')
                    </div>
                </div>
                <div id="GenTaxFourTOO">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.gen_retail_modal')
                    </div>
                </div>

            </div>
            <div id="stepFiveTOO" class="survey__block mt-5">
                <div class="header text-green">@lang('messages.pages.service_tax.stepFour')</div>
                <div class="font-xl"><span
                        class="font-bold">@lang('messages.pages.service_tax.stepFourTitle')</span><br>
                    <font size="2">
                        @lang('messages.pages.service_tax.stepFourDescription')
                    </font>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_1" class="radio " name="stepFiveTOO" value="0" />
                    <label for="step_3_1" class="ms-3">@lang('messages.pages.service_tax.selectionNine')</label>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="radio" id="step_3_3" class="radio " name="stepFiveTOO" value="1" />
                    <label for="step_3_2" class="ms-3">@lang('messages.pages.service_tax.selectionEight')</label>
                </div>
                <div id="budget114184mrpFiveTOO">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.budget114184mrp')
                        @include('client.services.new_services.retail_modal')
                    </div>
                </div>
                <div id="GeneralTaxFiveTOO">
                    <hr class="text-black my-4 " />
                    <div class="text-md-center fw-bold fs-2">@lang('messages.pages.service_tax.availableMode')</div>
                    <div class="row py-5">
                        @include('client.services.new_services.gen_retail_modal')
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modals -->
<!-- treatment_3528 -->
<div class="modal fade" id="treatment_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('messages.pages.service_tax.special_treatment.title')
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
                @include('client.services.new_services.special_treatment')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">@lang('messages.pages.service_tax.close')</button>
                <!-- <button id="registerPhoneSubmit" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Закрыть</button> -->
            </div>
        </div>
    </div>
</div>
<!-- retail -->
<div class="modal fade" id="retail_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('messages.pages.service_tax.retail_tax.title')
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
                @include('client.services.new_services.retail_tax')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">@lang('messages.pages.service_tax.close')</button>
                <!-- <button id="registerPhoneSubmit" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Закрыть</button> -->
            </div>
        </div>
    </div>
</div>
<!-- mobile_application_3528 -->
<div class="modal fade" id="mobile_application_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('messages.pages.service_tax.special_mobile_tax.title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
                @include('client.services.new_services.special_mobile_application')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">@lang('messages.pages.service_tax.close')</button>
                <!-- <button id="registerPhoneSubmit" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Согласен</button> -->
            </div>
        </div>
    </div>
</div>
<!-- general_tax -->
<div class="modal fade" id="general_tax_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('messages.pages.service_tax.general_tax.title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
                @include('client.services.new_services.general_tax')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">@lang('messages.pages.service_tax.close')</button>
                <!-- <button id="registerPhoneSubmit" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Закрыть</button> -->
            </div>
        </div>
    </div>
</div>
<!-- simplified_tax -->
<div class="modal fade" id="simplified_tax_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('messages.pages.service_tax.simplified_tax.title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
                @include('client.services.new_services.simplified_tax')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">@lang('messages.pages.service_tax.close')</button>
                <!-- <button id="registerPhoneSubmit" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Закрыть</button> -->
            </div>
        </div>
    </div>
</div>
<!-- fixed_deduction -->
<div class="modal fade" id="fixed_deduction_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> @lang('messages.pages.service_tax.fixed_tax.title')
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
                @include('client.services.new_services.special_fixed_deduction')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">@lang('messages.pages.service_tax.close')</button>
                <!-- <button id="registerPhoneSubmit" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Закрыть</button> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
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

$(document).ready(function() {


    $('#identContent').hide()
    $('#GeneralTaxFirst').hide()
    $('#GeneralTaxThreeIP').hide()
    $('#SpecialTreatment').hide()
    $('#SimplifiedTaxFourIP').hide()
    $('#SimplifiedTaxFiveIP').hide()
    $('#GeneralTaxFiveIP').hide()
    $('#budget114184mrpSixIP').hide()
    $('#GeneralTaxSixIP').hide()
    $('#GeneralTaxThreeTOO').hide()
    $('#SimplifiedFourTOO').hide()
    $('#GeneralTaxFourTOO').hide()
    $('#GenFixTaxFiveIP').hide()
    $('#budget114184mrpFiveTOO').hide()
    $('#GeneralTaxFiveTOO').hide()
    $('#GenFixTaxFourIP').hide()
    $('#GenFixTaxFourIPSecond').hide()
    $('#stepTwo').hide()
    $('#GenTaxFourTOO').hide()
    $('#stepThreeIP').hide()
    $('#stepFourIP').hide()
    $('#stepFiveIP').hide()
    $('#stepSixIP').hide()
    $('#stepThreeTOO').hide()
    $('#stepFourTOO').hide()
    $('#stepFiveTOO').hide()
    $('input[type=radio][name=stepOne]').prop('checked', false)
    $('input[type=radio][name=stepTwo]').prop('checked', false)
    $('input[type=radio][name=stepThreeIP]').prop('checked', false)
    $('input[type=radio][name=stepFourIP]').prop('checked', false)
    $('input[type=radio][name=stepFiveIP]').prop('checked', false)
    $('input[type=radio][name=stepSixIP]').prop('checked', false)
    $('input[type=radio][name=stepThreeIP]').prop('checked', false)
    $('input[type=radio][name=stepThreeTOO]').prop('checked', false)

    @if(isset($iin))
    $('#questionnaire').removeClass('active')
    $('#questionnaireContent').hide()
    $('#identContent').show()
    $('#ident').addClass('active')
    @endif

    $('#ident').click(function() {
        $('#questionnaire').removeClass('active')

        $('#questionnaireContent').hide()
        $('#identContent').show()
        $(this).addClass('active')
    })

    $('#questionnaire').click(function() {
        $('#ident').removeClass('active')

        $('#identContent').hide()
        $('#questionnaireContent').show()
        $(this).addClass('active')
    })

    const clearSelection = (name) => {
        console.log(name);
        const radioBtns = document.querySelectorAll(
            "input[type='radio'][name='" + name + "']"
        );
        radioBtns.forEach((radioBtn) => {
            if (radioBtn.checked === true) radioBtn.checked = false;
        });
    }

    $('input[type=radio][name=stepOne]').change(function() {
        clearSelection('stepFiveTOO')
        clearSelection('stepFourTOO')
        clearSelection('stepThreeTOO')
        clearSelection('stepSixIP')
        clearSelection('stepFiveIP')
        clearSelection('stepFourIP')
        clearSelection('stepThreeIP')
        clearSelection('stepTwo')
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').show()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#stepTwo').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#stepTwo').show()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });

    $('input[type=radio][name=stepTwo]').change(function() {
        clearSelection('stepFiveTOO')
        clearSelection('stepFourTOO')
        clearSelection('stepThreeTOO')
        clearSelection('stepSixIP')
        clearSelection('stepFiveIP')
        clearSelection('stepFourIP')
        clearSelection('stepThreeIP')
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').show()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').show()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });

    $('input[type=radio][name=stepThreeIP]').change(function() {
        clearSelection('stepFourIP')
        clearSelection('stepFiveIP')
        clearSelection('stepSixIP')
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').show()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').show()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 2) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').show()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this
            .value == 3) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').show()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });
    $('input[type=radio][name=stepFourIP]').change(function() {
        clearSelection('stepFiveIP')
        clearSelection('stepSixIP')
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').show()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').show()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 2) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').show()
            $('#GenTaxFourTOO').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 3) {
            $('#GenFixTaxFourIPSecond').show()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });
    $('input[type=radio][name=stepFiveIP]').change(function() {
        clearSelection('stepSixIP')
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').show()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').show()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 2) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').show()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepSixIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });
    $('input[type=radio][name=stepSixIP]').change(function() {
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').show()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').show()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepThreeTOO').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });



    $('input[type=radio][name=stepThreeTOO]').change(function() {
        clearSelection('stepFiveTOO')
        clearSelection('stepFourTOO')
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFourTOO').show()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').show()
        } else if (this.value == 2) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').show()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFourTOO').hide()
            $('#stepFiveTOO').hide()
        }
    });
    $('input[type=radio][name=stepFourTOO]').change(function() {
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').show()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').show()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFiveTOO').hide()
        } else if (this.value == 2) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').show()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFiveTOO').hide()
        }
    });
    $('input[type=radio][name=stepFiveTOO]').change(function() {
        if (this.value == 0) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').show()
            $('#GeneralTaxFiveTOO').hide()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFourTOO').hide()
        } else if (this.value == 1) {
            $('#GenFixTaxFourIPSecond').hide()
            $('#GeneralTaxFirst').hide()
            $('#GeneralTaxThreeIP').hide()
            $('#SpecialTreatment').hide()
            $('#SimplifiedTaxFourIP').hide()
            $('#SimplifiedTaxFiveIP').hide()
            $('#GeneralTaxFiveIP').hide()
            $('#budget114184mrpSixIP').hide()
            $('#GeneralTaxSixIP').hide()
            $('#GeneralTaxThreeTOO').hide()
            $('#SimplifiedFourTOO').hide()
            $('#GeneralTaxFourTOO').hide()
            $('#GenFixTaxFiveIP').hide()
            $('#budget114184mrpFiveTOO').hide()
            $('#GeneralTaxFiveTOO').show()
            $('#GenFixTaxFourIP').hide()
            $('#GenTaxFourTOO').hide()
            $('#stepThreeIP').hide()
            $('#stepFourIP').hide()
            $('#stepFiveIP').hide()
            $('#stepSixIP').hide()
            $('#stepFourTOO').hide()
        }
    });


    if (window.location.hash) {
        switch (window.location.hash) {
            case ('#GeneralTaxFirst'):
                $('input[type=radio][name=stepOne][value="0"]').prop('checked', true)
                $('#GeneralTax').show()
                break
            case ('#GeneralTaxSecond'):
                $('input[type=radio][name=stepThreeTOO][value="1"]').prop('checked', true)
                $('#stepTwo').show()
                $('#stepThreeTOO').show()
                $('#GeneralTaxSecond').show()
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