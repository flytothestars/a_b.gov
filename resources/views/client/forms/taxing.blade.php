@extends('client.layouts.app')

@section('content')

<div class="container taxing">
    <div class="survey pb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('messages.general.main')</a></li>
                <li class="breadcrumb-item"><a href="{{route('services')}}">@lang('messages.pages.services.services')</a></li>
                <li class="breadcrumb-item"><a href="{{url('/services/list/-/33244a88-10cd-4487-b549-32d31ac4ec4f')}}">@lang('messages.pages.services.types.Taxing')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('messages.pages.taxing.onlineCheckingBusinessForRisk')</li>
            </ol>
        </nav>

        <div class="header pb-3 taxing_header"> @lang('messages.pages.taxing.taxTrafficLight')</div>

        <div id="questionnaireContent">
            <div id="stepOne" class="survey__block mt-5 d-none d-sm-block" style="padding: 24px 48px 15px 48px">
                <div class="row">
                    <div class="col-md-6">
                        <div class="font-xl font-bold"> @lang('messages.pages.financingPrograms.toCheckTheDegreeOfRiskForYourBusinessAsATaxpayer')</div>
                        <div class="w-75 mt-4">
                            <label for="phone" class="form-label form-label_line text-green mb-15"> @lang('messages.pages.financingPrograms.enterIINBIN')</label>
                            <input style="opacity: 0.6;" class="green font-md form-control input input_line" type="text" name="bin_iin" id="bin_iin" placeholder="####-####-####">
                            <span id="bin_iin_error" class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
                            <span id="bin_iin_12">@lang('messages.pages.financingPrograms.bINIINMustContain12Characters')</span>
                        </div>

                        <div class="mt-5">
                            <button id="checkEmployerForRisk" class="w-75 btn primary text-white">@lang('messages.action.check')</button>
                        </div>

                        <div class="mt-4">
                            <span>@lang('messages.pages.financingPrograms.thisServiceWasImplementedWithTheSupportOfTheDGDofAlmaty')</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img class="w-100" src="{{ asset('images/serviceGroupBanner/taxing.png') }}" alt="">
                    </div>
                </div>
            </div>

            <div id="stepOne" class="survey__block d-block d-sm-none">
                <div class="row">
                    <div class="col-md-6">
                        <div class="font-xl font-bold taxing_fxl"> @lang('messages.pages.financingPrograms.toCheckTheDegreeOfRiskForYourBusinessAsATaxpayer')</div>
                        <img class="w-100" src="{{ asset('images/serviceGroupBanner/taxing.png') }}" alt="">
                        <div class="w-100 mt-4">
                            <label for="phone" class="form-label form-label_line text-green mb-15"> @lang('messages.pages.financingPrograms.enterIINBIN')</label>
                            <input style="opacity: 0.6;" class="green font-md form-control input input_line" type="text" name="bin_iin" id="bin_iin" placeholder="####-####-####">
                            <span id="bin_iin_error" class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
                            <span id="bin_iin_12">@lang('messages.pages.financingPrograms.bINIINMustContain12Characters')</span>
                        </div>

                        <div class="mt-2">
                            <button id="checkEmployerForRisk" class="w-100 btn primary text-white">@lang('messages.action.check')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header pb-4 mt-5 taxing_wns">
        @lang('messages.pages.financingPrograms.taxingWhatIs')
        </div>

        <div class="accordion" id="taxing">
            <div class="accordion-item high">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <span class="round"></span>@lang('messages.pages.financingPrograms.taxingHighHeader')
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                    @lang('messages.pages.financingPrograms.taxingHighContent')
                    </div>
                </div>
            </div>
            <div class="accordion-item medium">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        <span class="round"></span>@lang('messages.pages.financingPrograms.taxingMediumHeader')
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                    @lang('messages.pages.financingPrograms.taxingMediumContent')
                    </div>
                </div>
            </div>
            <div class="accordion-item low">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        <span class="round"></span>@lang('messages.pages.financingPrograms.taxingLowHeader')
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                    @lang('messages.pages.financingPrograms.taxingLowContent')
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('client.modals.modal_high_risk')

@include('client.modals.modal_medium_risk')

@include('client.modals.modal_low_risk')

@endsection

@section('js')
<script>
    $(document).ready(function() {
        const highModal = new bootstrap.Modal(document.getElementById('highModal'));
        const mediumModal = new bootstrap.Modal(document.getElementById('mediumModal'));
        const lowModal = new bootstrap.Modal(document.getElementById('lowModal'));

        $('#checkEmployerForRisk').click(function() {
            let bin_iin = $('#bin_iin').val();
            let bin_iin_error = $('#bin_iin_error');
            let bin_iin_12 = $('#bin_iin_12');

            if (bin_iin.length > 12 || bin_iin.length < 12) {
                bin_iin_12.addClass('hidden');
                bin_iin_error.html('<i class="fa fa-exclamation-circle" style="color: red; margin-right: 10px;" aria-hidden="true"></i> БИН/ИИН должен содержать 12 символов').removeClass('form_item--hidden');
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'GET',
                    url: '/online-business-risk-check/checking/' + bin_iin,
                    success: function(response) {
                        if (!bin_iin_error.hasClass('form_item--hidden')) {
                            bin_iin_error.html('').addClass('form_item--hidden');
                        }

                        if (bin_iin_12.hasClass('hidden')) {
                            bin_iin_12.removeClass('hidden');
                        }

                        if (response.status === 'high') {
                            highModal.show();
                            mediumModal.hide();
                            lowModal.hide();
                        }

                        if (response.status === 'medium') {
                            highModal.hide();
                            mediumModal.show();
                            lowModal.hide();
                        }

                        if (response.status === 'low') {
                            highModal.hide();
                            mediumModal.hide();
                            lowModal.show();
                        }
                    },
                    error: function(request, error) {
                        bin_iin_12.addClass('hidden');
                        bin_iin_error.html('<i class="fa fa-exclamation-circle" style="color: red; margin-right: 10px;" aria-hidden="true"></i>' + JSON.parse(request.responseText).message).removeClass('form_item--hidden');
                    }
                });
            }
        });
    });
</script>
@endsection