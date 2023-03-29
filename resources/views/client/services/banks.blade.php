@extends('client.layouts.app')

@section('content')

<div class="container pt-4">
    <div class="banks pb-5">
        @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.banks.header.'.$action_type])
        <!-- <h3 class="p1">Общие направления по возмещению ущерба. Видеоинструкция по возмещению ущерба для субъектов МСБ</h3>
        <p class="p1">
            <iframe width="100%" height="auto" src="https://www.youtube.com/embed/lwzhOH-xcgI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </p>
        <h3 class="p1">Возмещение ущерба по упрощенному механизму. Видеоинструкция по возмещению ущерба для субъектов МСБ по упрощенному механизму</h3>
        <p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/lwzhOH-xcgI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </p>
        <h3>Возмещение по видам ущерба: недвижимость и транспорт. Видеоинструкция по возмещению ущерба для субъектов МСБ на недвижимость и транспорт</h3>
        <p></p>
        <h3 class="p1">Возмещение ущерба через судебную экспертизу. Видеоинструкция по возмещению ущерба для субъектов МСБ через судебную экспертизу</h3>
        <p>&nbsp;</p> -->

        <div class="header pb-3"> @lang('messages.pages.banks.header.'.$action_type)</div>
        <div class="banks-block">
            <div class="font-xl font-bold"> Выберите банк партнер:</div>
            <div class="row mt-4">
                @foreach ($banks as $bank)
                @if($bank->bank_code != 'alfa' && $bank->bank_code != 'sber')
                <div class="col-12 col-sm-4 mb-3 pb-2">
                    <div class="banks__card   mb-3 ">
                        <div class="banks__card-img">
                            <img class="mt-3" src="/images/banks/{{$bank->bank_code}}.png" alt="centercredit Img">
                        </div>
                        <div class="card-body">
                            <div class="book">
                                <p><span>@lang('messages.pages.banks.paragraph1.'.$action_type):</span><span>{{$bank->paragraph1}}</span></p>
                                <p><span>@lang('messages.pages.banks.paragraph2.'.$action_type):</span><span>{{$bank->paragraph2}}</span></p>
                                <p><span>@lang('messages.pages.banks.paragraph3.'.$action_type)</span><span>{{$bank->paragraph3}}</span></p>
                            </div>


                            <a class="btn primary text-white  w-100 mt-3" href="{{$bank->url}}"> @lang('messages.pages.banks.action.'.$action_type)</a>
                            <a class="btn opacity-primary text-primary w-100 mt-3" href="{{ route('bankDetail', ['action_type'=>$action_type,'bank' => $bank->id]) }}">@lang('messages.action.moreDetails')</a>

                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection



