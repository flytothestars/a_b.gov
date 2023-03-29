@extends('client.layouts.app')

@section('content')
    <div class="pt-5">
        <div class="container">
            <div class="row mx-0 ">
                <div class="col-12 col-md-6 mx-auto">
                    <form class="form text-center" style="padding-bottom: 50px">
                            <p> @lang('messages.pages.serviceForm.dearUserYourApplicationHasBeenSentToTheManager')</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
