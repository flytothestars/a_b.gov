<div class="card  item-card item-card_financing-program mb-3 border rounded">
    <a href="{{$program->remote_url ? $program->remote_url : route('services.form', ['service_groups_id' => $program->service_group_id])}}" class="text-decoration-none text-black">
    <img src="{{ asset('/images/front/' . $program->files->firstWhere('file_type', 'thumbnail')->path)}}" class="card-img-top" style="object-fit: cover" alt="{{$program->name}}">
        <div class="card-body">
            <div class="item-card__small-header">
                <small class="text-green">{{optional($program->serviceCategory)->getTranslationContent('name')}}</small>
            </div>
            <div class="item-card__header mt-2">
                {{$program->getTranslationContent('name')}}
            </div>
            <div class="item-card__lead mt-3">
                {!!$program->getTranslationContent('description')!!}
            </div>
            <div class="mt-auto align-items-end btn-wrapper">
                <button class="btn item-card__action text-decoration-none">@lang('messages.action.moreDetails')</button>
            </div>
        </div>
    </a>
</div>