<div class="permitting-documents-service-tab py-5">
    <div class="permitting-documents-service-tab__title">
        @lang($title)
    </div>
    <div class="row mt-4 pt-3 pb-5">
        <div class="col-lg-7 order-2 order-lg-1">
            <div class="permitting-documents-service-tab__text pe-3 pb-3">
                <h6>  @lang('messages.pages.permittingDocuments.description') </h6>
                <div class="my-4">
                @lang($text)
                </div>
                <h6>
                @lang('messages.pages.permittingDocuments.forFreeConsultationAndSupportClickTheGetConsultationButton')
                </h6>
            </div>
            <a href="{{ route('services.form', ['service_groups_id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab'])}}"
               class="btn primary text-white mt-4 px-5">
               @lang('messages.action.toGetConsultation')
            </a>
        </div>
        <div class="col-lg-5 order-1 order-lg-2">
            <div class="services-img">
                <img src="{{ asset('/images/permittingDocumentsService/' . $name . '.png') }}"
                    alt="{{ $name }}" class="permitting-documents-service-tab__img">
            </div>
        </div>
    </div>
</div>
