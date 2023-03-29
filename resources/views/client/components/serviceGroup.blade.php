<div class="service-group">
    <a
        href="{{ $serviceGroup->remote_url ? $serviceGroup->remote_url : route('services.form', ['service_groups_id' => $serviceGroup->id]) }}"
        >
        <div class="card mb-3  py-5 h-100 text-center">
            @if ($serviceGroup->files->count() > 0)
                <div class="card-img-top">
                    {!! file_get_contents('../files/' . $serviceGroup->files[0]->path) !!}
                </div>
            @endif
            <div class="card-body py-0 pt-3">
                <div class="card-text mt-auto">{{ $serviceGroup->getTranslationContent('name') }}</div>
            </div>
        </div>
    </a>
</div>
