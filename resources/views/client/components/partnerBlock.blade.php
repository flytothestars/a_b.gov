<div class="partners pb-1 pt-2">
    <div class="partners__inner">
        <div class="partners-carousel carousel owl-carousel owl-theme">
            @foreach ($partnerList->all() as $partner)
                <div class=" partners__logo carousel__items">
                    <a href="{{ $partner->url ?? '#' }}" target="_blank" title="{{ $partner->name }}"
                       class="partners__items">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($partner->files[0]->path) }}"
                             alt="{{ $partner->name }}"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex">
    </div>
</div>

