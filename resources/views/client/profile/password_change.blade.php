@extends('client.layouts.app')

@section('content')
    <div class="header_sm text-uppercase">
    @lang('messages.pages.Profile.safety')
    </div>
    <div class="row px-0">
        <div class="col-12 col-lg-8 col-xl-5 px-0">
            <div class="profile-home">
                <form method="POST" id="passwordForm" action="{{ route('password.change.store') }}">
                    @csrf
                    <div class="pb-2 w-75">
                        <div class="mt-4 pt-2 text-start">
                            @include('client.components.profile.profileStandardInput', ['fieldName'=>'current_password', 'fieldText' => 'messages.pages.Profile.currentPassword', 'fieldValue'=> '', 'fieldType' => 'password', 'fieldImg' => true])
                        </div>
                        <div class="mt-4 pt-2 text-start">
                            @include('client.components.profile.profileStandardInput', ['fieldName'=>'new_password', 'fieldText' => 'messages.pages.Profile.newPassword', 'fieldValue'=> '','fieldType' => 'password', 'fieldImg' => true])
                        </div>
                        <div class="mt-4 pt-2 text-start">
                            @include('client.components.profile.profileStandardInput', ['fieldName'=>'new_confirm_password', 'fieldText' => 'messages.pages.Profile.repeatNewPassword', 'fieldValue'=> '','fieldType' => 'password', 'fieldImg' => true])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-6">
                            <a href="{{route('profile.info')}}" class="btn green btn_lg text-white mt-4">
                                @lang('messages-html-markup.action.comeBack')
                            </a>

                        </div>
                        <div class="col col-6">
                            <button class="btn primary btn_lg text-white mt-4" type="submit">
                                @lang('messages.action.changePassword')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('client.modals.modal_change_password')

@endsection

@section('js')
    <script>
        function hideOrShowInputValue(id){
            let inputElement = document.getElementById(id);
            let imgElement = document.querySelectorAll(`img[data-id="${id}"]`);
            if (inputElement.type === 'password') {
                inputElement.setAttribute('type', 'text');
                imgElement[0].setAttribute('src', '{{asset('/images/eye.svg')}}');
            } else {
                inputElement.setAttribute('type', 'password');
                imgElement[0].setAttribute('src', '{{asset('/images/closed-eye.svg')}}');
            }
        }

        $(document).ready(function () {
            $('#passwordForm').submit(function(event){
                event.preventDefault();
                let token = $('input[name="_token"]').val();
                let current_password = $('#current_password').val();
                let new_password = $('#new_password').val();
                let new_confirm_password = $('#new_confirm_password').val();

                $.ajax('{{ route("password.change.store") }}', {
                    method: 'POST',
                    data: {
                        '_token': token,
                        'current_password': current_password,
                        'new_password': new_password,
                        'new_confirm_password': new_confirm_password,
                    },
                    dataType: 'json',
                    error: function (response){
                        if(
                            response.status === 422
                            && response.responseJSON
                            && response.responseJSON.errors
                        )
                        {
                            let fails = response.responseJSON.errors;
                            let keys = ['current_password', 'new_password', 'new_confirm_password'];

                            for (let item of keys) {
                                if(fails.hasOwnProperty(item)) {
                                    $('#'+item+'_error').text(fails[item].shift()).removeClass('form_item--hidden');
                                } else {
                                    $('#'+item+'_error').addClass('form_item--hidden');
                                }
                            }
                        }
                    },
                    success: function (){
                        $('#current_password_error,#new_password_error,#new_confirm_password_error').addClass('form_item--hidden');
                        $('#changePasswordSuccessModal').modal('show');
                    }
                });
            });

            $('#closePasswordSuccessModal').click(function(){
                $('#changePasswordSuccessModal').modal('hide');
                window.location = '{{route('appeals.index')}}';
            });
        });
    </script>
@endsection
