@extends('client.layouts.app')
@section('title', 'AlmatyBusiness')
@section('content')
    <div class="bg-gray">
        <div class="container">
            <div class="pt-4">
                <div class="d-lg-block d-none">
                    @include('client.components.staticServices')
                </div>
                <div class="d-lg-none d-block">
                    <div class="serviceStatic-carousel owl-carousel owl-theme carousel">
                        @include('client.components.mobileStaticService')
                    </div>
                </div>
            </div>
            <div class="my-2 pt-2">
                @include('client.components.blockHeader', ['blockName' => 'messages.links.services', 'showAllUrl'=>
                route('services')])
            </div>
            <div class="service-carousel">
                <div id="service-carousel2" class="owl-carousel carousel  owl-theme">
                    @foreach ($serviceGroupList as $serviceGroup)
                        @if($serviceGroup->order_no != 5 && $serviceGroup->order_no != 6)
                            @include('client.components.serviceGroup', ['serviceGroup' => $serviceGroup])
                        @endif
                    @endforeach
                </div>
                <div class="owl-theme">
                    <div class="owl-controls">
                        <div class="custom-nav owl-nav"></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="serviceModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        {{-- <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                        <div class="modal-body">
                            <div class="appeals-img">
                                <img src="/images/appels-modal-img.png" alt="Appels Img">
                            </div>
                            <div class="appeals-text">
                                <div class="appeals-text__title">
                                    Бизнес-навигатор
                                </div>
                                <div class="appeals-text__description">
                                    Сервис Бизнес-навигатор скоро будет доступен для вас!

                                </div>
                            </div>
                        </div>
                        {{-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                    </div>
                </div>
            </div>

            <div class="my-2">
                @include('client.components.blockHeader', ['blockName' => 'messages.links.news_list', 'showAllUrl'=>
                route('news_list')])
            </div>
            <div class=" mb-5 pb-4">
                <div class="d-lg-block d-none">
                    @include('client.components.newsBlock', $newsList)
                </div>
                <div class="d-lg-none d-block">
                    <div class="newsBlock-carousel owl-carousel owl-theme carousel">
                        @include('client.components.mobileNewsBlock', $newsList)
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @include('client.components.partnerBlock', $partnerList)
    </div>



@endsection

@section('js')
    <script>
        $(document).ready(() => {

            /*var serviceGroup = $('.service-group:last');*/

            var serviceStatic = $('#serviceStatic');


            var myModal = new bootstrap.Modal(document.getElementById('serviceModal'))

            /*serviceGroup.on('click', function(e) {
                e.preventDefault();
                myModal.show();
            })*/

            serviceStatic.on('click', function(e) {
                e.preventDefault();
                myModal.show();
            })


            $('.drop__search').hide('400');
            $('#search').on('keyup', function(e) {
                var searchStr = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('search') }}',
                    dataType: 'json',
                    data: {
                        searchStr
                    },
                    success: function(res) {
                        $('.drop__search').html('');
                        $('.drop__search').show('400');
                        res.forEach(value => {
                            const item =
                                `<a href="${value.remote_url}" class="d-block search__item">${value.name}</a>`
                            $('.drop__search').append(item)
                        })
                    }
                })
            })

            $('.mobile-service').on('click', function(e) {
                e.preventDefault();
            })

            $(".mobile-service").dblclick(function(e) {
                var link = $(this).attr('href');
                window.open(link);
            });

            $('.serviceStatic-carousel, .newsBlock-carousel').owlCarousel({

                items: 1,
                loop: true,
                autoWidth: true,
                margin: 10,
            })

            $('#service-carousel2').owlCarousel({

                loop: false,

                responsive: {
                    0: {
                        items: 2,
                        margin: 10,
                        mouseDrag: true,
                        touchDrag: true,
                        pullDrag: true,
                        dots: true,
                    },
                    768: {
                        items: 4,
                        margin: 15,
                        mouseDrag: false,
                        touchDrag: false,
                        pullDrag: false,
                        nav: false,
                        dots: false,
                    },
                },

            });

            $(".next").click(function() {
                owl.trigger("owl.next");
            });
            $(".prev").click(function() {
                owl.trigger("owl.prev");
            });

            $('.partners-carousel').owlCarousel({
                nav: false,
                margin: 48,
                loop: false,
                items: 3,
                responsive: {
                    0: {
                        items: 2,
                        margin: 10
                    },
                    576: {
                        items: 3,
                        margin: 48
                    }
                }
            });

        })
    </script>
@endsection
