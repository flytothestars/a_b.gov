<div class="modal fade" id="highModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-body d-block anketa-modal__wrapper" style="max-width: 100%;">
                <div class="row">
                    <div class="col-md-12" style="text-align: right;">
                        <button type="button" id="highModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <h2 style="font-weight: bold; font-family: Verdana,sans-serif;">@lang('messages.pages.taxing.highRisk')</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <p style="font-family: Verdana, sans-serif;">@lang('messages.pages.taxing.highHeaderSubtitle')</p>
                    </div>
                </div>

                <div>
                    <img src="{{ asset('images/high.png') }}" class="w-100" alt="">
                </div>

                <div>
                        <span style="font-family: Verdana, sans-serif; font-size: 14px;">@lang('messages.pages.taxing.moreInformationLink')</span>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <button id="highModal" style="width: 400px !important;" data-bs-dismiss="modal" aria-label="Close" class="w-75 btn primary text-white">@lang('messages.action.close')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
