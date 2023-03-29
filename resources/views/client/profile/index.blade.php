@extends('client.layouts.app')

@section('content')
    <div class="profile-home">
        <form class="pe-xl-5" method="POST" id="profile-form-ajax" action="{{route('profile.store')}}">
            @csrf
            <div class="row px-xl-0">
                <div class="col-12 col-md-6 col-xl-4 pb-3 px-0">
                    <div class="header_sm text-uppercase">
                        @lang('messages.pages.Profile.data')
                    </div>
                    <div class="mt-3">
                        @include('client.components.profile.changeAvatar')
                    </div>

                    <div class="mt-4 pt-2 text-start">
                        @include('client.components.profile.profileStandardInput', ['fieldName'=>'first_name', 'fieldText' => 'messages.pages.Profile.name', 'fieldValue'=> optional($profile)->first_name , 'fieldType' => 'text'])
                    </div>
                    <div class="mt-4 pt-2 text-start">
                        @include('client.components.profile.profileStandardInput', ['fieldName'=>'last_name', 'fieldText' => 'messages.pages.Profile.surname', 'fieldValue'=> optional($profile)->last_name, 'fieldType' => 'text' ])
                    </div>
                    <div class="mt-4 pt-2 text-start">
                        @include('client.components.profile.profileStandardInput', ['fieldName'=>'second_name', 'fieldText' => 'messages.pages.Profile.middleName', 'fieldValue'=> optional($profile)->second_name, 'fieldType' => 'text' ])
                    </div>
                    <div class="mt-4 pt-2 text-start">
                        @include('client.components.profile.profileStandardInput', ['fieldName'=>'position', 'fieldText' => 'messages.pages.Profile.position', 'fieldValue'=> optional(optional($profile)->organization)->position, 'fieldType' => 'text' ])
                    </div>
                    <div class="mt-4 pt-2 text-start">
                        @include('client.components.profile.profileStandardInput', ['fieldName'=>'company_name', 'fieldText' => 'messages.pages.Profile.companyName', 'fieldValue'=> optional(optional($profile)->organization)->name, 'fieldType' => 'text' ])
                    </div>
                    <div class="mt-4 pt-2 text-start">
                        @include('client.components.profile.profileStandardInput', ['fieldName'=>'iin', 'fieldText' => 'messages.pages.Profile.bINIIN', 'fieldValue'=> optional(optional($profile)->organization)->iin, 'fieldType' => 'text'])
                    </div>
                    <div class="mt-4 pt-2 text-start">
                        <label for="industries_id"
                               class="form-label font-bold form-label_line text-primary mb-2 pb-1"> @lang('messages.pages.Profile.industryIndustry')</label>
                        <div class="position-relative">
                            <select class="form-control input input_line" name="industries_id">
                                <option value=""> @lang('messages.pages.Profile.industryIndustry')</option>
                                @foreach($industryList as $industry)
                                    <option
                                        value="{{ $industry->id }}" {{ (old("industries_id", optional($profile)->industries_id) ==optional($industry)->id ? "selected":"") }}>{{ optional($industry)->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('industries_id')
                        <span class="invalid-feedback text-start d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    {{--                    <div class="mt-4 pt-2 text-start">--}}
                    {{--                        @include('client.components.profile.profileStandardTextarea', ['fieldName'=>'description', 'fieldText' => 'Опишите текущую деятельность:', 'fieldValue'=> optional($profile)->organization->description, 'fieldType' => 'text' ])--}}
                    {{--                    </div>--}}
                </div>
                <div class="col-12 col-md-6 col-xl-4 offset-xl-2">
                    <div class="header_sm text-uppercase">
                        @lang('messages.pages.Profile.safety')
                    </div>
                    <a href="{{route('password.change.index')}}"
                       class="btn primary btn_lg text-white w-100 mt-4"> @lang('messages.action.changePassword')</a>

                    <div class="header_sm text-uppercase pt-5">
                        @lang('messages.pages.Profile.contacts')
                    </div>
                    <form method="POST">
                        <div class="pe-5 pb-2">
                            <div class="mt-4 pt-2 text-start">
                                <div class="mt-4 pt-2 text-start">
                                    <label for="phone"
                                           class="form-label font-bold form-label_line text-primary mb-2 pb-1"> @lang('messages.pages.Profile.phoneNumber')</label>
                                    <div class="position-relative">
                                        <input type="tel" id="phone"
                                               class="form-control input input_line phone-mask"
                                               placeholder=" @lang('messages.pages.Profile.phoneNumber')"
                                               autocomplete="nope" name="phone"
                                               value="{{Auth::user()->phone}}">
                                    </div>
                                    @error('phone')
                                    <span class="invalid-feedback text-start d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4 pt-2 text-start">
                                <label for="email"
                                       class="form-label font-bold form-label_line text-primary mb-2 pb-1"> @lang('messages.pages.Profile.email')</label>
                                <div class="position-relative">
                                    <input type="Email" id="email"
                                           class="form-control input input_line "

                                           placeholder=" @lang('messages.pages.Profile.email')" autocomplete="nope"
                                           name="email"
                                           value="{{Auth::user()->email}}">
                                </div>
                                @error('email')
                                <span class="invalid-feedback text-start d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="mt-4">
                <div class="row pe-0">
                    <div class="col-12 col-lg-4 col-md-6 ms-auto pe-0">
                        <button class="btn primary btn_lg text-white w-100"
                                type="submit"> @lang('messages.action.saveChanges')
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    {{-- {{$industryList}}--}}

    <!-- Modal -->
    <div class="modal fade" id="changeProfileSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none;">
                    <button type="button" id="closeProfileSuccessModal" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" style="display: block; padding: 0px 0px 30px;">
                    <div><strong
                            style="color: #6CA841; font-weight: bold; font-size: 30px;">@lang('messages.pages.Profile.thankYou')</strong>
                    </div>
                    <div class="mt-1"
                         style="font-size: 20px;color: #000;">@lang('messages.pages.Profile.yourDataHasBeenSaved')</div>
                    <div class="mt-2">
                        <img src="{{asset('images/done2.png')}}" alt="done">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".profile-wrapper .profile-content").hide().prev().click(function () {
            $(this).parents(".profile-wrapper").find(".profile-content").not(this).slideUp().prev().removeClass(
                "active");
            $(this).next().not(":visible").slideDown().prev().addClass("active");
        });

        $(document).ready(function () {
            $('#profile-form').submit(false);
            $('#profile-form-ajax').submit(function (event) {
                console.log('dd');
                event.preventDefault();
                var form = $(this);
                var post_data = form.serializeArray();
                var form_data = {};
                post_data.forEach((groups, data) => {

                    form_data[groups.name] = groups.value;


                });


                $.ajax('{{ route("profile.store") }}', {
                    method: 'POST',
                    data: form_data,
                    dataType: 'json',
                    error: function (response) {
                        if (
                            response.status === 422 &&
                            response.responseJSON &&
                            response.responseJSON.errors
                        ) {
                            let fails = response.responseJSON.errors;
                            let keys = Object.keys(fails);

                            for (let item of keys) {
                                if (fails.hasOwnProperty(item)) {
                                    $('#' + item + '_error').text(fails[item].shift()).removeClass('form_item--hidden');
                                } else {
                                    $('#' + item + '_error').addClass('form_item--hidden');
                                }
                            }
                        }
                    },
                    success: function (msg) {
                        $('#changeProfileSuccessModal').modal('show');
                    }
                });
            });

            $('#closeProfileSuccessModal').click(function () {
                $('#changeProfileSuccessModal').modal('hide');
                window.location = "{{route('profile.info')}}";
            });
        });
    </script>
@stop
