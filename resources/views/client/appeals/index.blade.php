@extends('client.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />
@endsection

@section('content')

    <?php
    setlocale(LC_TIME, 'ru_RU.utf8');
    ?>
    <!--- MODAL  --->
    {{-- <div class="overlay">
    <div class="modal-wrapper">
        <div class="modal-body">
            <div class="appeals-img">
                <img src="/images/appels-modal-img.png" alt="Appels Img">
            </div>
            <div class="appeals-text">
                <div class="appeals-text__title">
                @lang('messages.pages.appeals.WeWillSoonDisplayAllYourRequests')
                </div>
                <div class="appeals-text__description">
                <p>@lang('messages.pages.appeals.YouCanFindOutTheStatusOfYourAppealByCallingTheNumber')
                   </p>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="appeals-wrapper">
        @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.Profile.myRequests'])

        <div class="appeals-head">
            <h2>@lang('messages.pages.Profile.myRequests')</h2>
            <a href="{{ route('appeals.create') }}" class="btn btn-primary appeals-button"><i
                    class="fa fa-plus-circle"></i>
                @lang('messages.action.submitAnAppeal')</a>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="dropdown">
                    <a style="background: #F1F3F8;color: #4078E4;text-transform: none;" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownCategoryLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Категория
                    </a>

                    <div class="dropdown-menu appeals_dropdown_menu appeals_dropdown_menu__category" aria-labelledby="dropdownCategoryLink">
                        <div class="form-check appeals_dropdown_menu_item">
                            <input class="form-check-input" @if(!isset($_GET['category'])) checked @endif type="checkbox" value="0" id="appealsAllCategory">
                            <label class="form-check-label" for="appealsAllCategory">
                                Все
                            </label>
                        </div>

                        @php
                            if(isset($_GET['category']) && !empty($_GET['category'])){
                                $arr_cat = explode(',', $_GET['category']);
                            } else {
                                $arr_cat = null;
                            }

                        @endphp

                        @foreach($categories as $category)
                        @if($category->order_no != 0 && $category->order_no != 7 && $category->order_no != 8)
                            <div class="form-check appeals_dropdown_menu_item">
                                <input class="form-check-input appealsCategoryItem" @if($arr_cat && in_array($category->id, $arr_cat)) checked @endif type="checkbox" value="{{ $category->id }}" id="{{ $category->id }}">
                                <label class="form-check-label" for="{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endif
                        @endforeach

                        <div class="form-group mt-2">
                            <button id="appealsDropdownCategoryButton" type="button" style="padding: 10px;" class="btn btn-primary">Применить</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button style="background: #F1F3F8;color: #000;text-transform: none;" class="btn btn-secondary " type="button" id="datepicker">
                    <span style="color: #4078E4;">Период  <i style="margin-right: 10px;" class="far fa-calendar-alt"></i></span>
                </button>
            </div>

            <div class="col-md-2">
                <div class="dropdown">
                    <a style="background: #F1F3F8;
    color: #4078E4;
    text-transform: none;" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownStatusLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Статус 
                    </a>

                    <div class="dropdown-menu appeals_dropdown_menu appeals_dropdown_menu__status" aria-labelledby="dropdownStatusLink">
                        <div class="form-check appeals_dropdown_menu_item">
                            <input class="form-check-input" @if(!isset($_GET['status'])) checked @endif type="checkbox" value="0" id="appealsAllStatuses">
                            <label class="form-check-label" for="appealsAllStatuses">
                                Все
                            </label>
                        </div>

                        @php
                            if(isset($_GET['status']) && !empty($_GET['status'])){
                                $arr_sta = explode(',', $_GET['status']);
                            } else {
                                $arr_sta = null;
                            }

                        @endphp

                        @foreach($statuses as $status)
                            <div class="form-check appeals_dropdown_menu_item">
                                <input class="form-check-input appealsStatusItem" @if($arr_sta && in_array($status->id, $arr_sta)) checked @endif type="checkbox" value="{{ $status->id }}" id="{{ $status->id }}">
                                <label class="form-check-label" for="{{ $status->id }}">
                                    {{ $status->name }}
                                </label>
                            </div>
                        @endforeach

                        <div class="form-group mt-2">
                            <button id="appealsDropdownStatusButton" type="button" style="padding: 10px;" class="btn btn-primary">Применить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="appeals-table">
            <table class="table-responsive">
                <thead>
                <tr>
                    <th> @lang('messages.pages.appeals.distributor') </th>
                    <th>@lang('messages.pages.appeals.contents') </th>
                    <th>@lang('messages.pages.appeals.category') </th>
                    <th>@lang('messages.pages.appeals.status') </th>
                    <th>@lang('messages.pages.appeals.creationDate') </th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($appeals as $appeal)
                    <tr>
                        <td class="profile-name">

                            @if($appeal->distributor)
                                <img src="/images/associated_photo.png" alt="Photo">
                                @if($appeal->distributor->profile)
                                    {{ $appeal->distributor->profile->last_name }}
                                    {{ $appeal->distributor->profile->first_name }}
                                    {{ $appeal->distributor->profile->second_name }}
                                @endif
                            @else
                                Не назначен
                            @endif
                        </td>
                        <td><span class="three-lines-only">{{ $appeal->content }}</span></td>
                        <td>{{ $appeal->category->name }}</td>
                        <td>{{ $appeal->clientAppealStatus->name }}</td>
                        @if(\Carbon\Carbon::now()->subDay(1) < $appeal->createDate)
                            <td>{{\Carbon\Carbon::parse($appeal->createDate)->addHours(6)->diffForHumans()}}</td>
                        @else
                            <td>{{\Carbon\Carbon::parse($appeal->createDate)->addHours(6)->translatedFormat('d F, Y')}}</td>
                        @endif
                        <td class="action-btn dropdown">
                            <a class="actionButton " data-bs-toggle="dropdown" id="dropdownMenuButton" href="#"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item dropdown_item_appeal_options"
                                   href="{{ route('appeals.show',['appeals_code' => $appeal->id]) }}">@lang('messages.action.view') </a>
                                @if($appeal->clientAppealStatus->id==$draft)
                                    <a style="color: #000; font-weight: bold;" class="dropdown-item dropdown_item_appeal_options"
                                       href="{{ route('appeals.edit',['appeals_code' => $appeal->id]) }}">@lang('messages.action.change') </a>
                                    <a class="dropdown-item dropdown_item_appeal_options"
                                       href="{{ route('appeals.send',['appeals_code' => $appeal->id]) }}">@lang('messages.action.send') </a>
                                    <a style="color: red; font-weight: bold;" class="dropdown-item dropdown_item_appeal_options dropdown_item_appeal_del"
                                       href="{{ route('appeals.delete',['appeals_code' => $appeal->id]) }}">@lang('messages.action.delete') </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>


            </table>
        </div>

        <div class="pagination">
            <a href="{{ $appeals->previousPageUrl() }}" class="pagination-prev @if($appeals->currentPage() == 1) pagination-item__disabled @endif"><i class="fa fa-angle-left"></i>@lang('messages.action.prev')  </a>
            <ul class="pagination-items">
                @for($i=1; $i<= $appeals->lastPage(); $i++)
                <li class="pagination-item @if($appeals->currentPage() == $i) pagination-item__active @endif">
                    <a
                        @if($appeals->currentPage() == $i)
                            href="#"
                        @elseif(!request()->has('page') && !empty($_SERVER['QUERY_STRING']))
                            href="{{ route('appeals.index') . '?' .$_SERVER['QUERY_STRING'] . "&page=$i" }}"
                        @elseif(request()->has('page') && !empty($_SERVER['QUERY_STRING']))
                            @php
                                $arr = explode('&', $_SERVER['QUERY_STRING']);
                                unset($arr[array_search("page=".request()->get('page'), $arr)]);
                            @endphp
                            href="{{ route('appeals.index') . '?' . implode('&', $arr) . "&page=$i" }}"
                        @else
                            href="{{ route('appeals.index') . "?page=$i" }}"
                        @endif
                        class="pagination-link">{{ $i }}
                    </a>
                </li>
                @endfor
            </ul>
            <a href="{{ $appeals->nextPageUrl() }}" class="pagination-next @if($appeals->currentPage() == $appeals->lastPage()) pagination-item__disabled @endif">@lang('messages.action.next') <i class="fa fa-angle-right"></i></a>
        </div>
        <!-- /.pagination -->

        @if(session()->has('successModal'))
            @include('client.modals.modal_success_appeal_create')
        @endif
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/daterangepicker.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js" integrity="sha512-tPXUMumrKam4J6sFLWF/06wvl+Qyn27gMfmynldU730ZwqYkhT2dFUmttn2PuVoVRgzvzDicZ/KgOhWD+KAYQQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

    @if(session()->has('successModal'))
        <script>
            (function($) {
                $(function() {
                    $('#createSuccessAppealModal').modal('show');
                });
            })(jQuery);
        </script>
    @endif

    <script>
        // let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
        //     keyboard: false,
        // })

        // myModal.show()
        $(document).ready(function(){
            $("#appealsAllCategory").click(function(){
                $('.appealsCategoryItem').prop('checked', false);
                window.location.href = "{{ route('appeals.index') }}";
            });

            $("#appealsAllStatuses").click(function(){
                $('.appealsStatusItem').prop('checked', false);
                window.location.href = "{{ route('appeals.index') }}";
            });

            $(".appealsCategoryItem").each(function(){
                $(this).click(function(){
                    if($(this).is(':checked')) {
                        $("#appealsAllCategory").prop('checked', false);
                        $(this).prop('checked', true);
                    }
                });
            });

            $(".appealsStatusItem").each(function(){
                $(this).click(function(){
                    if($(this).is(':checked')) {
                        $("#appealsAllStatuses").prop('checked', false);
                        $(this).prop('checked', true);
                    }
                });
            });

            $('#dropdownCategoryLink').click(function(){
                if ($('.appeals_dropdown_menu__category').hasClass('show')) {
                    $('.appeals_dropdown_menu__category').removeClass('show');
                } else {
                    $('.appeals_dropdown_menu__category').addClass('show');
                }
            });

            $('#dropdownStatusLink').click(function(){
                if ($('.appeals_dropdown_menu__status').hasClass('show')) {
                    $('.appeals_dropdown_menu__status').removeClass('show');
                } else {
                    $('.appeals_dropdown_menu__status').addClass('show');
                }
            });

            $('#appealsDropdownCategoryButton').click(function(){
                let params = "?category=";
                $(".appealsCategoryItem").each(function(){
                    if($(this).is(':checked')) {
                        params = params + $(this).val() + ",";
                    }
                });

                window.location.href = "{{ route('appeals.index') }}" + params.substring(0, params.length - 1);
            });

            $('#appealsDropdownStatusButton').click(function(){
                let params = "?status=";
                $(".appealsStatusItem").each(function(){
                    if($(this).is(':checked')) {
                        params = params + $(this).val() + ",";
                    }
                });

                window.location.href = "{{ route('appeals.index') }}" + params.substring(0, params.length - 1);
            });

            $('#datepicker').daterangepicker({
                "locale": {
                    "format": "DD.MM.YYYY",
                    "separator": " - ",
                    "applyLabel": "Принять",
                    "cancelLabel": "Отмена",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        'Вс','Пн','Вт','Ср','Чт','Пт','Сб'
                    ],
                    "monthNames": [
                        'Январь','Февраль','Март','Апрель','Май','Июнь', 'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'
                    ],
                    "firstDay": 1
                },
            });

            $('#datepicker').on('apply.daterangepicker', function(ev, picker) {
                let start = picker.startDate.format('YYYY-MM-DD');
                let end   = picker.endDate.format('YYYY-MM-DD');
                window.location.href = "{{ route('appeals.index') }}" + '?period=' + start + ',' + end;
            });

            $('.dropdown_item_appeal_del').each(function(e){
                $(this).click(function(event){
                    event.preventDefault();
                    if(window.confirm("Вы действительно хотите удалить?")){
                        window.location.href = $(this).attr('href');
                    }
                });
            });
        });
    </script>
@stop
