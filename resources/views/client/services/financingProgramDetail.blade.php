@extends('client.layouts.app')

@section('content')
<?php
$unicArrayPull = [];
?>
<div class="freeEducations">



    @include('client.components.financingPrograms.'.$finance_type)


    <div class="container">
        <br>
        @include('client.components.blockHeader', ['blockName' => 'messages.links.also', 'showAllUrl'=>
        route('services')])
        <div class=" pt-4 pb-4">
            <div id="education-carousel" class="  owl-carousel carousel  owl-theme">
                @foreach($otherPrograms as $program)
                @if(!in_array($program->name ,$unicArrayPull))
                <div class="col-12 mb-3 pb-2">
                    @include('client.components.programItem', ['program' => $program])
                </div>
                @php
                array_push($unicArrayPull, $program->name)
                @endphp

                @endif
                @endforeach

            </div>
            <div class="owl-theme pb-4">
                <div class="owl-controls">
                    <div class="custom-nav owl-nav"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script>
    $(document).ready(() => {
        $('#education-carousel').owlCarousel({

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
                    items: 3,
                    margin: 25,
                    mouseDrag: false,
                    touchDrag: false,
                    pullDrag: false,
                    nav: true,
                    dots: true,
                },
            },

        });

        $(".next").click(function() {
            owl.trigger("owl.next");
        });
        $(".prev").click(function() {
            owl.trigger("owl.prev");
        });

    })
</script>
@endsection