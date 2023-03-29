@extends('client.layouts.underConstruction')

@section('content')
    <div class="bg-gray h-100 d-flex align-items-center">
        <div class="container">
            <div class="work-on-progress mx-auto">
                <img class="work-on-progress__screw" src="{{asset('images/workOnProgress/small-screw.png')}}" alt="Small screw">
                <img class="work-on-progress__screw" src="{{asset('images/workOnProgress/middle-screw.png')}}" alt="Middle screw">
                <img class="work-on-progress__screw" src="{{asset('images/workOnProgress/big-screw.png')}}" alt="Big screw">
                <div class="work-on-progress__card card ">
                    <div class="card-title header">
                        Мы работаем над сайтом
                    </div>
                    <div class="card-text">
                        <div class="pb-4 font-md font-bold">Портал Almaty Business <span class="text-green">находится в разработке</span></div>
                        <img class="pt-4" src="{{asset('images/workOnProgress/work-on-progress.png')}}" alt="Work on progress">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
