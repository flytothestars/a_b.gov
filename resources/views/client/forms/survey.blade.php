@php
    /** @var $response \App\Services\MSB\IProgramByBinIinResponse */
@endphp

<div>
    <div class="anketa-wrapper mb-5">
        <div class="anketa-block mt-5 mb-5">
            <div class="font-xl font-bold mb-3">Информация о компании</div>
            <div class="survey__block">
                <div class="survey__block-text d-flex">
                    <strong>Наименование</strong>
                    <span>{{$responseIIN->obj->name}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>ИИН</strong>
                    <span>{{$responseIIN->obj->bin}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>Фамилия, имя, отчество руководителя</strong>
                    <span>{{$responseIIN->obj->fio}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>Вид деятельности</strong>
                    <span>{{$responseIIN->obj->okedName}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>Код ОКЭД</strong>
                    <span>{{$responseIIN->obj->okedCode}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>КАТО</strong>
                    <span>{{$responseIIN->obj->katoCode}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>Размер предприятия</strong>
                    <span>{{$responseIIN->obj->krpName}}</span>
                </div>
                <div class="survey__block-text d-flex">
                    <strong>Юридический адрес</strong>
                    <span>{{$responseIIN->obj->katoAddress}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="font-xl font-bold mb-3">Подходящие программы</div>
    <div class="anketa-program" id="program">
        @foreach($response->getPrograms() as $program)
            <div class="anketa-block mt-5 mb-5">
                <div class="survey__block">
                    <div class="program-items">
                        <div class="program-items__info-title">{{$program->toArray()['name']}}</div>
                        <div class="program-items__headline d-flex align-items-baseline justify-content-between">
                            <div class="program-items__icon">
                                <img src="/images/survey/headphone.svg" alt="Icon headphone">
                            </div>
                            <div class="text">
                                <h4>Оператор программы:</h4>
                                <p>{{$program->getOwnerName()}}</p>
                            </div>
                            <div class="img">
                                <img src="{{$program->getOwnerLogoUrl()}}" alt="{{$program->getOwnerName()}}">
                            </div>
                        </div>

                        <div class="program-items__wrapper">
                            <div class="program-items__info">
                                <div class="program-items__icon">
                                    <img src="/images/survey/money.svg" alt="Icon headphone">
                                </div>
                                <div class="text">
                                    <h4>Максимальная сумма:</h4>
                                    <p>{{$program->toArray()['max_amount']}}</p>
                                </div>
                            </div>
                            <div class="program-items__info">
                                <div class="program-items__icon">
                                    <img src="/images/survey/target.svg" alt="Icon headphone">
                                </div>
                                <div class="text">
                                    <h4>Цель займа:</h4>
                                    <p>{{$program->toArray()['target']}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="program-items__wrapper">
                            <div class="program-items__info">
                                <div class="program-items__icon">
                                    <img src="/images/survey/percent.svg" alt="Icon headphone">
                                </div>
                                <div class="text">
                                    <h4>{{$program->toArray()['period']['title']}}:</h4>
                                    <p>{{$program->toArray()['period']['value']}} %</p>
                                </div>
                            </div>
                            <div class="program-items__info">
                                <div class="program-items__icon">
                                    <img src="/images/survey/calendar.svg" alt="Icon headphone">
                                </div>
                                <div class="text">
                                    <h4>{{$program->toArray()['deadline']['title']}}:</h4>
                                    <p>{{$program->toArray()['deadline']['value']}} месяц(ев)</p>
                                </div>
                            </div>
                        </div>

                        <div class="program__info">
                            {!! $program->toArray()['description']  !!}
                        </div>

                        <form class="select-program">
                            <h4>Выберите банк партнер:</h4>
                            <input type="hidden" name="program-type" data-program="programType"
                                   value="{{$program->toArray()['program_type']}}">
                            <input type="hidden" name="program-name" data-program="programName"
                                   value='{{$program->toArray()['name']}}'>
                            <input type="hidden" name="program-min-amount" data-program="programName"
                                   value='{{$program->toArray()['min_amount']}}'>
                            <input type="hidden" name="program-max-amount" data-program="programName"
                                   value='{{$program->toArray()['max_amount']}}'>
                            <input type="hidden" name="program-id" data-program="programId"
                                   value="{{$program->toArray()['id']}}">
                            <div class="bank-items">
                                @foreach($program->getPartners() as $partner)
                                    <label>
                                        <input
                                            type="checkbox"
                                            name="banks"
                                            value="{{$partner->getPartnerId()}}"
                                            data-name="{{$partner->getPartnerName()}}"
                                        />
                                        <span>
                                            <img src="{{$partner->getPartnerLogo()}}"
                                                 alt="{{$partner->getPartnerName()}}"/>
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="btn-wrapper w-100">
                                <button class="btn btn-primary text-center program-action" type="submit">Оставить
                                    заявку
                                </button>
                                <button class="btn text-center btn-readmore" type="button">Подробнее о программе
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
